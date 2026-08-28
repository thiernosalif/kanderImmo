<?php

namespace App\Http\Controllers;

use App\Bien;
use App\Comptabilite;
use App\Proprietaire;
use App\Reglement;
use App\Situation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SituationController extends Controller
{
    protected $subheading = "Situations";
    protected $route = 'situations';
    protected $form = 'add';

    /** Taux de commission de gérance, fixe pour tous les propriétaires. */
    const COMMISSION_TAUX = 9;

    private $moisListe = [
        'Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin',
        'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre',
    ];

    /**
     * Liste des situations déjà générées.
     */
    public function index()
    {
        $heading = "Liste des situations";
        $table_headers = ['Propriétaire', 'Mois', 'Année', 'Total encaissé', 'Dépenses', 'Commission', 'Montant net'];

        $user = Auth::user();
        $query = Situation::with('proprietaire')->orderByDesc('id');

        if ($user->zone === "Ziguinchor") {
            $query->where('users_id', $user->id);
        }

        $liste = $query->get();

        return view('pages.situation.index', compact('liste', 'heading', 'table_headers'))
            ->with(['subheading' => $this->subheading, 'route' => $this->route]);
    }

    /**
     * Formulaire de sélection propriétaire + mois pour générer une situation.
     */
    public function create()
    {
        $heading = "Générer une situation";
        $user = Auth::user();

        $proprios = Proprietaire::orderBy('nom');
        if ($user->zone === "Ziguinchor") {
            $proprios->where('users_id', $user->id);
        }
        $liste_prop = [null => '- Choisir un Proprietaire -'] + $proprios->pluck('prenom', 'id')->all();

        $listes_mois = [null => '- Choisir un mois -'] + array_combine($this->moisListe, $this->moisListe);

        $anneeActuelle = (int) now()->year;
        $annees = range($anneeActuelle, $anneeActuelle - 5);
        $listes_annees = [null => '- Choisir une année -'] + array_combine($annees, $annees);

        return view('pages.situation.add', compact('heading', 'liste_prop', 'listes_mois', 'listes_annees'))
            ->with(['subheading' => $this->subheading, 'route' => $this->route, 'form' => $this->form]);
    }

    /**
     * Calcule (sans rien enregistrer) le total encaissé, les dépenses et la
     * commission d'un propriétaire pour un mois/année donnés, à partir des
     * règlements et dépenses réellement enregistrés à cette date.
     */
    private function calculer($proprietaireId, $mois, $annee)
    {
        $moisNumero = array_search($mois, $this->moisListe);
        $moisNumero = $moisNumero === false ? null : $moisNumero + 1;

        $biensIds = Bien::where('proprietaires_id', $proprietaireId)->pluck('id');

        $reglements = Reglement::whereHas('article.bien', function ($q) use ($biensIds) {
                $q->whereIn('biens_id', $biensIds);
            })
            ->whereYear('created_at', $annee)
            ->whereMonth('created_at', $moisNumero)
            ->with('locataire', 'article.bien')
            ->get();

        $totalLoyer = (float) $reglements->sum('montant');
        $totalTaxes = (float) $reglements->sum('taxe');
        $totalEncaisse = $totalLoyer + $totalTaxes;

        $totalDepenses = (float) Comptabilite::whereIn('biens_id', $biensIds)
            ->whereYear('created_at', $annee)
            ->whereMonth('created_at', $moisNumero)
            ->sum('retrait');

        // La commission de gérance ne porte que sur le loyer, jamais sur les taxes
        // (elles sont juste collectées pour le compte du bailleur, sans marge de l'agence).
        $commissionMontant = round($totalLoyer * self::COMMISSION_TAUX / 100, 2);
        $montantNet = $totalEncaisse - $commissionMontant - $totalDepenses;

        return compact('reglements', 'totalLoyer', 'totalTaxes', 'totalEncaisse', 'totalDepenses', 'commissionMontant', 'montantNet');
    }

    /**
     * Aperçu (non enregistré) des chiffres avant confirmation.
     */
    public function preview(Request $request)
    {
        $request->validate([
            'proprietaires_id' => 'required|exists:proprietaires,id',
            'mois' => 'required|in:'.implode(',', $this->moisListe),
            'annee' => 'required|integer',
        ]);

        $proprietaire = Proprietaire::findOrFail($request->proprietaires_id);
        $calcul = $this->calculer($request->proprietaires_id, $request->mois, $request->annee);

        $dejaGeneree = Situation::where('proprietaires_id', $request->proprietaires_id)
            ->where('mois', $request->mois)
            ->where('annee', $request->annee)
            ->exists();

        $heading = "Aperçu de la situation";

        return view('pages.situation.preview', array_merge($calcul, [
            'proprietaire' => $proprietaire,
            'mois' => $request->mois,
            'annee' => $request->annee,
            'heading' => $heading,
            'commissionTaux' => self::COMMISSION_TAUX,
            'dejaGeneree' => $dejaGeneree,
        ]))->with(['subheading' => $this->subheading, 'route' => $this->route]);
    }

    /**
     * Enregistre la situation de façon figée : les montants et la liste des
     * règlements inclus sont sauvegardés tels quels. Une correction ultérieure
     * d'un règlement n'affectera pas cette situation déjà générée.
     */
    public function store(Request $request)
    {
        $request->validate([
            'proprietaires_id' => 'required|exists:proprietaires,id',
            'mois' => 'required|in:'.implode(',', $this->moisListe),
            'annee' => 'required|integer',
        ]);

        $dejaGeneree = Situation::where('proprietaires_id', $request->proprietaires_id)
            ->where('mois', $request->mois)
            ->where('annee', $request->annee)
            ->exists();

        if ($dejaGeneree) {
            return redirect()->route('situations.index')
                ->with('error_msg', 'Une situation existe déjà pour ce propriétaire à cette période.');
        }

        $calcul = $this->calculer($request->proprietaires_id, $request->mois, $request->annee);

        $situation = Situation::create([
            'proprietaires_id' => $request->proprietaires_id,
            'mois' => $request->mois,
            'annee' => $request->annee,
            'total_encaisse' => $calcul['totalEncaisse'],
            'total_taxes' => $calcul['totalTaxes'],
            'total_depenses' => $calcul['totalDepenses'],
            'commission_taux' => self::COMMISSION_TAUX,
            'commission_montant' => $calcul['commissionMontant'],
            'montant_net' => $calcul['montantNet'],
            'users_id' => Auth::id(),
        ]);

        $situation->reglements()->attach($calcul['reglements']->pluck('id'));

        return redirect()->route('situations.index')
            ->with('success_msg', 'Situation générée avec succès.');
    }

    /**
     * Télécharge le PDF de la situation, à partir des montants figés en base
     * (pas recalculé).
     */
    public function show(Situation $situation)
    {
        $situation->load('proprietaire', 'reglements.locataire', 'reglements.article.bien');

        $pdf = Pdf::loadView('pages.situation.pdf', compact('situation'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('situation_'.$situation->mois.'_'.$situation->annee.'.pdf');
    }

    /**
     * Supprime une situation générée par erreur.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $situation = Situation::find($id);

        if ($situation != null) {
            $situation->delete();
        }

        return redirect()->route('situations.index')->with('success_msg', 'Suppression effectuée avec succès.');
    }
}

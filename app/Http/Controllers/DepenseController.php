<?php

namespace App\Http\Controllers;

use App\Bien;
use App\Comptabilite;
use App\Http\Requests\DepenseRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DepenseController extends Controller
{
    protected $subheading = "Dépenses par bien";
    protected $route = 'depenses';
    protected $form = 'add';

    /**
     * Liste des dépenses enregistrées, une ou plusieurs lignes par bien et par mois.
     */
    public function index()
    {
        $heading = "Dépenses par bien";
        $table_headers = ['Immeuble', 'Motif', 'Montant', 'Reçu', 'Date'];

        $user = Auth::user();
        $query = Comptabilite::with('bien')->whereNotNull('biens_id')->orderByDesc('id');

        if ($user->zone === "Ziguinchor") {
            $query->where('users_id', $user->id);
        }

        $liste = $query->get();

        return view('pages.depense.index', compact('liste', 'heading', 'table_headers'))
            ->with(['subheading' => $this->subheading, 'route' => $this->route]);
    }

    /**
     * Formulaire d'ajout d'une dépense pour un immeuble donné.
     */
    public function create()
    {
        $heading = "Ajouter une dépense";
        $user = Auth::user();

        $biens = Bien::orderBy('adresse');
        if ($user->zone === "Ziguinchor") {
            $biens->where('users_id', $user->id);
        }
        $liste_biens = [null => '- Choisir un immeuble -'] + $biens->pluck('adresse', 'id')->all();

        return view('pages.depense.add', compact('heading', 'liste_biens'))
            ->with(['subheading' => $this->subheading, 'route' => $this->route, 'form' => $this->form]);
    }

    /**
     * Enregistre une dépense (ligne de retrait rattachée à un bien).
     */
    public function store(DepenseRequest $request)
    {
        $com = new Comptabilite();
        $com->biens_id = $request->biens_id;
        $com->motif = $request->motif;
        $com->retrait = $request->montant;
        $com->depot = 0;
        $com->users_id = Auth::id();

        if ($request->hasFile('recu')) {
            $com->recu = $request->file('recu')->store('recus', 'public');
        }

        $com->save();

        return redirect()->route('depenses.index')
            ->with('success_msg', 'Dépense ajoutée avec succès.');
    }

    /**
     * Supprime une dépense (et son reçu s'il existe).
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $depense = Comptabilite::find($id);

        if ($depense != null) {
            if ($depense->recu) {
                Storage::disk('public')->delete($depense->recu);
            }
            $depense->delete();
        }

        return redirect()->route('depenses.index')->with('success_msg', 'Suppression effectuée avec succès.');
    }
}

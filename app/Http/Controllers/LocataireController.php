<?php

namespace App\Http\Controllers;

use App\Comptabilite;
use App\Http\Requests\LocataireRequest;
use App\Locataire;
use App\Total;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class LocataireController extends Controller
{
    protected $subheading ="locataires";
    protected $route = 'locataires';
    protected $form  = 'add';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   /*  public function index()
    {

        $heading = "Liste des locataires";
        $bouton_ajout_title = 'Ajouter un nouveau locataire';
        $table_headers = ['Prénom', 'Nom', 'cin', 'total loyer', 'Adresse', 'Téléphone'];
        $table_bodies = ['prenom' ,'nom', 'cin', 'total_loyer', 'adresse', 'telephone'];
        $user = Auth::user();
        if ($user->zone == "Ziguinchor")
        {
            $id = Auth::id();
            $liste = Locataire::where('users_id',$id)->get();
        }else

        $liste = Locataire::orderBy('id')->get();
        //dd($liste);

        return view(
            'pages.locataire.index',
            compact('liste','heading', 'table_headers', 'table_bodies', 'bouton_ajout_title')
        )->with(['subheading' => $this->subheading, 'route' => $this->route]);
    } */

        public function index(Request $request)
{
    // 🔹 APPEL AJAX (DataTables)
    if ($request->ajax()) {

        $query = Locataire::select(
                'locataires.*'
            )
            ->orderByDesc('locataires.id');

        // 🔐 restriction par zone
        if (Auth::user()->zone === "Ziguinchor") {
            $query->where('locataires.users_id', Auth::id());
        }

        return DataTables::of($query)

            ->filter(function ($query) use ($request) {
                if ($request->has('search') && $search = $request->search['value']) {

                    // Découpe la recherche en mots pour permettre "prénom nom" en une seule saisie :
                    // chaque mot doit correspondre à au moins une des colonnes (AND entre mots, OR entre colonnes).
                    $words = preg_split('/\s+/', trim($search), -1, PREG_SPLIT_NO_EMPTY);

                    $query->where(function ($query) use ($words) {
                        foreach ($words as $word) {
                            $word = strtolower($word);

                            $query->where(function ($q) use ($word) {
                                $q->whereRaw('LOWER(prenom) LIKE ?', ["%{$word}%"])
                                  ->orWhereRaw('LOWER(nom) LIKE ?', ["%{$word}%"])
                                  ->orWhereRaw('LOWER(cin) LIKE ?', ["%{$word}%"])
                                  ->orWhereRaw('LOWER(adresse) LIKE ?', ["%{$word}%"])
                                  ->orWhereRaw('LOWER(telephone) LIKE ?', ["%{$word}%"]);
                            });
                        }
                    });
                }
            })

           ->addColumn('actions', function ($row) {

    return '
        <div class="uk-text-nowrap">

            <a href="'.route('locataires.edit', $row).'">
                <i class="material-icons md-24">&#xE254;</i>
            </a>

            <a href="'.route('locataires.delete', $row->id).'"
               class="destroy-btn"
               data-confirm="Êtes-vous sûr de vouloir supprimer cet enregistrement ?">
                <i class="material-icons md-24">&#xE872;</i>
            </a>

           <a href="'.route('reglements.create', ['id' => $row->id]).'"
           class="uk-margin-left"
           style="color:#2ECC71"
           uk-tooltip="Régler le locataire">
            <i class="material-icons md-24">&#xE8A1;</i>
        </a>


        </div>
    ';
})

->rawColumns(['actions'])
->make(true);
    }

    // 🔹 Chargement normal de la page (NON AJAX)
    $heading = "Liste des locataires";
    $bouton_ajout_title = 'Ajouter un nouveau locataire';
    $table_headers = ['Prénom', 'Nom', 'CIN', 'Total loyer', 'Adresse', 'Téléphone'];

    return view(
        'pages.locataire.index',
        compact('heading', 'table_headers', 'bouton_ajout_title')
    )->with([
        'subheading' => $this->subheading,
        'route' => $this->route
    ]);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $heading = "Ajout d'un nouveau Locataire";
       // $liste_options = Option::orderBy('id','desc')->get();

        return view('pages.ressource.create', compact('heading'))
            ->with(['subheading' => $this->subheading, 'route' => $this->route, 'form' => $this->form]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocataireRequest $request)
    {
    $locataires = new Locataire();
        $locataires->cin = $request->cin;
        $locataires->nom = $request->nom;
        $locataires->prenom = $request->prenom;
        $locataires->adresse = $request->adresse;
        $locataires->telephone = $request->telephone;
        $locataires->coordonne_pro = $request->coordonne_pro;
        $locataires->date_entre = $request->date_entre;
        $locataires->expiration_contrat = $request->expiration_contrat;
        $locataires->total_loyer = $request->loyer_base;
        $locataires->loyer_base = $request->loyer_base;
        $locataires->users_id = Auth::id();

      /*  $com = new Comptabilite();
        $com->motif = "reglement locataire";
        $com->depot = $locataires->total_loyer;
        $com->retrait = 0;
        $com->users_id = Auth::id();
        $com->save();
        $total = Total::first();
        if($total)
        {
            $total->users_id = Auth::id();
            $total->ca = $total->ca + $locataires->total_loyer;
            $total->save();
        }
        else{
            $id = Auth::id();
            Total::create([
                'ca' => $locataires->total_loyer,
                'users_id' => $locataires->users_id
            ]);
        }*/
        $locataires->save();
        return redirect()->route('locataires.index')
            ->with('success_msg', 'Ajout effectué avec succès.');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Locataire $locataire)
    {
        $heading = "Modifier un locataire";

        $model = $locataire;

        $user = Auth::user();
        if ($user->zone == "Dakar")
        {
            return view('pages.ressource.edit', compact('model', 'heading'))
            ->with(['subheading' => $this->subheading, 'route' => $this->route, 'form' => $this->form]);
        }else

        return Redirect::back()->with("error_msg", "Action non autorisée");



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocataireRequest $request, Locataire $locataire)
    {
        $validated = $request->validated();

        $validated['total_loyer'] = $request->loyer_base;

        $locataire->update($validated);

        return Redirect::route($this->route.'.index')
            ->with('success_msg', 'Modification effectuée avec succès.');

    }

    /**
     * Télécharge la liste des locataires au format CSV (sauvegarde).
     *
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function export()
    {
        $query = Locataire::orderBy('nom');

        if (Auth::user()->zone === "Ziguinchor") {
            $query->where('users_id', Auth::id());
        }

        $locataires = $query->get();

        $filename = 'locataires_'.now()->format('Y-m-d_His').'.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ];

        $columns = ['Prénom', 'Nom', 'CIN', 'Total loyer', 'Adresse', 'Téléphone'];

        $callback = function () use ($locataires, $columns) {
            $handle = fopen('php://output', 'w');
            // BOM UTF-8 pour qu'Excel affiche correctement les accents
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, $columns, ';');

            foreach ($locataires as $locataire) {
                fputcsv($handle, [
                    $locataire->prenom,
                    $locataire->nom,
                    $locataire->cin,
                    $locataire->total_loyer,
                    $locataire->adresse,
                    $locataire->telephone,
                ], ';');
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Télécharge la liste des locataires au format PDF (sauvegarde).
     *
     * @return \Illuminate\Http\Response
     */
    public function exportPdf()
    {
        $query = Locataire::orderBy('nom');

        if (Auth::user()->zone === "Ziguinchor") {
            $query->where('users_id', Auth::id());
        }

        $locataires = $query->get();
        $dateNow = now()->format('d/m/Y');

        $pdf = Pdf::loadView('pages.locataire.export_pdf', compact('locataires', 'dateNow'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('locataires_'.now()->format('Y-m-d_His').'.pdf');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

          $locataire =  Locataire::find($id);

            if($locataire != null)
            {
                $locataire->delete();
            }
        return Redirect::route('locataires.index')->with('success_msg', 'Suppression effectuée avec succès.');
    }
}

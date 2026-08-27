<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProprioRequest;
use App\Proprietaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class ProprioController extends Controller
{
    protected $subheading ="Proprietaires";
    protected $route = 'proprietaires';
    protected $form  = 'add';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* public function index()
    {

        $heading = "Liste des Proprietaires";
        $bouton_ajout_title = 'Ajouter un nouveau Proprietaire';
        $table_headers = ['Prénom', 'Nom', 'cin', 'Adresse', 'Téléphone'];
        $table_bodies = ['prenom' ,'nom', 'cin', 'adresse', 'telephone'];
        $user = Auth::user();
        if ($user->zone == "Ziguinchor")
        {
            $id = Auth::id();
            $liste = Proprietaire::where('users_id',$id)->get();
        }else

            $liste = Proprietaire::orderBy('id')->get();
        //dd($liste);

        return view(
            'pages.proprietaire.index',
            compact('liste','heading', 'table_headers', 'table_bodies', 'bouton_ajout_title')
        )->with(['subheading' => $this->subheading, 'route' => $this->route]);
    } */

         public function index(Request $request)
{
    // 🔹 APPEL AJAX (DataTables)
    if ($request->ajax()) {

        $query = Proprietaire::select('proprietaires.*')
            ->orderByDesc('proprietaires.id');

        // 🔐 restriction par zone
        if (Auth::user()->zone === "Ziguinchor") {
            $query->where('proprietaires.users_id', Auth::id());
        }

        return DataTables::of($query)

            ->filter(function ($query) use ($request) {
                if ($request->has('search') && $search = $request->search['value']) {

                    $search = strtolower($search);

                    $query->where(function ($q) use ($search) {
                        $q->whereRaw('LOWER(prenom) LIKE ?', ["%{$search}%"])
                          ->orWhereRaw('LOWER(nom) LIKE ?', ["%{$search}%"])
                          ->orWhereRaw('LOWER(cin) LIKE ?', ["%{$search}%"])
                          ->orWhereRaw('LOWER(adresse) LIKE ?', ["%{$search}%"])
                          ->orWhereRaw('LOWER(telephone) LIKE ?', ["%{$search}%"]);
                    });
                }
            })

            // ✅ COLONNE ACTIONS (PROPRIÉTAIRE)
            ->addColumn('actions', function ($row) {

                return '
                    <div class="uk-text-nowrap">

                        <a href="'.route('proprietaires.edit', $row).'">
                            <i class="material-icons md-24">&#xE254;</i>
                        </a>

                        <a href="'.route('proprietaires.delete', $row->id).'"
                           class="destroy-btn uk-margin-left"
                           data-confirm="Êtes-vous sûr de vouloir supprimer ce propriétaire ?">
                            <i class="material-icons md-24">&#xE872;</i>
                        </a>

                    </div>
                ';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }

    // 🔹 CHARGEMENT NORMAL (NON AJAX)
    $heading = "Liste des propriétaires";
    $bouton_ajout_title = 'Ajouter un nouveau propriétaire';
    $table_headers = ['Prénom', 'Nom', 'CIN', 'Adresse', 'Téléphone'];

    return view(
        'pages.proprietaire.index',
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

        $heading = "Ajout d'un nouveau Proprietaire";
        // $liste_options = Option::orderBy('id','desc')->get();

        return view('pages.ressource.proprio', compact('heading'))
            ->with(['subheading' => $this->subheading, 'route' => $this->route, 'form' => $this->form]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProprioRequest $request)
    {
        $proprios = new Proprietaire();
        $proprios->cin = $request->cin;
        $proprios->nom = $request->nom;
        $proprios->prenom = $request->prenom;
        $proprios->adresse = $request->adresse;
        $proprios->telephone = $request->telephone;
        $proprios->date_deb_mandat = $request->date_deb_mandat;
        $proprios->date_fin_mandat = $request->date_fin_mandat;
        $proprios->users_id = Auth::id();
        $proprios->save();
        return redirect()->route('proprietaires.index')
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
    public function edit(Proprietaire $proprietaire)
    {
        $heading = "Modifier un proprietaire";

        $model = $proprietaire;
        $user = Auth::user();
        if ($user->zone == "Dakar")
        {
            return view('pages.ressource.edit_proprio', compact('model', 'heading'))
            ->with(['subheading' => $this->subheading, 'route' => $this->route, 'form' => $this->form]);;
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
    public function update(ProprioRequest $request, Proprietaire $proprietaire)
    {
        $validated = $request->validated();



        $proprietaire->update($validated);

        return Redirect::route($this->route.'.index')
            ->with('success_msg', 'Modification effectuée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

          $proprietaire =  Proprietaire::find($id);

            if($proprietaire != null)
            {
                $proprietaire->delete();
            }
        return Redirect::route('proprietaires.index')->with('success_msg', 'Suppression effectuée avec succès.');
    }
}

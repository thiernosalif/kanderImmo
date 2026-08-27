<?php

namespace App\Http\Controllers;

use App\Bien;
use App\Http\Requests\BienRequest;
use App\Proprietaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BienController extends Controller
{
    protected $subheading ="Biens";
    protected $route = 'biens';
    protected $form  = 'add';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heading = "Liste des Biens";
        $bouton_ajout_title = 'Ajouter un nouveau Bien';
        $table_headers = ['Proprietaire', 'adresse', 'type', 'description'];
        $table_bodies = ['Proprietaire', 'adresse', 'type', 'description'];
        $user = Auth::user();
        if ($user->zone == "Ziguinchor")
        {
            $id = Auth::id();
            $liste = Bien::where('users_id',$id)->get();
            $liste_prop = Proprietaire::where('users_id',$id)->get();
        }else
            $liste = Bien::orderBy('id')->get();
            $liste_prop = Proprietaire::orderBy('id')->get();
        //dd($liste);

        return view(
            'pages.bien.index',
            compact('liste','heading', 'table_headers', 'table_bodies', 'bouton_ajout_title','liste_prop')
        )->with(['subheading' => $this->subheading, 'route' => $this->route]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $heading = "Ajout d'un nouveau Bien";
        // $liste_options = Option::orderBy('id','desc')->get();
        $user = Auth::user();
        if ($user->zone == "Ziguinchor")
        {
            $id = Auth::id();

            $liste_prop = [null => '- Choisir un Proprietaire -'] + Proprietaire::orderBy('id')->pluck('prenom' ,'id')->all();
        }else

        $liste_prop = [null => '- Choisir un Proprietaire -'] + Proprietaire::orderBy('id')->pluck('prenom','id')->all();
        //dd($liste);

        return view('pages.ressource.bien', compact('heading','liste_prop'))
            ->with(['subheading' => $this->subheading, 'route' => $this->route, 'form' => $this->form]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BienRequest $request)
    {
        $biens = new Bien();
        $biens->proprietaires_id = $request->proprietaires_id;
        $biens->adresse = $request->adresse;
        $biens->type = $request->type;
        $biens->description = $request->description;
        $biens->users_id = Auth::id();
        $biens->save();
        return redirect()->route('biens.index')
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
    public function edit(Bien $bien)
    {
        $heading = "Modifier un Bien";

        $model = $bien;

        $user = Auth::user();
        if ($user->zone == "Dakar")
        {
            $liste_prop = [null => '- Choisir un Proprietaire -'] + Proprietaire::orderBy('id')->pluck('prenom' ,'id')->all();
            return view('pages.ressource.editBien', compact('model', 'heading','liste_prop'))
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
    public function update(BienRequest $request,Bien $bien )
    {
        $validated = $request->validated();



        $bien->update($validated);

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
        $bien =  Bien::find($id);

        if($bien != null)
        {
            $bien->delete();
        }
    return Redirect::route('biens.index')->with('success_msg', 'Suppression effectuée avec succès.');
}
    }


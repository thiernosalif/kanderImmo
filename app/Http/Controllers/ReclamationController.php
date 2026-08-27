<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReclamationRequest;
use App\Locataire;
use App\Reclamation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReclamationController extends Controller
{
    protected $subheading ="Reclamations";
    protected $route = 'reclamations';
    protected $form  = 'add';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $bouton_ajout_title = 'Ajouter une nouvelle reclamation';
        $table_headers = [ 'Locataire', 'Motif', 'Description'];
        $table_bodies = ['Locataire','Motif', 'Description'];
        $user = Auth::user();
        if ($user->zone == "Ziguinchor")
        {
            $id = Auth::id();
            $liste = Reclamation::where('users_id',$id)->get();
            $listeloc = Locataire::where('users_id',$id)->pluck('prenom' ,'id')->get();
            $liste_loc = [null => '- Choisir un Locataire -'] + Locataire::orderBy('id')->pluck('prenom' ,'id')->all();
        }else

            $liste = Reclamation::orderBy('id')->get();
             $listeloc = Locataire::orderBy('id')->pluck('prenom' ,'id')->all();
        $liste_loc = [null => '- Choisir un Locataire -'] + Locataire::orderBy('id')->pluck('prenom' ,'id')->all();
        $heading = "Liste des Reclamations";
        $bouton_ajout_title = 'Ajouter une nouvelle Reclamation';
        return view(
            'pages.reclamation.index',
            compact('liste', 'heading', 'table_headers', 'bouton_ajout_title', 'table_bodies','liste_loc','listeloc')
            )->with(['subheading' => $this->subheading, 'route' => $this->route]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $heading = "Ajout d'une nouvelle Reclamation";
        // $liste_options = Option::orderBy('id','desc')->get();
        $liste_loc = [null => '- Choisir un Locataire -'] + Locataire::orderBy('id')->pluck('prenom','nom' ,'id')->all();
        return view('pages.reclamation.create', compact('heading','liste_loc'))
            ->with(['subheading' => $this->subheading, 'route' => $this->route, 'form' => $this->form]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReclamationRequest $request)
    {
        $rec = new Reclamation();
        $rec->locataires_id = $request->locataires_id;
        $rec->motif = $request->motif;
        $rec->description = $request->description;
        $rec->users_id = Auth::id();
        $rec->save();
        return redirect()->route('reclamations.index')
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

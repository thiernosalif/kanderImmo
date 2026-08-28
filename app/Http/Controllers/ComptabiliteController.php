<?php

namespace App\Http\Controllers;

use App\Bien;
use App\Comptabilite;
use App\Http\Requests\ComptabiliteRequest;
use App\Total;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComptabiliteController extends Controller
{
    protected $subheading ="Comptabilités";
    protected $route = 'comptabilités';
    protected $form  = 'add';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $depot = 'Crediter le compte';
        $retrait = 'Debiter le compte';
        $table_headers = [ 'Utilisateur','Motif', 'Depot', 'Retrait'];
        $table_bodies = ['Utilisateur','Motif','Depot', 'Retrait'];
        $user = Auth::user();
        if ($user->zone == "Ziguinchor")
        {
            $id = Auth::id();
            $liste = Comptabilite::where('users_id',$id)->get();
           /* $listeloc = Locataire::where('users_id',$id)->pluck('prenom' ,'id')->get();
            $liste_loc = [null => '- Choisir un Locataire -'] + Locataire::orderBy('id')->pluck('prenom' ,'id')->all();*/
        }else

            $liste = Comptabilite::orderBy('id')->get();
       /* $listeloc = Locataire::orderBy('id')->pluck('prenom' ,'id')->all();
        $liste_loc = [null => '- Choisir un Locataire -'] + Locataire::orderBy('id')->pluck('prenom' ,'id')->all();*/
        $heading = "Liste des Comptes";
        $bouton_ajout_title = 'mettre a jour le compte';
        $liste_biens = [null => '- Aucun (dépense générale) -'] + Bien::orderBy('id')->pluck('adresse', 'id')->all();
        return view(
            'pages.comptabilite.index',
            compact('liste', 'heading', 'table_headers', 'bouton_ajout_title', 'table_bodies','depot','retrait','id','liste_biens')
        )->with(['subheading' => $this->subheading, 'route' => $this->route]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $heading = "debiter le compte";
        // $liste_options = Option::orderBy('id','desc')->get();
       // $liste_loc = [null => '- Choisir un Locataire -'] + Locataire::orderBy('id')->pluck('prenom','nom' ,'id')->all();
        return view('pages.comptabilite.debit', compact('heading'))
            ->with(['subheading' => $this->subheading, 'route' => $this->route, 'form' => $this->form]);

    }

  /*  public function crediter()
    {
        $heading = "Crediter le compte";
        // $liste_options = Option::orderBy('id','desc')->get();
        // $liste_loc = [null => '- Choisir un Locataire -'] + Locataire::orderBy('id')->pluck('prenom','nom' ,'id')->all();
        return view('pages.comptabilite.credit', compact('heading'))
            ->with(['subheading' => $this->subheading, 'route' => $this->route, 'form' => $this->form]);

    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function debiter(ComptabiliteRequest $request)
    {
        $com = new Comptabilite();
        $com->motif = $request->motif;
        $com->depot = $request->depot;
        $com->retrait = 0;
        $com->users_id = Auth::id();

        $total = Total::first();

        if($total)
        {
            $total->users_id = Auth::id();
            $total->ca = $total->ca + $com->depot;
            $total->save();
        }
        else{
            $id = Auth::id();
            Total::create([
                'ca' => $com->depot,
                'users_id' => $com->users_id
            ]);
        }
        $com->save();


      //  dd($com);
        return redirect()->route('comptabilites.index',['id' => "depot"])
            ->with('success_msg', 'Credit effectué avec succès.');
    }

    public function crediter(ComptabiliteRequest $request)
    {

        $com = new Comptabilite();
        $com->motif = $request->motif;
        $com->retrait = $request->retrait;
        $com->depot = 0;
        $com->biens_id = $request->biens_id;

        $com->users_id = Auth::id();
        $total = Total::first();

        if($total)
        {
            $total->users_id = Auth::id();
            $total->ca = $total->ca - $com->retrait;
            $total->save();
        }
        else{

            Total::create([
                'ca' => -$com->retrait,
                'users_id' => $com->users_id
            ]);
        }
        $com->save();
        return redirect()->route('comptabilites.index',['id' => "retrait"])
            ->with('success_msg', 'debit effectué avec succès.');
    }
}

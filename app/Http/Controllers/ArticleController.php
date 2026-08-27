<?php

namespace App\Http\Controllers;

use App\Article;
use App\Bien;
use App\Http\Requests\ArticleRequest;
use App\Locataire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ArticleController extends Controller
{
    protected $subheading ="Articles";
    protected $route = 'articles';
    protected $form  = 'add';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heading = "Liste des Articles";
        $bouton_ajout_title = 'Ajouter un nouvelle Article';
        $table_headers = ['Locataire', 'Bien', 'Structure de l\'article', 'disponibilite'];
        $table_bodies = ['Locataire', 'Bien', 'Structure de l\'article', 'disponibilite'];
        $user = Auth::user();
        if ($user->zone == "Ziguinchor")
        {
            $id = Auth::id();
            $liste = Article::where('users_id',$id)->get();
           // $liste_prop = Proprietaire::where('users_id',$id)->get();
        }else
            $liste = Article::orderBy('id')->get();
      //  $liste_prop = Proprietaire::orderBy('id')->get();
        //dd($liste);

        return view(
            'pages.article.index',
            compact('liste','heading', 'table_headers', 'table_bodies', 'bouton_ajout_title')
        )->with(['subheading' => $this->subheading, 'route' => $this->route]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $heading = "Ajout d'une nouvelle Article";
        // $liste_options = Option::orderBy('id','desc')->get();
        $user = Auth::user();
        if ($user->zone == "Ziguinchor")
        {
            $id = Auth::id();
            $liste = Article::where('users_id',$id)->get();
            $liste_loc = [null => '- Choisir un Locataire -'] + Locataire::orderBy('id')->pluck('prenom' ,'id')->all();
            $liste_biens = [null => '- Choisir un Bien -'] + Bien::orderBy('id')->pluck('adresse' ,'id')->all();
        }else
            $liste = Article::orderBy('id')->get();
            $liste_loc = [null => '- Choisir un Locataire -'] + Locataire::orderBy('id')->pluck('prenom','id')->all();
        $liste_biens = [null => '- Choisir un Bien -'] + Bien::orderBy('id')->pluck('adresse' ,'id')->all();
        //dd($liste);

        return view('pages.ressource.article', compact('heading','liste_loc','liste_biens','liste'))
            ->with(['subheading' => $this->subheading, 'route' => $this->route, 'form' => $this->form]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $articles = new Article();
        $articles->locataires_id = $request->locataires_id;
        $articles->biens_id = $request->biens_id;
        $articles->structure_ar = $request->structure_ar;

            $articles->disponibilite = $request->disponibilite;
        $articles->users_id = Auth::id();
        $articles->save();
        return redirect()->route('articles.index')
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
    public function edit(Article $article)
    {
        $heading = "Modifier un article";
         $model = $article;
       $user = Auth::user();
         if ($user->zone == "Dakar")
        {
            $liste = Article::orderBy('id')->get();
            $liste_loc = [null => '- Choisir un Locataire -'] + Locataire::orderBy('id')->pluck('prenom','id')->all();
            $liste_biens = [null => '- Choisir un Bien -'] + Bien::orderBy('id')->pluck('adresse' ,'id')->all();
            return view('pages.ressource.editArt', compact('model','liste','liste_loc','liste_biens', 'heading'))
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
    public function update(ArticleRequest $request, Article $article)
    {
        $validated = $request->validated();



        $article->update($validated);

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

        $article =  Article::find($id);

        if($article != null)
        {
            $article->delete();
        }
    return Redirect::route('articles.index')->with('success_msg', 'Suppression effectuée avec succès.');
}
    }


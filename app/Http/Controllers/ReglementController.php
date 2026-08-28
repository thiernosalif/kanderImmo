<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comptabilite;
use App\Http\Requests\ReglementRequest;
use App\Locataire;
use App\Reglement;
use App\Total;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ReglementController extends Controller
{
    protected $subheading = "Reglements";
    protected $route = 'reglements';
    protected $form  = 'add';


    /* public function index()
    {

        $heading = "Liste des reglements";
        $listes_mois = [
            null => '- Choisir une option -',
            'Janvier'    => 'Janvier',
            'Fevrier'   => 'Fevrier',
            'Mars'             => 'Mars',
            'Avril' => 'Avril',
            'Mai'    => 'Mai',
            'Juin'   => 'Juin',
            'Juillet'             => 'Juillet',
            'Août' => 'Août',
            'Septembre'    => 'Septembre',
            'Octobre'   => 'Octobre',
            'Novembre'             => 'Novembre',
            'Decembre' => 'Decembre',
        ];

        $bouton_ajout_title = 'Ajouter un nouveau reglement';
        $table_headers = [ 'Locataire', 'Article', 'Montant', 'Date paiement','Mode Reglement'];
        $table_bodies = ['Locataire', 'Article', 'Montant', 'Date paiement','Mode Reglement'];

        $user = Auth::user();
        $query = Reglement::with([

    ])->orderByDesc('id');

    if ($user->zone === "Ziguinchor") {
        $query->where('users_id', $user->id);
    }
        //$liste = $query->paginate(20);
        dd($query->count());




        return view(
            'pages.reglement.index',
            compact('liste', 'heading', 'table_headers', 'bouton_ajout_title','listes_mois', 'table_bodies')
        )->with(['subheading' => $this->subheading, 'route' => $this->route]);
    } */


        public function index(Request $request)
{

 $heading = "Liste des reglements";

    $listes_mois = [
        null => '- Choisir une option -',
        'Janvier' => 'Janvier',
        'Fevrier' => 'Fevrier',
        'Mars' => 'Mars',
        'Avril' => 'Avril',
        'Mai' => 'Mai',
        'Juin' => 'Juin',
        'Juillet' => 'Juillet',
        'Août' => 'Août',
        'Septembre' => 'Septembre',
        'Octobre' => 'Octobre',
        'Novembre' => 'Novembre',
        'Decembre' => 'Decembre',
    ];

    $bouton_ajout_title = 'Ajouter un nouveau reglement';
    $table_headers = ['Locataire', 'Article', 'Montant', 'Date paiement', 'Mode Reglement'];
    $table_bodies = ['Locataire', 'Article', 'Montant', 'Date paiement', 'Mode Reglement'];
    // if ($request->ajax()) {

    //     $query = Reglement::with(['locataire','article'])
    //         ->orderByDesc('id');

    //     if (Auth::user()->zone === "Ziguinchor") {
    //         $query->where('users_id', Auth::id());
    //     }

    //     return DataTables::of($query)

    //         ->addColumn('actions', function ($reg) {
    //             return '
    //                 <a href="#"><i class="material-icons md-24">&#xE254;</i></a>
    //                 <a href="'.route('factures.index',['id'=>$reg->id]).'">
    //                     <i class="material-icons md-24">&#xE8ad;</i>
    //                 </a>
    //             ';
    //         })

    //         ->addColumn('locataire_nom', function ($reg) {
    //             return optional($reg->locataire)->prenom.' '
    //                  . optional($reg->locataire)->nom;
    //         })

    //         ->addColumn('adresse', function ($reg) {
    //             return optional($reg->locataire)->adresse;
    //         })

    //         ->editColumn('created_at', function ($reg) {
    //             return $reg->created_at
    //                 ? $reg->created_at->format('d/m/Y')
    //                 : '';
    //         })

    //         ->rawColumns(['actions'])
    //         ->make(true);
    // }

    if ($request->ajax()) {

        $query = Reglement::select(
                'reglements.*',
                'locataires.nom as locataire_nom',
                'locataires.prenom as locataire_prenom',
                'locataires.adresse as locataire_adresse',
                'locataires.cin as locataire_cin'
            )
            ->leftJoin('locataires', 'reglements.locataires_id', '=', 'locataires.id')
            ->orderByDesc('reglements.id');

        if (Auth::user()->zone === "Ziguinchor") {
            $query->where('reglements.users_id', Auth::id());
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
                        $q->whereRaw('LOWER(locataires.nom) LIKE ?', ["%{$word}%"])
                          ->orWhereRaw('LOWER(locataires.prenom) LIKE ?', ["%{$word}%"])
                          ->orWhereRaw('LOWER(locataires.cin) LIKE ?', ["%{$word}%"])
                          ->orWhereRaw('LOWER(locataires.adresse) LIKE ?', ["%{$word}%"])
                          ->orWhereRaw('LOWER(reglements.montant) LIKE ?', ["%{$word}%"])
                          ->orWhereRaw('LOWER(reglements.transactionreference) LIKE ?', ["%{$word}%"]);
                    });
                }
            });
        }
    })

    ->addColumn('locataire', function ($row) {
        return $row->locataire_prenom . ' ' . $row->locataire_nom;
    })

    ->editColumn('created_at', function ($row) {
        return $row->created_at
            ? \Carbon\Carbon::parse($row->created_at)->format('d/m/Y')
            : '';
    })

    ->addColumn('actions', function ($row) {
        return '
            <a href="#"><i class="material-icons md-24">&#xE254;</i></a>
            <a href="'.route('factures.index',['id'=>$row->id]).'">
                <i class="material-icons md-24">&#xE8ad;</i>
            </a>
        ';
    })

    ->rawColumns(['actions'])
    ->make(true);
    }


     // 🔹 Chargement normal de la page
    return view(
        'pages.reglement.index',
        compact(
            'heading',
            'table_headers',
            'bouton_ajout_title',
            'listes_mois',
            'table_bodies'
        )
    )->with([
        'subheading' => $this->subheading,
        'route' => $this->route
    ]);
}

/*         public function index(Request $request)
{
    $heading = "Liste des reglements";

    $listes_mois = [
        null => '- Choisir une option -',
        'Janvier' => 'Janvier',
        'Fevrier' => 'Fevrier',
        'Mars' => 'Mars',
        'Avril' => 'Avril',
        'Mai' => 'Mai',
        'Juin' => 'Juin',
        'Juillet' => 'Juillet',
        'Août' => 'Août',
        'Septembre' => 'Septembre',
        'Octobre' => 'Octobre',
        'Novembre' => 'Novembre',
        'Decembre' => 'Decembre',
    ];

    $bouton_ajout_title = 'Ajouter un nouveau reglement';
    $table_headers = ['Locataire', 'Article', 'Montant', 'Date paiement', 'Mode Reglement'];
    $table_bodies = ['Locataire', 'Article', 'Montant', 'Date paiement', 'Mode Reglement'];

    $user = Auth::user();

    // 🔥 Partie AJAX pour DataTables
    if ($request->ajax()) {

        $query = Reglement::with(['locataire', 'article'])
            ->orderByDesc('id');

        if ($user->zone === "Ziguinchor") {
            $query->where('users_id', $user->id);
        }

        return DataTables::of($query)

            ->addColumn('locataire', function ($reg) {
                return optional($reg->locataire)->nom;
            })

            ->addColumn('article', function ($reg) {
                return optional($reg->article)->structure_ar;
            })

            ->addColumn('adresse', function ($reg) {
                return optional($reg->locataire)->adresse;
            })

            ->editColumn('created_at', function ($reg) {
                return $reg->created_at
                    ? $reg->created_at->format('d/m/Y')
                    : '';
            })

            ->rawColumns(['locataire', 'article'])
            ->make(true);
    }

    // 🔹 Chargement normal de la page
    return view(
        'pages.reglement.index',
        compact(
            'heading',
            'table_headers',
            'bouton_ajout_title',
            'listes_mois',
            'table_bodies'
        )
    )->with([
        'subheading' => $this->subheading,
        'route' => $this->route
    ]);
} */


    public function create($id)
    {
        $locataire = Locataire::find($id);
        /* $art = $locataires->articles;
         dd($art);*/
        $reg = Reglement::all();
        $art = $locataire->articles;
        $mode = [
            null => '- Choisir une option -',
            'Transaction mobile'  => 'Transaction mobile',
            'Cash' => 'Cash',
            'Transaction bancaire'  => 'Transaction bancaire',
        ];
        $articles =[null => '- Choisir un article -'] + Article::where('locataires_id',$id)->pluck('structure_ar' ,'id')->all();
        $listes_mois = [
            null => '- Choisir une option -',
            'Janvier'  => 'Janvier',
            'Fevrier' => 'Fevrier',
            'Mars'  => 'Mars',
            'Avril' => 'Avril',
            'Mai'   => 'Mai',
            'Juin'  => 'Juin',
            'Juillet' => 'Juillet',
            'Août' => 'Août',
            'Septembre' => 'Septembre',
            'Octobre' => 'Octobre',
            'Novembre'  => 'Novembre',
            'Decembre' => 'Decembre',
            'Caution' => 'Caution',
            'Frais Huissier' => 'Frais Huissier',
            'Frais de procedure' => 'Frais de procedure',
        ];
        $heading = "Enregistrer un reglement";

        return view('pages.ressource.reglement', compact('heading','locataire','listes_mois','art','articles','reg','mode'))
            ->with(['subheading' => $this->subheading, 'route' => $this->route, 'form' => $this->form]);

    }

    public function store(ReglementRequest $request)
    {
      //  dd($request);
        $reg = new Reglement();

        $reg->locataires_id = $request->locataires_id;
        $reg->articles_id = $request->articles_id;
        $reg->montant = $request->montant;
        $reg->taxe = $request->taxe;
        $reg->mois_paie = $request->mois_paie;
        $reg->acompte = $request->acompte;
        $reg->complement = $request->complement;
        $reg->transactionreference =  $request->transactionreference;
        $reg->mode_reglement = $request->mode_reglement;
        $reg->users_id = Auth::id();
        $com = new Comptabilite();
        $com->motif = "reglement locataire";
        $com->depot = $reg->montant;
        $com->retrait = 0;
        $com->users_id = Auth::id();
        $com->save();
        //dd($reg);
        $total = Total::first();

        if($total)
        {
            $total->users_id = Auth::id();
            $total->ca = $total->ca + $reg->montant ;
            $total->save();
        }
        else{
            $id = Auth::id();
            Total::create([
                'ca' => $reg->montant ,
                'users_id' => $reg->users_id
            ]);
        }

        $reg->save();

        return redirect()->route('reglements.index')
            ->with('success_msg', 'Reglement effectué avec succès.');
    }

    public function edit(Reglement $reg)
    {
        $heading = "Modifier un Reglement";

        $model = $reg;

        $user = Auth::user();
        if ($user->email == "gomise321@gmail.com")
        {
            $mode = [
                null => '- Choisir une option -',
                'Transaction mobile'  => 'Transaction mobile',
                'Cash' => 'Cash',
                'Transaction bancaire'  => 'Transaction bancaire',
            ];
            $articles =[null => '- Choisir un article -'] + Article::where('locataires_id',$id)->pluck('structure_ar' ,'id')->all();
            $listes_mois = [
                null => '- Choisir une option -',
                'Janvier'  => 'Janvier',
                'Fevrier' => 'Fevrier',
                'Mars'  => 'Mars',
                'Avril' => 'Avril',
                'Mai'   => 'Mai',
                'Juin'  => 'Juin',
                'Juillet' => 'Juillet',
                'Août' => 'Août',
                'Septembre' => 'Septembre',
                'Octobre' => 'Octobre',
                'Novembre'  => 'Novembre',
                'Decembre' => 'Decembre',
            ];
            return view('pages.ressource.editReg', compact('model', 'heading','articles','listes_mois','mode'))
            ->with(['subheading' => $this->subheading, 'route' => $this->route, 'form' => $this->form]);
        }else

        return Redirect::back()->with("error_msg", "Action non autorisée");



    }



    public function update(ReglementRequest $request, Reglement $reg)
    {
        $validated = $request->validated();



        $reg->update($validated);

        return Redirect::route($this->route.'.index')
            ->with('success_msg', 'Modification effectuée avec succès.');

    }



}

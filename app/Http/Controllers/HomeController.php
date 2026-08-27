<?php

namespace App\Http\Controllers;

use App\Article;
use App\Bien;
use App\Comptabilite;
use App\Locataire;
use App\Proprietaire;
use App\Total;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $heading = "Bienvenu(e) sur GESTION KANDER";
        $users = User::all();
        $loc = Locataire::all();
        $pro = Proprietaire::all();
        $bien = Bien::all();
        $art = Article::all();
        $total = Total::first();
        $chiffre= 0;
       // $total_dus = 0;
      //  $ventes_today = 0;

        $date_end = new Carbon();
        $date_start = new Carbon();
       $fadjar =  $date_start->startOfDay();
       $ngone =  $date_end->endOfDay();

        $plus= Comptabilite::where('created_at','>=', $fadjar)->where('created_at','<', $ngone)->sum('depot');
        $moins= Comptabilite::where('created_at','<', $fadjar)->where('created_at','<', $ngone)->sum('retrait');
        $encaisses_today = $plus - $moins;

        return view('home', compact('users','loc','pro','bien','art','total','chiffre','encaisses_today','heading'));
    }
}

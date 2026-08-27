<?php

namespace App\Http\Controllers;

use App\Reglement;
/*use Barryvdh\DomPDF\PDF;
use PDF;*/
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $reg = Reglement::find($id);
        $complements = $reg->locataire->loyer_base - $reg->montant;
        $accompte = - $reg->locataire->loyer_base + $reg->montant;
        $user = Auth::user();
        $dateNow = Carbon::now();
        $dateFinal = $dateNow->toDateTime()->format('d/m/yy');

        $pdf = Pdf::loadView('pages.facture.index', compact('reg','dateFinal','complements','accompte','user'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
}

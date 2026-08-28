
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GES_KANDER</title>

    <style type="text/css">
       /*   thead, tbody {
             border: 1px solid black;
            border-collapse: collapse;
        } */
        .table_reg thead {
                border: 1px solid black;
                 border-collapse: collapse;
        }

        .table_reg tbody {
                border: 1px solid black;
                 border-collapse: collapse;
        }

        .table_inf tr {
                border: 1px solid black;
                 border-collapse: collapse;
        }

        .table_inf td {
                border: 1px solid black;
                 border-collapse: collapse;
        }
        @page {
            margin: 0px;
        }

        body {
            margin: 0px;
        }

        * {
           /* font-family: Verdana, Arial, sans-serif;*/
            font-size: large;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        a {
            color: #fff;
            text-decoration: none;
        }

        table {
            font-size: medium;
        }

         tr td {
            font-weight: bold;
            font-size: medium;
        }

        .invoice table {
            margin: 15px;
        }

        .invoice h3 {
            margin-left: 15px;
        }

        /* .information {
            background-color: #60A7A6;
            color: #FFF;
        }*/

        .information .logo {
            margin: 15px;
        }

        .information table {
            padding: 10px;
        }
    </style>

</head>
<body>

<div class="container">

    <div class="information">
        <table class="table_inf" width="100%">
            @if($user->zone = "Dakar")
            <tr>

                <td align="left" style="width: 50%;">
 {{-- <h3>  </h3> --}}
                    <p>
                    AGENCE IMMOBILIERE KANDER <br>
                     Villa 498 Arafat<br>
                    en face Maternite GRAND YOFF<br>
                     Tel +221 33 867 57 82<br>
                    Email: agikander@gmail.com
                    </p>

                </td>
                <td align="center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" width="80" class="logo"/>
                   QUITTANCE DE LOYER
                    <!-- <h3 style="text-align: center">QUITTANCE DE LOYER</h3> -->
                </td>
               <!--  <td align="center">

                    <h3 style="text-align: center">QUITTANCE DE LOYER</h3>
                </td> -->
                <td align="right" style="width: 50%;">
                    
                        {{$reg->locataire->prenom}}<br>
                        {{$reg->locataire->nom}}<br>
                        {{$reg->locataire->adresse}}
                    
                    {{-- <pre>{{$reg->locataire->prenom}} {{$reg->locataire->nom}}</pre> --}}
                  {{--   <pre>
                        {{$reg->locataire->adresse}}
                    </pre> --}}

                    {{--Identifier: #uniquehash
                    Status: Paid--}}
                  </td>
            </tr>
            @else
            <tr>
                    <td align="left" style="width: 50%;">
                        <p>
                            AGENCE IMMOBILIERE KANDER <br>
                            Tilene Lot N° 200<br>
                            Route des Pavé <br>
                            Tel +221 33 990 16 16<br>
                            Email: agikander1@gmail.com
                        </p>
                        <!-- AGENCE IMMOBILIERE - GERANCE - CONSEIL<br> -->
                     {{-- Villa 498 Arafat<br>
                        en face Maternite GRAND YOFF <br>
                         Tel +221 33 867 57 82<br>
                        Email: agikander@gmail.com --}}
                    </pre>
                </td>
                <td align="center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" width="80" class="logo"/>
                   <pre>QUITTANCE DE LOYER</pre>
                    <!-- <h3 style="text-align: center">QUITTANCE DE LOYER</h3> -->
                </td>
               <!--  <td align="center">
                    <h3 style="text-align: center">QUITTANCE DE LOYER</h3>
                </td> -->
                <td align="right" style="width: 50%;">
                    <pre>
                        {{$reg->locataire->prenom}}
                    </pre>
                    <pre>
                        {{$reg->locataire->nom}}
                    </pre>
                    <pre>
                        {{$reg->locataire->adresse}}
                    </pre>
                    {{-- <pre>{{$reg->locataire->prenom}} {{$reg->locataire->nom}}</pre> --}}
                  {{--   <pre>
                        {{$reg->locataire->adresse}}
                    </pre> --}}

                    {{--Identifier: #uniquehash
                    Status: Paid--}}
             </td>
            </tr>

    @endif
        </table>
    </div>

    <br/>
    <div class="invoice">
        <h3 style="text-align: right;">Date: {{$reg->created_at}}</h3>
        <!-- <h3 style="text-align: center">QUITTANCE DE LOYER</h3> -->
        <div class="row justify-content-left">
            <div class="col-lg-4 col-sm-4">
                <table width="100%" align="left" style="border-spacing: 5px;">
                    <tr>
                        <th>  Numero Reglement : </th>
                        <td><span>{{$reg->id}}</span></td>
                    </tr>
                    <tr>
                        <th>Mois du paiement :</th>
                        <td><span>{{$reg->mois_paie}}</span></td>
                    </tr>
                    <tr>
                        <th> Local N° {{$reg->article->id}} :</th>
                        <td><span>{{$reg->article->bien->adresse}}</span></td>
                    </tr>
                    <tr>
                        <th> Proprietaire :</th>
                        <td><span>{{$reg->article->bien->proprietaire->prenom}} {{$reg->article->bien->proprietaire->nom}}</span></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row {{--justify-content-left--}}">
            <div class="col-lg-4 col-sm-4">
                <table width="100%" align="left" style="border-spacing: 2px;">
                    <tr>
                        <th>  Loyer Brut : </th>
                        <td><span>{{$reg->locataire->loyer_base}} FCFA</span></td>
                    </tr>
                    <tr>
                        <th>TOM 3.60% :</th>
                        <td><span>{{$reg->locataire->total_loyer *0.036}}</span></td>
                    </tr>
                    <tr>
                        <th>TLV/Enr 2.00% :</th>
                        <td><span>{{$reg->locataire->total_loyer *0.02}}</span></td>
                    </tr>
                    <tr>
                        <th>Net a payer :</th>
                        <td><span>{{$reg->locataire->total_loyer}} FCFA</span></td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
    <div>
        <table>
            <tr>
                <td colspan="20">

                </td>
            </tr>
        </table>
    </div>
    @if( $reg->montant  < $reg->locataire->loyer_base  )
    <div class="container">
        <div class="detail">
            <h3 style="text-align: center">REGLEMENT</h3>
            <table class="table_reg" width="100%" style="border:1px solid black">
                <thead>
                <tr>
                    <td>
                        Montant
                    </td>
                    <td>
                        Taxe
                    </td>
                    <td>
                        Total
                    </td>
                    <td>
                        Mode Reglement
                    </td>
                   <!--  <td>
                        Complements
                    </td> -->
                    <td scope="col">
                        Details Reglements
                    </td>
                           <td>
                        Observations
                    </td>
                </tr>
                </thead>
                <tbody >
                <tr>
                    <td>
                        {{ $reg->montant }} Fcfa
                    </td>
                    <td>
                        {{ $reg->taxe ? $reg->taxe.' Fcfa' : '-' }}
                    </td>
                    <td>
                        {{ $reg->montant + ($reg->taxe ?? 0) }} Fcfa
                    </td>
                    <td>
                        {{ $reg->mode_reglement }}
                    </td>
                   <!--  <td>
                        {{$complements}} FCFA
                       {{-- @php
                        $reg->locataire->loyer_base - $reg->montant
                        @endphp--}}
                       {{-- {{$reg->locataire->loyer_base}} -  {{ $reg->montant }}--}}
                    </td> -->
                    <td >
                    {{ $reg->transactionreference }}
                    </td>
                    <td colspan="5" scope="col">

                   </td>
                </tr>
                 <tr rowspan="4">
                    <td > </td>
                    <td > </td>
                    <td > </td>
                    <td > </td>
                </tr>
                </tbody>
                {{-- <tfoot>
                 <tr>
                     <td colspan="1"></td>
                     <td align="left">Total</td>
                     <td align="left" class="gray">€15,-</td>
                 </tr>
                 </tfoot>--}}
            </table>
        </div>
        @elseif($reg->montant  > $reg->locataire->loyer_base)
        <div class="detail">
            <h3 style="text-align: center">REGLEMENT</h3>
            <table class="table_reg" width="100%" style="border:1px solid black">
                <thead>
                <tr>
                    <td>
                        Montant
                    </td>
                    <td>
                        Taxe
                    </td>
                    <td>
                        Total
                    </td>
                    <td>
                        Mode Reglement
                    </td>
                    <td scope="col">
                        Details Reglements
                    </td>
                    <td>
                        Observations
                    </td>
                </tr>
                </thead>
                <tbody >
                <tr>
                    <td>
                        {{ $reg->montant }} Fcfa
                    </td>
                    <td>
                        {{ $reg->taxe ? $reg->taxe.' Fcfa' : '-' }}
                    </td>
                    <td>
                        {{ $reg->montant + ($reg->taxe ?? 0) }} Fcfa
                    </td>
                    <td>
                        {{ $reg->mode_reglement }}
                    </td>
                   <!--  <td>
                        {{$accompte}} FCFA
                        {{-- @php
                         $reg->locataire->loyer_base - $reg->montant
                         @endphp--}}
                        {{-- {{$reg->locataire->loyer_base}} -  {{ $reg->montant }}--}}
                    </td> -->
                    <td >
                   {{ $reg->transactionreference }}
                    </td>
                    <td colspan="5" scope="col">

                   </td>
                </tr>
                <tr rowspan="4">
                    <td > </td>
                    <td > </td>
                    <td > </td>
                    <td > </td>
                </tr>
                </tbody>
                {{-- <tfoot>
                 <tr>
                     <td colspan="1"></td>
                     <td align="left">Total</td>
                     <td align="left" class="gray">€15,-</td>
                 </tr>
                 </tfoot>--}}
            </table>
        </div>
    @else
        <div class="detail">
            <h3 style="text-align: center">REGLEMENT</h3>
            <table class="table_reg" width="100%" style="border:1px solid black">
                <thead>
                <tr>
                    <td scope="col">
                        Mois du Paiement
                    </td>
                    <td>
                        Montant
                    </td>
                    <td>
                        Taxe
                    </td>
                    <td>
                        Total
                    </td>
                    <td>
                        Mode Reglement
                    </td>
                    <td scope="col">
                        Details Reglements
                    </td>
                     <td>
                        Observations
                    </td>
                </tr>
                </thead>
                <tbody >
                <tr>
                    <td class="uk-text-nowrap" scope="row">
                        {{ $reg->mois_paie }}
                    </td>
                    <td>
                        {{ $reg->montant }} Fcfa
                    </td>
                    <td>
                        {{ $reg->taxe ? $reg->taxe.' Fcfa' : '-' }}
                    </td>
                    <td>
                        {{ $reg->montant + ($reg->taxe ?? 0) }} Fcfa
                    </td>
                    <td>
                        {{ $reg->mode_reglement }}
                    </td>
                   <td >
                   {{ $reg->transactionreference }}
                    </td>
                    <td colspan="5" scope="col">

                   </td>
                </tr>
                <tr rowspan="4">
                    <td > </td>
                    <td > </td>
                    <td > </td>
                    <td > </td>

                </tr>

                </tbody>
                {{-- <tfoot>
                 <tr>
                     <td colspan="1"></td>
                     <td align="left">Total</td>
                     <td align="left" class="gray">€15,-</td>
                 </tr>
                 </tfoot>--}}
            </table>
        </div>
        </div>
    @endif



    <div class="information" style="position: absolute; bottom: 0;">
        <table width="100%">
            <tr>
                <td align="left" style="width: 50%;">
                    &copy; {{ date('Y') }} {{ config('app.name') }} - All rights reserved.
                </td>
                <td align="right" style="width: 50%;">
                    AGENT : {{ auth()->user()->prenom ?? '' }} {{ auth()->user()->nom ?? '' }}
                </td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>{{--
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>GES_KANDER</title>

    <style>
        .invoice-box {
            max-width: 830px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;

        }

        .table {
            display: table;
        }
        .tr {
            display: table-row;
        }
        .highlight {
            background-color: greenyellow;
            display: table-cell;
        }



        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;

        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
            border-bottom: 4px solid #eee;
        }

        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }

      /*  .invoice-box table tr.item.last td {
            border-bottom: none;
        }*/

        .invoice-box table tr.total td:nth-child(3) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }



    </style>
</head>

<body>
<div class="invoice-box">
   --}}
{{-- <table>--}}{{--

        --}}
{{--<tr class="top">--}}{{--


            --}}
{{--<td colspan="4">--}}{{--

                <header>
                    <table>
                        <tr class="top">
                            <td colspan="5">
                                <table class="table">
                                    <tr>
                                        <td class="title">
                                            --}}
{{-- KANDER IMMO DAKAR<br>
                                             AGENCE IMMOBILIERE - GERANCE - CONSEIL<br>
                                             Villa 498 Arafat<br> en face Maternite GRAND YOFF <br>
                                             Tel +221 33 867 57 82<br>
                                             Email: agikander@gmail.com--}}{{--

                                            <img class="logo_regular" src="{{ asset('images/logo.png') }}" alt="" width="200px"  />
                                        </td>

                                        <td width="100%" border ="1" cellspacing="1" cellpadding="1">
                                            <strong>Locataire</strong><br>
                                            {{$reg->locataire->prenom}} {{$reg->locataire->nom}}<br>
                                            {{$reg->locataire->adresse}}<br>
                                            Tel: +221 {{$reg->locataire->telephone}}

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        --}}
{{-- <tr>
                             <td class="title">FACTURE</td>
                             <td>
                                 Facture #: {{$reg->id}}<br>
                                 Date: {{ $DateFinal }}<br>
                                --}}{{--
--}}
{{-- Date Commande: {{ $comm[0]->date }}<br>
                                 Date Livraison: {{ $comm[0]->dateLiv }}--}}{{--
--}}
{{--
                             </td>
                         </tr>--}}{{--

                    </table>
                </header>
          --}}
{{--  </td>
        </tr>
--}}{{--

   <main>
       <span style="text-align: center"><strong>QUITTANCE DE LOYER</strong></span>
       <table class="table">
           <tr class="information">
               --}}
{{--
                           <td colspan="5">
                               <table>
                                   <tr>
                                       <td>
                                           KANDER IMMO DAKAR<br>
                                           AGENCE IMMOBILIERE - GERANCE - CONSEIL<br>
                                           Villa 498 Arafat<br> en face Maternite GRAND YOFF <br>
                                           Tel +221 33 867 57 82<br>
                                           Email: agikander@gmail.com
                                       </td>

                                       <td>
                                           <strong>Locataire</strong><br>
                                           {{$reg->locataire->prenom}} {{$reg->locataire->nom}}<br>
                                           {{$reg->locataire->adresse}}<br>
                                           Tel: +221 {{$reg->locataire->telephone}}

                                       </td>
                                   </tr>
                               </table>
                           </td>
               --}}{{--

               <div class="row justify-content-center">
                   <div class="col-lg-6 col-sm-6">
                       <table class="table table-bordered">
                           <tr>
                               <th>  Numero Reglement : </th>
                               <td><span>{{$reg->id}}</span></td>

                           </tr>
                           <tr>

                               <th>Mois du paiement :</th>
                               <td><span>{{$reg->mois_paie}}</span></td>

                           </tr>
                           <tr>

                               <th> Local N° {{$reg->article->id}} :</th>
                               <td><span>{{$reg->article->bien->adresse}}</span></td>
                           </tr>
                           <tr>

                               <th> Proprietaire :</th>
                               <td><span>{{$reg->article->bien->proprietaire->prenom}} {{$reg->article->bien->proprietaire->nom}}</span></td>
                           </tr>
                       </table>

                   </div>
               </div>
           </tr>
       </table>
       <table class="table table-bordered">
           <tr >
               <td>
                   Mois du Paiement
               </td>

               <td>
                   Montant
               </td>
               <td>
                   Mode Reglement
               </td>
               <td>
                   References
               </td>


           </tr>

           <tr class="details">
               <td>
                   {{ $reg->mois_paie }}
               </td>

               <td>
                   {{ $reg->montant }} Fcfa
               </td>
               <td>
                   {{ $reg->mode_reglement }}
               </td>
               <td>
                   {{ $reg->id }}
               </td>
           </tr>
       </table>
   </main>

   --}}
{{-- </table>--}}{{--

   --}}
{{-- <h2>Montant Total: {{$comm[0]->mtn}} Fcfa</h2>
    <h2>Réduction: {{ ($comm[0]->reduction) ? $comm[0]->reduction : '0' }} Fcfa</h2>
    <h2>Avance: {{ ($comm[0]->avance) ? $comm[0]->avance : '0' }} Fcfa</h2>
    <h2>Montant Total Restant: {{$comm[0]->mtn-$comm[0]->avance}} Fcfa</h2>--}}{{--

    <footer class="invoice_footer">


                <p>

                    AGENCE IMMOBILIERE - GERANCE - CONSEIL<br>
                    Villa 498 Arafat en face Maternite GRAND YOFF <br>
                    Tel +221 33 867 57 82<br>
                    Email: agikander@gmail.com
                </p>




    </footer>
</div>

</body>
</html>
--}}

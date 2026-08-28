<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #222; }
        .header { text-align: center; margin-bottom: 10px; }
        .header h1 { font-size: 16px; margin: 0; }
        .header p { margin: 2px 0; }
        .proprio-box { border: 1px solid #333; padding: 8px; margin-bottom: 12px; }
        table.liste { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
        table.liste th, table.liste td { border: 1px solid #333; padding: 5px 7px; text-align: left; }
        table.liste th { background-color: #eee; }
        table.totaux { width: 60%; margin-left: auto; border-collapse: collapse; }
        table.totaux th, table.totaux td { border: 1px solid #333; padding: 6px 8px; }
        table.totaux th { text-align: left; background-color: #f7f7f7; }
        table.totaux td { text-align: right; }
        .montant-net td { font-size: 14px; font-weight: bold; }
        .signature { margin-top: 40px; text-align: right; }
        .footer-agence { margin-top: 30px; text-align: right; font-size: 10px; color: #555; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Agence Immobilière KANDER</h1>
        <p>GÉRANCE DE {{ strtoupper($situation->mois) }} {{ $situation->annee }}</p>
    </div>

    <div class="proprio-box">
        Propriétaire : <strong>{{ optional($situation->proprietaire)->prenom }} {{ optional($situation->proprietaire)->nom }}</strong><br>
        Adresse : {{ optional($situation->proprietaire)->adresse }}
    </div>

    <table class="liste">
        <thead>
            <tr>
                <th>Locataire</th>
                <th>Immeuble</th>
                <th>Mois payé</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>
            @forelse($situation->reglements as $reg)
                <tr>
                    <td>{{ optional($reg->locataire)->prenom }} {{ optional($reg->locataire)->nom }}</td>
                    <td>{{ optional(optional($reg->article)->bien)->adresse }}</td>
                    <td>{{ $reg->mois_paie }}</td>
                    <td>{{ number_format($reg->montant, 0, ',', ' ') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Aucun règlement encaissé sur cette période.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <table class="totaux">
        <tr>
            <th>TOTAL ENCAISSÉ</th>
            <td>{{ number_format($situation->total_encaisse, 0, ',', ' ') }}</td>
        </tr>
        <tr>
            <th>DÉPENSES</th>
            <td>{{ number_format($situation->total_depenses, 0, ',', ' ') }}</td>
        </tr>
        <tr>
            <th>COMMISSION DE GÉRANCE ({{ rtrim(rtrim(number_format($situation->commission_taux, 2), '0'), '.') }}%)</th>
            <td>{{ number_format($situation->commission_montant, 0, ',', ' ') }}</td>
        </tr>
        <tr class="montant-net">
            <th>MONTANT NET REMIS AU PROPRIÉTAIRE</th>
            <td>{{ number_format($situation->montant_net, 0, ',', ' ') }} francs</td>
        </tr>
    </table>

    <div class="signature">
        Dakar, le {{ $situation->created_at->format('d/m/Y') }}<br>
        Le Gérant
    </div>

    <div class="footer-agence">
        Agence Immobilière Kander — Villa N°498 Arafat face Maternité Gd Yoff — Tél : 33 867 57 82
    </div>
</body>
</html>

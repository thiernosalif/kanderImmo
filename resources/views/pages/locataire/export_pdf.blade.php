<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 4px; }
        p.date { text-align: center; margin-top: 0; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { border: 1px solid #333; padding: 6px 8px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Liste des locataires</h2>
    <p class="date">Exporté le {{ $dateNow }}</p>

    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>CIN</th>
                <th>Total loyer</th>
                <th>Adresse</th>
                <th>Téléphone</th>
            </tr>
        </thead>
        <tbody>
            @foreach($locataires as $locataire)
                <tr>
                    <td>{{ $locataire->prenom }}</td>
                    <td>{{ $locataire->nom }}</td>
                    <td>{{ $locataire->cin }}</td>
                    <td>{{ $locataire->total_loyer }}</td>
                    <td>{{ $locataire->adresse }}</td>
                    <td>{{ $locataire->telephone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

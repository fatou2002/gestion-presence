<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Liste des Présences</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f5f5f5; }
    </style>
</head>
<body>
<h2>Liste des Présences</h2>
<table>
    <thead>
    <tr>
        <th>Nom</th>
        <th>Date</th>
        <th>Heure d'arrivée</th>
        <th>Heure de départ</th>
    </tr>
    </thead>
    <tbody>
    @foreach($presences as $presence)
        <tr>
            <td>{{ $presence->user->name }}</td>
            <td>{{ $presence->date }}</td>
            <td>{{ $presence->heure_arrivee }}</td>
            <td>{{ $presence->heure_depart }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>

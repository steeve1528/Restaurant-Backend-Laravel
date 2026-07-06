<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Plan de Salle</title>
    <style>
        .salle {
            position: relative;
            width: 850px;
            height: 550px;
            background-color: #f0f0f0;
            border: 2px solid #333;
            margin-top: 15px;
        }
        .table-bloc {
            position: absolute;
            width: 110px;
            height: 110px;
            border: 2px solid #000;
            text-align: center;
            font-family: Arial, sans-serif;
            font-size: 11px;
            padding: 2px;
            box-sizing: border-box;
        }
        /* Couleurs simples pour les états */
        .libre { background-color: #a3e4d7; }
        .a_nettoyer { background-color: #f9e79f; }
        .occupee { background-color: #f9ebd2; }
        .reservee { background-color: #fcedc9; }
        .hors_service { background-color: #d5dbdb; }

        .actions {
            margin-top: 3px;
        }
        .actions form {
            display: inline;
        }
        .actions button {
            font-size: 8px;
            padding: 1px 3px;
            margin: 1px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h1>Gestion des Tables - Plan de Salle</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <div class="salle">
        @foreach($tables as $table)
            <div class="table-bloc {{ $table->etat }}" 
                 style="left: {{ $table->position_x }}%; top: {{ $table->position_y }}%; border-radius: {{ $table->forme == 'rond' ? '50%' : '4px' }};">
                
                <strong>{{ $table->numero }}</strong> ({{ $table->capacite }} pl)
                
                <!-- Tous les boutons originaux avec des formulaires simples -->
                <div class="actions">
                    <form action="{{ url('/tables/'.$table->id.'/reserver') }}" method="POST">@csrf<button type="submit">Réserver</button></form>
                    <form action="{{ url('/tables/'.$table->id.'/installer') }}" method="POST">@csrf<button type="submit">Installer</button></form>
                    <form action="{{ url('/tables/'.$table->id.'/partir') }}" method="POST">@csrf<button type="submit">Partis</button></form>
                    <form action="{{ url('/tables/'.$table->id.'/nettoyer') }}" method="POST">@csrf<button type="submit">Nettoyer</button></form>
                    <form action="{{ url('/tables/'.$table->id.'/liberer') }}" method="POST">@csrf<button type="submit">Libérer</button></form>
                    <form action="{{ url('/tables/'.$table->id.'/hors-service') }}" method="POST">@csrf<button type="submit">HS</button></form>
                </div>

            </div>
        @endforeach
    </div>

</body>
</html>

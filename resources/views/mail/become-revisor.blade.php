<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Nuova richiesta revisore</h1>

    <p>L'utente seguente ha richiesto di diventare revisore:</p>

    <ul>
        <li><strong>Nome:</strong> {{ $user->name }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
    </ul>

   <p>
        <a href="{{ route('make.revisor', $user) }}">Rendi questo utente revisore</a>
    </p>
</body>
</html>
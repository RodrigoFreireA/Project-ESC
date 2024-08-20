<!-- resources/views/home.blade.php -->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .button-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .button-container a {
            display: block;
            padding: 15px 30px;
            text-align: center;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .button-container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="button-container">
        <a href="{{ route('funcionarios.create') }}">Cadastrar Funcionário</a>
        <a href="{{ route('ausencias.create') }}">Cadastrar Ausências</a>
        <a href="{{ route('escalas.create') }}">Gerar Escala</a>
    </div>
</body>
</html>

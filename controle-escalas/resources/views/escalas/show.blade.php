<!-- resources/views/escalas/show.blade.php -->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escalas de {{ $funcionario->nome }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <a href="{{ route('home') }}">Voltar para o início</a>
        <h1>Escalas de {{ $funcionario->nome }}</h1>

        @if($escalas->count())
            <table>
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Horário Início</th>
                        <th>Horário Fim</th>
                        <th>Recorrente</th>
                    </tr>
                </thead>
                <tbody>
    @foreach($escalas as $escala)
        <tr>
            <td>{{ $escala->data }}</td>
            <td>{{ $escala->horario_inicio }}</td>
            <td>{{ $escala->horario_fim }}</td>
            <td>{{ $escala->observacoes }}</td> <!-- Alterado aqui -->
        </tr>
    @endforeach
</tbody>
            </table>
        @else
            <p>Este funcionário não possui escalas cadastradas.</p>
        @endif
    </div>
</body>
</html>

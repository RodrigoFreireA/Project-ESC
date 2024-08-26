<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escalas de {{ $funcionario->nome }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .pagination {
            margin-top: 20px;
            text-align: center;
        }
    </style>
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
                        <th>Observações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($escalas as $escala)
                        @foreach(explode(', ', $escala['data']) as $data) <!-- Iterar sobre as datas -->
                            <tr>
                                <td>{{ \Carbon\Carbon::parse(trim($data))->format('d-m-Y') }}</td>
                                <td>{{ $escala['horario_inicio'] }}</td>
                                <td>{{ $escala['horario_fim'] }}</td>
                                <td>{{ $escala['observacoes'] ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>

            <div class="pagination">
                {{ $escalas->links() }}
            </div>
        @else
            <p>Este funcionário não possui escalas cadastradas.</p>
        @endif
    </div>
</body>
</html>

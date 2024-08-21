<!-- resources/views/escalas/selecionar.blade.php -->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecionar Funcionários</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* Seu CSS aqui */
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('home') }}">Voltar para o início</a>

        <h1>Selecionar Funcionários</h1>
        <form action="{{ route('escalas.selecionar') }}" method="GET" class="search-container">
            <div class="form-group">
                <label for="search">Pesquisar Funcionários:</label>
                <input type="text" name="search" id="search" value="{{ old('search', $search) }}" placeholder="Digite o nome do funcionário">
                <button type="submit">Pesquisar</button>
            </div>
        </form>

        @if($funcionarios->count())
        <form action="{{ route('escalas.registrar') }}" method="POST">
    @csrf
    <table>
        <thead>
            <tr>
                <th>Selecionar</th>
                <th>Nome</th>
                <th>Tipo de Escala</th>
                <th>Localização</th>
                <th>Unidade Atendida</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($funcionarios as $funcionario)
                <tr>
                    <td>
                        <input type="checkbox" name="selecionados[]" value="{{ $funcionario->id }}">
                    </td>
                    <td>{{ $funcionario->nome }}</td>
                    <td>{{ $funcionario->tipo_escala }}</td>
                    <td>{{ $funcionario->localizacao }}</td>
                    <td>{{ $funcionario->unidade_atendida }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="form-group">
        <button type="submit">Prosseguir para criar Escala</button>
    </div>
</form>

        @else
            <p>Nenhum funcionário encontrado.</p>
        @endif
    </div>
</body>
</html>

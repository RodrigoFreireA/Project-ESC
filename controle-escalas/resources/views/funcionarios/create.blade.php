<!-- resources/views/funcionarios/create.blade.php -->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Funcionário</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h1>Cadastrar Funcionário</h1>

        <!-- Formulário de Cadastro -->
        <form action="{{ route('funcionarios.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
                @error('nome')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="tipo_escala">Tipo de Escala:</label>
                <select id="tipo_escala" name="tipo_escala" required>
                    <option value="diarista">Diarista</option>
                    <option value="12x36">12x36</option>
                </select>
                @error('tipo_escala')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="localizacao">Localização (Cidade/Estado):</label>
                <input type="text" id="localizacao" name="localizacao" required>
                @error('localizacao')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="unidade_atendida">Unidade Atendida:</label>
                <input type="text" id="unidade_atendida" name="unidade_atendida" required>
                @error('unidade_atendida')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit">Salvar</button>
        </form>
        
        <a href="{{ route('home') }}">Voltar para o início</a>
        
        <!-- Tabela de Funcionários -->
        <h2>Lista de Funcionários</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Tipo de Escala</th>
                    <th>Localização</th>
                    <th>Unidade Atendida</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($funcionarios as $funcionario)
                    <tr>
                        <td>{{ $funcionario->id }}</td>
                        <td>{{ $funcionario->nome }}</td>
                        <td>{{ $funcionario->tipo_escala }}</td>
                        <td>{{ $funcionario->localizacao }}</td>
                        <td>{{ $funcionario->unidade_atendida }}</td>
                        <td>
                            <!-- Link para Atualizar -->
                            <a href="{{ route('funcionarios.edit', $funcionario->id) }}">Atualizar</a>

                            <!-- Formulário para Deletar -->
                            <form action="{{ route('funcionarios.destroy', $funcionario->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Você tem certeza que deseja excluir?')">Excluir</button>
                            </form>

                            <!-- Link para Visualizar Escalas -->
                            <a href="{{ route('escalas.show', ['funcionario' => $funcionario->id]) }}">Visualizar Escalas</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

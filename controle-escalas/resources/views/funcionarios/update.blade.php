<!-- resources/views/funcionarios/update.blade.php -->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Funcionário</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h1>Atualizar Funcionário</h1>

        <!-- Formulário de Atualização -->
        <form action="{{ route('funcionarios.update', $funcionario->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="{{ $funcionario->nome }}" required>
                @error('nome')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="tipo_escala">Tipo de Escala:</label>
                <select id="tipo_escala" name="tipo_escala" required>
                    <option value="diarista" {{ $funcionario->tipo_escala === 'diarista' ? 'selected' : '' }}>Diarista</option>
                    <option value="12x36" {{ $funcionario->tipo_escala === '12x36' ? 'selected' : '' }}>12x36</option>
                </select>
                @error('tipo_escala')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="localizacao">Localização (Cidade/Estado):</label>
                <input type="text" id="localizacao" name="localizacao" value="{{ $funcionario->localizacao }}" required>
                @error('localizacao')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="unidade_atendida">Unidade Atendida:</label>
                <input type="text" id="unidade_atendida" name="unidade_atendida" value="{{ $funcionario->unidade_atendida }}" required>
                @error('unidade_atendida')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit">Atualizar</button>
            <a href="{{ route('funcionarios.create') }}">Cancelar</a>
        </form>
    </div>
</body>
</html>

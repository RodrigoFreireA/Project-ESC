<!-- resources/views/escalas/registrar.blade.php -->

<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerar Escala</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        /* Seu CSS aqui */
        .data-unico-dia {
            display: none;
        }
    </style>
</head>
<body>

    <div class="container">
        <a href="{{ route('home') }}">Voltar para o início</a>

        <h1>Gerar Escala</h1>
        <form action="{{ route('escalas.store') }}" method="POST">
            @csrf
            @foreach ($funcionarios as $funcionario)
                <div class="form-group">
                    <input type="hidden" name="escalas[{{ $funcionario->id }}][funcionario_id]" value="{{ $funcionario->id }}">

                    <h2>{{ $funcionario->nome }}</h2>

                    <div>
                        <label for="funcionario-{{ $funcionario->id }}-horario_inicio">Horário de Trabalho:</label>
                        <input type="time" name="escalas[{{ $funcionario->id }}][horario_inicio]" id="funcionario-{{ $funcionario->id }}-horario_inicio" required />
                        <input type="time" name="escalas[{{ $funcionario->id }}][horario_fim]" id="funcionario-{{ $funcionario->id }}-horario_fim" required />
                    </div>

                    <div>
                        <label for="funcionario-{{ $funcionario->id }}-datas">Datas:</label>
                        <input type="text" name="escalas[{{ $funcionario->id }}][datas][]" id="funcionario-{{ $funcionario->id }}-datas" placeholder="Selecione as datas" required />
                        </div>

                    <div>
                        <label for="funcionario-{{ $funcionario->id }}-observacoes">Observações:</label>
                        <textarea name="escalas[{{ $funcionario->id }}][observacoes]" id="funcionario-{{ $funcionario->id }}-observacoes"></textarea>
                    </div>
                </div>
            @endforeach

            <div class="form-group">
                <button type="submit">Salvar Escalas</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr('input[type="text"]', {
                mode: "multiple",
                dateFormat: "Y-m-d"
            });
        });
    </script>
</body>
</html>

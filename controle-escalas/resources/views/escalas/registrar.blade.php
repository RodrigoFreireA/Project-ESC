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
        .data-unico-dia, .dias-recorrentes {
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
                <label for="funcionario-{{ $funcionario->id }}-unico_dia">Escala para um único dia:</label>
                <input type="checkbox" name="escalas[{{ $funcionario->id }}][unico_dia]" id="funcionario-{{ $funcionario->id }}-unico_dia" />
            </div>

            <div class="data-unico-dia">
                <label for="funcionario-{{ $funcionario->id }}-data">Data:</label>
                <input type="date" name="escalas[{{ $funcionario->id }}][data]" id="funcionario-{{ $funcionario->id }}-data" />
            </div>
            
            <div class="dias-recorrentes">
                <label for="funcionario-{{ $funcionario->id }}-dias">Dias Recorrentes:</label>
                <input type="text" name="escalas[{{ $funcionario->id }}][dias]" id="funcionario-{{ $funcionario->id }}-dias" placeholder="Segunda, Quarta, Sexta" />
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
            flatpickr('input[type="date"]', {
                dateFormat: "Y-m-d"
            });

            document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const formGroup = this.closest('.form-group');
                    const dataDiv = formGroup.querySelector('.data-unico-dia');
                    const diasDiv = formGroup.querySelector('.dias-recorrentes');
                    
                    if (this.checked) {
                        dataDiv.style.display = 'block';
                        diasDiv.style.display = 'none';
                    } else {
                        dataDiv.style.display = 'none';
                        diasDiv.style.display = 'block';
                    }
                });

                // Inicializa o estado do formulário
                const formGroup = checkbox.closest('.form-group');
                const dataDiv = formGroup.querySelector('.data-unico-dia');
                const diasDiv = formGroup.querySelector('.dias-recorrentes');
                
                if (checkbox.checked) {
                    dataDiv.style.display = 'block';
                    diasDiv.style.display = 'none';
                } else {
                    dataDiv.style.display = 'none';
                    diasDiv.style.display = 'block';
                }
            });
        });
    </script>
</body>
</html>

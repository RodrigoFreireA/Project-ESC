<!-- resources/views/escalas/create.blade.php -->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerar Escala</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        /* Adicione seus estilos personalizados aqui */
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .funcionario-list {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group button {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
        .search-container {
            margin-bottom: 20px;
        }
        .calendar {
            display: flex;
            flex-direction: column;
        }
        .calendar .form-group {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .calendar .form-group input[type="date"], 
        .calendar .form-group input[type="time"] {
            width: 45%;
        }
        .flatpickr-calendar {
            z-index: 9999 !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('home') }}">Voltar para o início</a>

        <h1>Gerar Escala</h1>
        <form action="{{ route('escalas.create') }}" method="GET" class="search-container">
            <div class="form-group">
                <label for="search">Pesquisar Funcionários:</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Digite o nome do funcionário">
                <button type="submit">Pesquisar</button>
            </div>
        </form>

        @if($funcionarios->count())
            <form action="{{ route('escalas.store') }}" method="POST">
                @csrf
                <div class="calendar">
                    @foreach ($funcionarios as $funcionario)
                        <div class="form-group">
                            <label for="funcionario-{{ $funcionario->id }}">{{ $funcionario->nome }}</label>
                            <input type="hidden" name="escalas[{{ $funcionario->id }}][funcionario_id]" value="{{ $funcionario->id }}">
                            
                            <div>
                                <label for="funcionario-{{ $funcionario->id }}-horario_inicio">Horário de Trabalho:</label>
                                <input type="time" name="escalas[{{ $funcionario->id }}][horario_inicio]" id="funcionario-{{ $funcionario->id }}-horario_inicio" />
                                <input type="time" name="escalas[{{ $funcionario->id }}][horario_fim]" id="funcionario-{{ $funcionario->id }}-horario_fim" />
                            </div>

                            <div>
                                <label>É uma escala para um único dia?</label>
                                <input type="checkbox" name="escalas[{{ $funcionario->id }}][unico_dia]" id="unico_dia-{{ $funcionario->id }}" />
                            </div>

                            <div id="dias-recorrentes-{{ $funcionario->id }}" style="display: none;">
                                <label for="funcionario-{{ $funcionario->id }}-dias">Dias Recorrentes:</label>
                                <input type="text" name="escalas[{{ $funcionario->id }}][dias]" id="funcionario-{{ $funcionario->id }}-dias" placeholder="Selecione os dias" />
                            </div>
                            
                            <div id="data-unica-{{ $funcionario->id }}" style="display: none;">
                                <label for="funcionario-{{ $funcionario->id }}-data">Data Única:</label>
                                <input type="date" name="escalas[{{ $funcionario->id }}][data]" id="funcionario-{{ $funcionario->id }}-data" />
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <button type="submit">Gerar Escala</button>
                </div>
            </form>
        @else
            <p>Nenhum funcionário encontrado para a pesquisa.</p>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializa o Flatpickr para seleção de múltiplos dias
            document.querySelectorAll('input[name^="escalas["][name$="[dias]"]').forEach(function(input) {
                flatpickr(input, {
                    mode: 'multiple',
                    dateFormat: 'Y-m-d',
                    onChange: function(selectedDates, dateStr, instance) {
                        // Atualiza o campo oculto com os dias selecionados
                        input.value = selectedDates.map(date => date.toISOString().split('T')[0]).join(',');
                    }
                });
            });

            // Mostrar/ocultar o campo de dias recorrentes com base no checkbox
            document.querySelectorAll('input[name$="[unico_dia]"]').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    var funcionarioId = this.id.replace('unico_dia-', '');
                    var diasContainer = document.getElementById('dias-recorrentes-' + funcionarioId);
                    var dataContainer = document.getElementById('data-unica-' + funcionarioId);
                    if (this.checked) {
                        diasContainer.style.display = 'none';
                        dataContainer.style.display = 'block';
                    } else {
                        diasContainer.style.display = 'block';
                        dataContainer.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Escala;

class EscalaController extends Controller
{
    public function selecionar(Request $request)
    {
        $search = $request->input('search', '');

        $funcionarios = Funcionario::query()
            ->when($search, function ($query, $search) {
                return $query->where('nome', 'like', '%' . $search . '%');
            })
            ->get();

        return view('escalas.selecionar', [
            'funcionarios' => $funcionarios,
            'search' => $search
        ]);
    }

    public function create(Request $request)
    {
        $search = $request->input('search', '');

        $funcionarios = Funcionario::query()
            ->when($search, function ($query, $search) {
                return $query->where('nome', 'like', '%' . $search . '%');
            })
            ->get();

        return view('escalas.create', [
            'funcionarios' => $funcionarios,
            'search' => $search
        ]);
    }

    public function registrar(Request $request)
    {
        $funcionariosSelecionados = $request->input('selecionados', []);

        if (empty($funcionariosSelecionados)) {
            return redirect()->route('escalas.selecionar')->with('error', 'Nenhum funcionário selecionado.');
        }

        $funcionarios = Funcionario::whereIn('id', $funcionariosSelecionados)->get();

        return view('escalas.registrar', compact('funcionarios'));
    }

    public function show(Funcionario $funcionario)
    {
        // Obtém as escalas do funcionário
        $escalas = $funcionario->escalas;

        // Retorna a view com as escalas do funcionário
        return view('escalas.show', compact('funcionario', 'escalas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'escalas' => 'required|array',
            'escalas.*.funcionario_id' => 'required|exists:funcionarios,id',
            'escalas.*.horario_inicio' => 'required|date_format:H:i',
            'escalas.*.horario_fim' => 'required|date_format:H:i',
            'escalas.*.unico_dia' => 'nullable|boolean',
            'escalas.*.data' => 'nullable|required_if:escalas.*.unico_dia,true|date',
            'escalas.*.dias' => 'nullable|required_if:escalas.*.unico_dia,false|string',
            'escalas.*.observacoes' => 'nullable|string',
        ]);

        // Opcional: Limpar as escalas existentes - descomente se precisar
        // Escala::truncate();

        // Processa os dados e salva na tabela escalas
        foreach ($data['escalas'] as $escala) {
            if (!empty($escala['unico_dia'])) {
                // Escala para um único dia
                Escala::create([
                    'funcionario_id' => $escala['funcionario_id'],
                    'data' => $escala['data'],
                    'horario_inicio' => $escala['horario_inicio'],
                    'horario_fim' => $escala['horario_fim'],
                    'observacoes' => $escala['observacoes'],
                    'recorrente' => false,
                ]);
            } elseif (!empty($escala['dias'])) {
                // Escala para múltiplos dias
                $dias = explode(',', $escala['dias']);
                foreach ($dias as $dia) {
                    // Verifique se o dia é uma data válida
                    $dataLimpa = trim($dia);
                    if (strtotime($dataLimpa)) {
                        Escala::create([
                            'funcionario_id' => $escala['funcionario_id'],
                            'data' => $dataLimpa,
                            'horario_inicio' => $escala['horario_inicio'],
                            'horario_fim' => $escala['horario_fim'],
                            'observacoes' => $escala['observacoes'],
                            'recorrente' => true,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('home')->with('success', 'Escalas salvas com sucesso.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Escala;

class EscalaController extends Controller
{
    public function create(Request $request)
    {
        $search = $request->input('search');
        $funcionarios = Funcionario::when($search, function($query, $search) {
            return $query->where('nome', 'like', "%{$search}%");
        })->get();

        return view('escalas.create', compact('funcionarios'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'escalas' => 'required|array',
            'escalas.*.funcionario_id' => 'required|exists:funcionarios,id',
            'escalas.*.horario_inicio' => 'required|date_format:H:i',
            'escalas.*.horario_fim' => 'required|date_format:H:i',
            'escalas.*.unico_dia' => 'boolean',
            'escalas.*.data' => 'nullable|date',
            'escalas.*.dias' => 'nullable|string',
        ]);

        // Limpa as escalas existentes
        Escala::truncate();

        // Processa os dados e salva na tabela escalas
        foreach ($data['escalas'] as $escala) {
            if (!empty($escala['unico_dia'])) {
                // Escala para um único dia
                Escala::create([
                    'funcionario_id' => $escala['funcionario_id'],
                    'data' => $escala['data'],
                    'horario_inicio' => $escala['horario_inicio'],
                    'horario_fim' => $escala['horario_fim'],
                    'recorrente' => false,
                ]);
            } else {
                // Escala para múltiplos dias
                $dias = explode(',', $escala['dias']);
                foreach ($dias as $dia) {
                    Escala::create([
                        'funcionario_id' => $escala['funcionario_id'],
                        'data' => trim($dia),
                        'horario_inicio' => $escala['horario_inicio'],
                        'horario_fim' => $escala['horario_fim'],
                        'recorrente' => true,
                    ]);
                }
            }
        }

        return redirect()->route('home')->with('success', 'Escala gerada com sucesso!');
    }
}

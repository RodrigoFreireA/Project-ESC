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
    $data = $request->input('escalas');

    foreach ($data as $escola) {
        if (isset($escola['funcionario_id'])) {
            $datas = $escola['datas'] ?? []; // Recebe as datas selecionadas e garante que seja um array

            // Verifica se $datas é um array
            if (is_array($datas)) {
                foreach ($datas as $data) {
                    // Armazena a escala no banco
                    Escala::create([
                        'funcionario_id' => $escola['funcionario_id'],
                        'horario_inicio' => $escola['horario_inicio'],
                        'horario_fim' => $escola['horario_fim'],
                        'data' => $data, // Cada data individual
                        'observacoes' => $escola['observacoes'],
                    ]);
                }
            } else {
                // Tratar o caso onde 'datas' não é um array
                \Log::error('Datas não é um array: ', ['datas' => $datas]);
            }
        }
    }
    return redirect()->route('escalas.create')->with('success', 'Escalas salvas com sucesso.');
}


}

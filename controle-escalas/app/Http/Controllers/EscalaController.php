<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Escala;
use Illuminate\Pagination\LengthAwarePaginator; // Adicione esta linha

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
        // Decodifica a coluna data de JSON para array
        $escalas = $funcionario->escalas->flatMap(function ($escala) {
            // Tenta decodificar como JSON
            $data = json_decode($escala->data, true);
    
            // Se a decodificação falhar, exploda a string manualmente
            if (!is_array($data)) {
                $data = explode(', ', $escala->data);
            }
    
            // Limpa possíveis espaços em branco nas datas
            $data = array_map('trim', $data);
    
            // Organiza as datas em linhas com informações adicionais
            return collect($data)->map(function ($date) use ($escala) {
                return [
                    'data' => $date,  // Mantém o formato da data como string
                    'horario_inicio' => $escala->horario_inicio,
                    'horario_fim' => $escala->horario_fim,
                    'observacoes' => $escala->observacoes,
                ];
            });
        });
    
        // Paginação
        $perPage = 10; // Itens por página
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $escalas->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $escalas = new LengthAwarePaginator($currentItems, $escalas->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);
    
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
                        $datas = array_map('trim', $datas); // Remove espaços em branco de cada data
                        $jsonData = json_encode($datas); // Converte para JSON
        
                        Escala::create([
                            'funcionario_id' => $escola['funcionario_id'],
                            'horario_inicio' => $escola['horario_inicio'],
                            'horario_fim' => $escola['horario_fim'],
                            'data' => $jsonData, // Salva como JSON
                            'observacoes' => $escola['observacoes'],
                        ]);
                    } else {
                        \Log::error('Datas não é um array: ', ['datas' => $datas]);
                    }
                }
            }
            return redirect()->route('escalas.create')->with('success', 'Escalas salvas com sucesso.');
        }
        



}

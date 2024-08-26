<?php
namespace App\Http\Controllers;

use App\Models\Escalas;
use Illuminate\Http\Request;

class EscalasController extends Controller
{
    public function store(Request $request)
    {
        // Validação
        $request->validate([
            'funcionario_id' => 'required|exists:funcionarios,id',
            'horario_inicio' => 'required',
            'horario_fim' => 'required',
            'recorrente' => 'required|boolean',
            'data' => 'nullable|string',
            'data_id' => 'required|string',
            'observacoes' => 'nullable|string',
        ]);

        // Criação da escala
        Escalas::create($request->all());

        return redirect()->back()->with('success', 'Escala criada com sucesso.');
    }
}



?>
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    public function home()
    {
        return view('home');
    }
    
    public function create()
    {
        $funcionarios = Funcionario::all(); // Obtém todos os funcionários
        return view('funcionarios.create', compact('funcionarios'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string',
            'tipo_escala' => 'required|in:diarista,12x36',
            'localizacao' => 'required|string',
            'unidade_atendida' => 'required|string',
        ]);

        Funcionario::create($data);
        return redirect()->route('funcionarios.create');
    }

    public function edit($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        return view('funcionarios.update', compact('funcionario'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nome' => 'required|string',
            'tipo_escala' => 'required|in:diarista,12x36',
            'localizacao' => 'required|string',
            'unidade_atendida' => 'required|string',
        ]);

        $funcionario = Funcionario::findOrFail($id);
        $funcionario->update($data);

        return redirect()->route('funcionarios.create');
    }

    public function destroy($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $funcionario->delete();
        return redirect()->route('funcionarios.create');
    }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\AusenciaController;
use App\Http\Controllers\EscalaController;

// Página inicial com os botões
Route::get('/', [FuncionarioController::class, 'home'])->name('home');

// Rotas para Funcionários
Route::prefix('funcionarios')->group(function () {
    Route::get('/create', [FuncionarioController::class, 'create'])->name('funcionarios.create');
    Route::post('/', [FuncionarioController::class, 'store'])->name('funcionarios.store');
    Route::get('/edit/{id}', [FuncionarioController::class, 'edit'])->name('funcionarios.edit');
    Route::put('/{id}', [FuncionarioController::class, 'update'])->name('funcionarios.update');
    Route::delete('/{id}', [FuncionarioController::class, 'destroy'])->name('funcionarios.destroy');
});


Route::prefix('escalas')->group(function () {
    Route::get('/create', [EscalaController::class, 'create'])->name('escalas.create');
    Route::get('/selecionar', [EscalaController::class, 'selecionar'])->name('escalas.selecionar');
    Route::post('/registrar', [EscalaController::class, 'registrar'])->name('escalas.registrar');
    Route::post('/store', [EscalaController::class, 'store'])->name('escalas.store'); // Corrigido
    Route::get('/{funcionario}', [EscalaController::class, 'show'])->name('escalas.show');
});

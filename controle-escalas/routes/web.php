<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\AusenciaController;
use App\Http\Controllers\EscalaController;

// Página inicial com os botões
Route::get('/', [FuncionarioController::class, 'home'])->name('home');

// Rotas para Funcionários
Route::get('/funcionarios/create', [FuncionarioController::class, 'create'])->name('funcionarios.create');
Route::post('/funcionarios', [FuncionarioController::class, 'store'])->name('funcionarios.store');
Route::get('/funcionarios/edit/{id}', [FuncionarioController::class, 'edit'])->name('funcionarios.edit');
Route::put('/funcionarios/{id}', [FuncionarioController::class, 'update'])->name('funcionarios.update');
Route::delete('/funcionarios/{id}', [FuncionarioController::class, 'destroy'])->name('funcionarios.destroy');

// Rotas para Ausências
Route::get('/ausencias/create', [AusenciaController::class, 'create'])->name('ausencias.create');
Route::post('/ausencias', [AusenciaController::class, 'store'])->name('ausencias.store');

// routes/web.php


Route::get('/escalas/create', [EscalaController::class, 'create'])->name('escalas.create');
Route::post('/escalas/store', [EscalaController::class, 'store'])->name('escalas.store');



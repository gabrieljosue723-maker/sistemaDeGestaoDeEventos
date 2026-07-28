<?php

use App\Http\Controllers\GestaoDeEvenosController;
use Illuminate\Support\Facades\Route;



Route::prefix('GestaoDeEventos')->group(function () {
    Route::get('eventos', [GestaoDeEvenosController::class, 'eventos'])->name('gestaoDeEventos-eventos');
    Route::post('cadastrar', [GestaoDeEvenosController::class, 'cadastrar'])->name('gestaoDeEventos-cadastrar');
    Route::post('logar', [GestaoDeEvenosController::class, 'logar'])->name('gestaoDeEventos-logar');
    Route::get('usuarios', [GestaoDeEvenosController::class, 'usuarios'])->name('gestaoDeEventos-usuarios')->middleware('auth');
    Route::post('criarEvento', [GestaoDeEvenosController::class, 'criarEvento'])->name('gestaoDeEventos-criarEvento');
    Route::put('editarEvento/{id}', [GestaoDeEvenosController::class, 'editarEvento'])->name('gestaoDeEventos-editarEvento');
    Route::delete('excluirEvento/{id}', [GestaoDeEvenosController::class, 'excluirEvento'])->name('gestaoDeEventos-excluirEvento');
    Route::get('lixeira', [GestaoDeEvenosController::class, 'lixeira'])->name('gestaoDeEventos-lixeira');
    Route::patch('restaurarEvento/{id}', [GestaoDeEvenosController::class, 'restaurarEvento'])->name('gestaoDeEventos-restaurar');
    Route::delete('deletarPermanente/{id}', [GestaoDeEvenosController::class, 'deletarPermanente'])->name('gestaoDeEventos-deletarPermanente');
});
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProposalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;


// Rotas Públicas
Route::get('/', function () {
    return view('welcome');
});

// Página inicial
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Perfis

Route::resource('profiles', ProfileController::class);
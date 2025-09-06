<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProposalController;
use Illuminate\Support\Facades\Route;

// Rotas Públicas
Route::get('/', function () {
    return view('welcome');
});
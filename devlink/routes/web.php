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

// Rotas Públicas
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/about', [WelcomeController::class, 'about'])->name('about');
Route::get('/contact', [WelcomeController::class, 'contact'])->name('contact');
Route::get('/terms', [WelcomeController::class, 'terms'])->name('terms');
Route::get('/privacy', [WelcomeController::class, 'privacy'])->name('privacy');
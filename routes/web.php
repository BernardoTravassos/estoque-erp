<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('/', fn() => Inertia::render('Produtos'))->name('produtos');
Route::get('/compras', fn() => Inertia::render('Compras'))->name('compras');
Route::get('/vendas', fn() => Inertia::render('Vendas'))->name('vendas');
Route::get('/historico', fn() => Inertia::render('Historico'))->name('historico');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn() => Inertia::render('Dashboard'))->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

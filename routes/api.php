<?php

use App\Http\Controllers\Api\ProdutoController;
use App\Http\Controllers\Api\CompraController;
use App\Http\Controllers\Api\VendaController;
use App\Http\Controllers\Api\HistoricoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('produtos', ProdutoController::class);
Route::post('compras', [CompraController::class, 'store']);
Route::post('/vendas', [VendaController::class, 'store']);
Route::get('/historico', [HistoricoController::class, 'index']);
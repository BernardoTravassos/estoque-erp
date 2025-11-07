<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Compra;
use App\Models\Venda;

class HistoricoController extends Controller
{
    public function index()
    {
    
        $compras = Compra::with(['produtos.produto:id,nome'])
            ->orderByDesc('id')
            ->get()
            ->flatMap(function ($compra) {
                return $compra->produtos->map(function ($item) use ($compra) {
                    return [
                        'id' => $item->id,
                        'produto' => $item->produto->nome ?? 'Produto não encontrado',
                        'quantidade' => $item->quantidade,
                        'precoUnitario' => (float) $item->preco_unitario,
                        'data' => optional($compra->created_at)->format('Y-m-d'),
                    ];
                });
            });

        $vendas = Venda::with(['produtos.produto:id,nome'])
            ->orderByDesc('id')
            ->get()
            ->flatMap(function ($venda) {
                return $venda->produtos->map(function ($item) use ($venda) {
                    return [
                        'id' => $item->id,
                        'produto' => $item->produto->nome ?? 'Produto não encontrado',
                        'quantidade' => $item->quantidade,
                        'precoUnitario' => (float) $item->preco_unitario,
                        'data' => optional($venda->created_at)->format('Y-m-d'),
                    ];
                });
            });

        return response()->json([
            'compras' => $compras->values(),
            'vendas' => $vendas->values(),
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Compra;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'fornecedor' => 'required',
            'produtos' => 'required|array|min:1',
        ]);

        DB::transaction(function() use ($data) {
            
            $compra = Compra::create(['fornecedor' => $data['fornecedor']]);

            foreach ($data['produtos'] as $p) {
                
                $produto = Produto::findOrFail($p['id']);
                $novoEstoque = $produto->estoque + $p['quantidade'];
                $novoCusto = (($produto->custo_medio * $produto->estoque) + ($p['preco_unitario'] * $p['quantidade'])) / $novoEstoque;

                $produto->update([
                    'estoque' => $novoEstoque,
                    'custo_medio' => $novoCusto,
                ]);

                $compra->produtosCompra()->create([
                    'produto_id' => $p['id'],
                    'quantidade' => $p['quantidade'],
                    'preco_unitario' => $p['preco_unitario'],
                ]);
            }
        });

        return response()->json(['message' => 'Compra registrada com sucesso']);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente' => 'required|string',
            'produtos' => 'required|array|min:1',
        ]);

        $total = 0;
        $lucro = 0;

        DB::transaction(function() use ($data, &$total, &$lucro) {
            $venda = Venda::create(['cliente' => $data['cliente']]);

            foreach ($data['produtos'] as $p) {
                $produto = Produto::findOrFail($p['id']);

                if ($produto->estoque < $p['quantidade']) {
                    throw new \Exception("Estoque insuficiente para {$produto->nome}");
                }

                $produto->decrement('estoque', $p['quantidade']);

                $subtotal = $p['preco_unitario'] * $p['quantidade'];
                $lucroProduto = ($p['preco_unitario'] - $produto->custo_medio) * $p['quantidade'];

                $total += $subtotal;
                $lucro += $lucroProduto;

                $venda->produtos()->create([
                    'produto_id' => $p['id'],
                    'quantidade' => $p['quantidade'],
                    'preco_unitario' => $p['preco_unitario'],
                ]);
            }

            $venda->update(['total' => $total, 'lucro' => $lucro]);
        });

        return response()->json(['total' => $total, 'lucro' => $lucro]);
    }
}


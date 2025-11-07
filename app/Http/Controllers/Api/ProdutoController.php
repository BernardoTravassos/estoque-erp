<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index()
    {
        return Produto::select('id', 'nome', 'custo_medio', 'preco_venda', 'estoque')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string',
            'preco_venda' => 'required|numeric',
            'estoque' => 'required|integer|min:0',
        ]);

        $data['custo_medio'] = 0;

        $produto = Produto::create($data);

        return response()->json($produto, 201);
    }
}

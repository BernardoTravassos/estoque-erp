<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'custo_medio', 'preco_venda', 'estoque'];

    public function compras()
    {
        return $this->hasMany(CompraProduto::class, 'produto_id');
    }

    public function vendas()
    {
        return $this->hasMany(VendaProduto::class, 'produto_id');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraProduto extends Model
{
    use HasFactory;

    protected $table = 'compra_produtos';
    protected $fillable = ['compra_id', 'produto_id', 'quantidade', 'preco_unitario'];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'compra_id');
    }
}


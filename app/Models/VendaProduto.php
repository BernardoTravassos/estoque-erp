<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendaProduto extends Model
{
    use HasFactory;

    protected $table = 'venda_produtos';
    protected $fillable = ['venda_id', 'produto_id', 'quantidade', 'preco_unitario'];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }

    public function venda()
    {
        return $this->belongsTo(Venda::class, 'venda_id');
    }
}



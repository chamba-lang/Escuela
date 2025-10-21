<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'precio',
        'foto',
        'estatus',
    ];

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'pedido_productos','producto_id','pedido_id')
            ->withPivot('cantidad')
            ->withTimestamps();
    }
}

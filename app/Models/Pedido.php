<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'cliente_id',
        'total',
        'fecha',
        'estatus',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function pedidoProductos()
    {
        return $this->hasMany(PedidoProducto::class);
    }
}

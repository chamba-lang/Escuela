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
    public function productos()
    {
        return $this->belongsToMany(Producto::class,'pedido_productos','pedido_id','producto_id')
            ->withPivot('cantidad')->withTimestamps();
    }
  /*   public function pedidoProductos()
    {
        return $this->hasMany(PedidoProducto::class);
    } */
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoProducto extends Model
{
    protected $fillable = [
        'producto_id',
        'pedido_id',
        'cantidad',
    ];
}

/* namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PedidoProducto extends Pivot
{
    public $incrementing = true;

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
 */

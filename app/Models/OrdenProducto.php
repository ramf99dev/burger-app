<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrdenProducto extends Pivot
{
    protected $table = 'ordenes_productos';

    public $incrementing = true;

    protected $fillable = [
        'orden_id',
        'producto_id',
        'cantidad',
        'precio_producto',
        'subtotal'
    ];

    public function orden()
    {
        return $this->belongsTo(Orden::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
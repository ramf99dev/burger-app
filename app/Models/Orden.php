<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'ordenes';

    protected $fillable = [
        'user_id',
        'total',
        'estado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ordenProductos()
    {
        return $this->hasMany(OrdenProducto::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'ordenes_productos')
            ->using(OrdenProducto::class)
            ->withPivot(['cantidad', 'precio_producto', 'subtotal']);
    }

    public function reserva()
    {
        return $this->hasOne(Reserva::class);
    }
}

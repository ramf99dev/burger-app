<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'categoria_id',
        'precio',
        'descripcion',
        'imagen'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function ordenes()
    {
        return $this->belongsToMany(Orden::class, 'ordenes_productos')
            ->withPivot(['cantidad', 'precio_producto', 'subtotal'])
            ->withTimestamps();
    }
}

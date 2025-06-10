<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'numero_personas',
        'fecha',
        'hora',
        'zona_id',
        'orden_id',
        'user_id'
    ];

    public function orden()
    {
        return $this->belongsTo(Orden::class);
    }

    /**
     * Get the user who made the reservation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }
}
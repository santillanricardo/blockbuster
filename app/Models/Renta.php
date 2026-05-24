<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Renta extends Model
{
    protected $fillable = ['cliente_id', 'pelicula_id', 'fecha_renta', 'fecha_devolucion', 'estatus'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function pelicula()
    {
        return $this->belongsTo(Pelicula::class);
    }
}
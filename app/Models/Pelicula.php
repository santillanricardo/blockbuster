<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    protected $fillable = ['titulo', 'genero', 'anio', 'sinopsis', 'copias_disponibles', 'imagen'];

    public function rentas()
    {
        return $this->hasMany(Renta::class);
    }
}
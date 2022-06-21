<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensajero extends Model
{
    use HasFactory;
    protected $table = "mensajeros";
    protected $fillable = [
        'cedula',
        'nombre',
        'telefono'
    ];

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('cedula', 'LIKE', "%$keyword%")
            ->orWhere('nombre', 'LIKE', "%$keyword%");
    }

}

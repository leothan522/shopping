<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = "clientes";
    protected $fillable = [
        'cedula',
        'nombre',
        'telefono',
        'direccion_1',
        'direccion_2',
        'users_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('cedula', 'LIKE', "%$keyword%")
            ->orWhere('nombre', 'LIKE', "%$keyword%")
            ->orWhere('telefono', 'LIKE', "%$keyword%");
    }

}

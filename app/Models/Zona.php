<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    use HasFactory;
    protected $table = "zonas";
    protected $fillable = [
        'nombre',
        'precio'
    ];

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('nombre', 'LIKE', "%$keyword%");
    }

    public function delivery()
    {
        return $this->hasMany(Delivery::class, 'zonas_id', 'id');
    }


}

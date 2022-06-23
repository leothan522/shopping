<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;
    protected $table = "almacenes";
    protected $fillable = [
        'nombre'
    ];


    public function scopeBuscar($query, $keyword)
    {
        return $query->where('nombre', 'LIKE', "%$keyword%");
    }

    public function stock()
    {
        return $this->hasMany(Stock::class, 'almacenes_id', 'id');
    }


}

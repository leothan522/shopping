<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = "categorias";
    protected $fillable = [
        'nombre',
        'imagen',
        'miniatura',
        'num_productos',
        'tipo'
    ];

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('nombre', 'LIKE', "%$keyword%");
    }

    public function productos()
    {
        return $this->hasMany(Producto::class, 'categorias_id', 'id');
    }

    public function empresas()
    {
        return $this->hasMany(Empresa::class, 'categorias_id', 'id');
    }

}

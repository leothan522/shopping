<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'productos';
    protected $fillable = [
        'nombre',
        'categorias_id',
        'sku',
        'imagen',
        'miniatura',
        'detail',
        'cart',
        'descripcion',
        'marca',
        'modelo',
        'referencia',
        'unidad',
        'decimales',
        'impuesto',
        'individual',
        'estatus',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categorias_id', 'id');
    }

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('nombre', 'LIKE', "%$keyword%")
            ->orWhere('sku', 'LIKE', "%$keyword%")
            ->orWhere('marca', 'LIKE', "%$keyword%")
            ->orWhere('modelo', 'LIKE', "%$keyword%")
            ->orWhere('referencia', 'LIKE', "%$keyword%");
    }

    public function stock()
    {
        return $this->hasMany(Stock::class, 'productos_id', 'id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "stock";
    protected $fillable = [
        'empresas_id',
        'productos_id',
        'almacenes_id',
        'moneda',
        'pvp',
        'stock_disponible',
        'stock_comprometido',
        'stock_vendido',
        'estatus',
        'oferta',
        'descuento'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresas_id', 'id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'productos_id', 'id');
    }

    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'almacenes_id', 'id');
    }

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('id', 'LIKE', "%$keyword%");
    }

}

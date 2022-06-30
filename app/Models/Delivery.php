<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $table = "deliverys";
    protected $fillable = [
        'users_id',
        'zonas_id',
        'estatus',
        'precio_dolar',
        'precio_delivery',
        'bs',
        'nombre',
        'pedidos_id',
        'mensajeros_id'
    ];

    public function zona()
    {
        return $this->belongsTo(Zona::class, 'zonas_id', 'id');
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedidos_id', 'id');
    }

    public function mensajero()
    {
        return $this->belongsTo(Mensajero::class, 'mensajeros_id', 'id');
    }

}

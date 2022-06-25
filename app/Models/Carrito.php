<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;
    protected $table = "carrito";
    protected $fillable = [
        'users_id',
        'stock_id',
        'cantidad',
        'estatus'
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

}

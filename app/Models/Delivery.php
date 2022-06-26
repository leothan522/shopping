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
        'estatus'
    ];

    public function zona()
    {
        return $this->belongsTo(Zona::class, 'zonas_id', 'id');
    }

}

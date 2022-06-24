<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = "empresas";
    protected $fillable = [
        'rif',
        'nombre',
        'logo',
        'miniatura',
        'banner',
        'direccion',
        'telefono',
        'email',
        'default'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'empresas_id', 'id');
    }

    public function stock()
    {
        return $this->hasMany(Stock::class, 'empresas_id', 'id');
    }

    public function ajustes()
    {
        return $this->hasMany(Ajuste::class, 'empresas_id', 'id');
    }

}

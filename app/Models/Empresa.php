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
        'direccion',
        'telefono',
        'email',
        'default'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'empresas_id', 'id');
    }

}

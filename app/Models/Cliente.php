<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pedido;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    /** @use HasFactory<\Database\Factories\ClienteFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'codigo',
        'nombre',
        'email',
        'telefono',
        'direccion',
        'estado',
    ];


    public function pedidos(){
        return $this->hasMany(Pedido::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;


    public function pedido(){
        return $this->belongsTo(Pedido::class);
    }
    public function producto(){
        return $this->hasMany(Producto::class);
    }
}

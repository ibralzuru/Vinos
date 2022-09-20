<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $casts = [
        'pedidos' => 'array'   
    ];

    public function pago(){
        return $this->hasOne(Pago::class);
    }
  public function carrito(){
        return $this->hasMany(Carrito::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
  
  
}

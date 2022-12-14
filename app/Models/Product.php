<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
   
    public function user(){
        return $this->belongsToMany(User::class);
    }
    public function carrito(){
        return $this->belongsTo(Carrito::class);
    }
   
   
}
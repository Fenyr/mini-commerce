<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderedProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        "order_id",
        "cart_id"
    ];

    protected $hidden =  [
        "cart_id"
    ];

    protected $with = ['cart'];

    public function cart()
    {
        return $this->belongsTo(Cart::class, "cart_id");
    }
}

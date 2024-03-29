<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    protected $hidden =  [
        "product_id"
    ];
    protected $with = ['product'];

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }
}

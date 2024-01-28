<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = "order_items";
    protected $hidden = ["order_id","product_id"];
    protected $with =['product'];

    public function product() {
        return $this->belongsTo(Product::class,"product_id");       
    }
}

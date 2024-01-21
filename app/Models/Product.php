<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "slug",
        "image",
        "description",
        "price",
        "category_id",
        "stock",
        "preorder",
    ];
    protected $hidden =  ["category_id"];
    protected $with = ['category'];

    public function category()
    {
        $arr = $this->belongsTo(Category::class, "category_id");
        return $arr;
    }
}

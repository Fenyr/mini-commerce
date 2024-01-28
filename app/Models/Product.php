<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden =  ["category_id"];
    protected $with = ['category'];
    protected $dates = ['created_at', 'updated_at'];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y H:i');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }


    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function toArray()
    {
        $data = parent::toArray();
        $data['category'] = $this->category->name;
        return $data;
    }
}

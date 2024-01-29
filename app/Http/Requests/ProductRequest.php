<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "title" => "required",
            "image"  => "required",
            "description"  => "required",
            "price"  => "required",
            "category_id"  => "required",
            "stock"  => "required",
            "preorder"  => "required",
        ];
    }
}

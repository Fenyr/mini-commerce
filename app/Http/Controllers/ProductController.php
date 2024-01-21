<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    //
    public function indexProduct()
    {
        $data = Product::Paginate(10);
        return response()->json($data, 200);
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            "title" => "required",
            "image"  => "required",
            "description"  => "required",
            "price"  => "required",
            "category_id"  => "required",
            "stock"  => "required",
            "preorder"  => "required",
        ]);

        $data = Product::create([
            "title" => $request["title"],
            "slug" => Str::slug($request["title"]),
            "image"  =>  $request["image"],
            "description"  =>  $request["description"],
            "price"  =>  $request["price"],
            "category_id"  =>  $request["category_id"],
            "stock"  =>  $request["stock"],
            "preorder"  =>  $request["preorder"],
        ]);
        return ApiResponse::withdata("Success Added Data", 200, $data);
    }
    public function editProduct(string $id, Request $request)
    {
        $request->validate([
            "title" => "required",
            "image"  => "required",
            "description"  => "required",
            "price"  => "required",
            "category_id"  => "required",
            "stock"  => "required",
            "preorder"  => "required",
        ]);

        $data = Product::findorfail($id);
        $data->update([
            "title" => $request["title"],
            "slug" => Str::slug($request["title"]),
            "image"  =>  $request["image"],
            "description"  =>  $request["description"],
            "price"  =>  $request["price"],
            "category_id"  =>  $request["category_id"],
            "stock"  =>  $request["stock"],
            "preorder"  =>  $request["preorder"],
        ]);

        return ApiResponse::withdata("Success Edited Data", 200, $data);
    }
    public function deleteProduct(string $id)
    {
        $data = Product::findorfail($id);
        $data->delete();
        return ApiResponse::nodata("Success Deleted Data", 200);
    }
}

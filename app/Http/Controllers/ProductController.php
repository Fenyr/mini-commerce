<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
        $this->$request->validate([
            "title" => "required",
            "image"  => "required",
            "description"  => "required",
            "price"  => "required",
            "category"  => "required",
            "stock"  => "required",
            "preorder"  => "required",
        ]);

        $data = Product::insert($request);
        return response()->json($data, 200);
    }
    public function editProduct(string $id, Request $request)
    {
        $this->$request->validate([
            "title" => "required",
            "image"  => "required",
            "description"  => "required",
            "price"  => "required",
            "category"  => "required",
            "stock"  => "required",
            "preorder"  => "required",
        ]);

        $data = Product::findorfail($id);
        return response()->json($data, 200);
    }
    public function deleteProduct(string $id)
    {
        $data = Product::findorfail($id);
        $data->delete();
        return response()->json("Success Deleted Data", 200);
    }
}

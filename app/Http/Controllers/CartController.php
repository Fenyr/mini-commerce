<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function indexCart()
    {
        $user_id = auth()->user()->id;
        $data = Cart::where("user_id", $user_id)->get();
        return response()->json($data, 200);
    }
    public function addCart(CartRequest $request)
    {
        $user_id = auth()->user()->id;
        $price = Product::find($request["product_id"])->price;
        Cart::insert([
            "user_id" => $user_id,
            "product_id" => $request["product_id"],
            "quantity" => 1,
            "subtotal" => $price,
            "isChecked" => true,
        ]);
        return ApiResponse::nodata("success added to cart", 200);
    }
    public function increaseCart(string $id)
    {
        $data = Cart::findorfail($id);
        $data["quantity"] += 1;
        $data->save();
        return ApiResponse::nodata("success increase quantity", 200);
    }
    public function decreaseCart(string $id)
    {
        $data = Cart::findorfail($id);
        if ($data["quantity"] > 0) {
            $data["quantity"] -= 1;
            $data->save();
        }
        return ApiResponse::nodata("success decrease quantity", 200);
    }
    public function deleteCart(string $id)
    {
        $data = Cart::findorfail($id);
        $data->delete();
        return ApiResponse::nodata("success remove from your cart", 200);
    }
}

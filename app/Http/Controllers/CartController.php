<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function indexCart()
    {
        $user_id = auth()->user()->id();
        $data = Cart::where("user_id", $user_id);
        return response()->json($data, 200);
    }
    public function addCart(Request $request)
    {
        $request->validate([
            "product_id" => "required",
            "quantity" => "required",
        ]);
        $user_id = auth()->user()->id();

        Cart::create([
            "user_id" => $user_id,
            "product_id" => $request["product_id"],
            "quantity" => $request["product_id"],
            "status" => "active",
        ]);
        return response()->json("success added to cart", 200);
    }
    public function increaseQuantity(string $id)
    {
        $data = Cart::findorfail($id);
        $data["quantity"] += 1;
        $data->save();
        return response()->json("success increase quantity", 200);
    }
    public function decreaseQuantity(string $id)
    {
        $data = Cart::findorfail($id);
        $data["quantity"] += 1;
        $data->save();
        return response()->json("success decrease quantity", 200);
    }
    public function deleteCart(string $id)
    {
        $data = Cart::findorfail($id);
        $data->delete();
        return response()->json("success remove from your cart", 200);
    }
}

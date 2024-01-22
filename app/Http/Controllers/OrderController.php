<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderedProduct;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function indexCart()
    {
        $user_id = auth()->user()->id();
        $data = Order::where("user_id", $user_id);
        return response()->json($data, 200);
    }
    public function addOrder()
    {
        $total = 0;
        $user_id = auth()->user()->id;
        $cart = Cart::where(["user_id", $user_id], ["status", "active"])->get();

        if (!isset($cart)) {
            return ApiResponse::nodata("No cart Found", 401);
        }

        $order = new Order();
        foreach ($cart as $key => $val) {
            $total += $val->product->price * $val->quantity;
            OrderedProduct::create([
                "order_id" => $order->id,
                "cart_id" => $val->id,
            ]);
        }
        $order["total_price"] = $total;
        $order["status"] = "unpaid";
        $order->save();

        return ApiResponse::nodata("Success Order Item", 200);
    }
    public function PayOrder(string $id)
    {
        $data = Order::findorfail($id);
        $data["status"] = "process";
        $data->save();
        return response()->json("success Paid Order", 200);
    }
    public function completeOrder(string $id)
    {
        $data = Order::findorfail($id);
        $data["status"] = "complete";
        $data->save();
        return response()->json("success Complete Your Order", 200);
    }
    public function deleteOrder(string $id)
    {
        $data = Order::findorfail($id);
        $data->delete();
        return response()->json("success Paid Order", 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function indexCart()
    {
        $user_id = auth()->user()->id();
        $data = Order::where("user_id", $user_id);
        return response()->json($data, 200);
    }
    public function addOrder(request $request)
    {
        $this->$request->validate([
            "total_price" => "required",
        ]);
        $user_id = auth()->user()->id();

        Order::create([
            "user_id" => $user_id,
            "total_price" => $request['total_price'],
            "status" => "unpaid"
        ]);
        return response()->json("success Place Order", 200);
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

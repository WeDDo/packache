<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(){
        return Order::all();
    }

    public function read(Order $order){
        return $order;
    }

    public function create(Request $request){
        $order = Order::create($request->all());
        return response()->json($order, 201);
    }

    public function update(Request $request, Order $order){
        $order->update($request->all());

        return response()->json($order, 200);
    }

    public function delete(Request $request, Order $order){
        $order->delete();

        return response()->json(null, 204);
    }
}

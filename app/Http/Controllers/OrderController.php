<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){
        if(Auth::user()->role == 'admin' || Auth::user()->role == 'employee'){
            return Order::all();
        }
        else{
            return response()->json(['message' => 'user not authorized for this action!'], 401);
        }
    }

    public function read(Order $order){
        if(Auth::user()->role == 'admin' || Auth::user()->role == 'employee'){
            return $order;
        }
        else{
            return response()->json(['message' => 'user not authorized for this action!'], 401);
        }
    }

    public function create(Request $request){
        if($request->user()->role == 'admin'){
            $order = Order::create($request->all());
            return response()->json($order, 201);
        }
        else{
            return response()->json(['message' => 'user not authorized for this action!'], 401);
        }
    }

    public function update(Request $request, Order $order){
        if($request->user()->role == 'admin'){
            $order->update($request->all());
            return response()->json($order, 200);
        }
        else{
            return response()->json(['message' => 'user not authorized for this action!'], 401);
        }
    }

    public function delete(Request $request, Order $order){
        if($request->user()->role == 'admin'){
            $order->delete();
            return response()->json(null, 204);
        }
        else{
            return response()->json(['message' => 'user not authorized for this action!'], 401);
        }
    }
}

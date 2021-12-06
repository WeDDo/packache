<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    public function index(Order $order){
        if(Auth::user()->role == 'admin' || Auth::user()->role == 'employee'){
            return Package::where("order_id", $order->id)->get();
        }
        else{
            return response()->json(['message' => 'user not authorized for this action!'], 401);
        }
    }

    public function read(Order $order, Package $package){
        if(Auth::user()->role == 'admin' || Auth::user()->role == 'employee'){
            return self::getPackage($order, $package);
        }
        else{
            return response()->json(['message' => 'user not authorized for this action!'], 401);
        }
    }

    public function create(Request $request, Order $order){
        if($request->user()->role == 'admin' || $request->user()->role == 'employee'){
            $package = Package::create([
                "item_id" => $request->item_id,
                "order_id" => $order->id,
                "quantity" => $request->quantity
            ]);
            return response()->json($package, 201);
        }
        else{
            return response()->json(['message' => 'user not authorized for this action!'], 401);
        }
    }

    public function update(Request $request, Order $order, Package $package){
        if($request->user()->role == 'admin' || $request->user()->role == 'employee'){
            $package = self::getPackage($order, $package);
            $package->update($request->all());
            return response()->json($package, 200);
        }
        else{
            return response()->json(['message' => 'user not authorized for this action!'], 401);
        }
    }

    public function delete(Request $request, Order $order, Package $package){
        if($request->user()->role == 'admin' || $request->user()->role == 'employee'){
            $package = self::getPackage($order, $package);
            $package->delete();
            return response()->json(null, 204);
        }
        else{
            return response()->json(['message' => 'user not authorized for this action!'], 401);
        }
    }

    //Gets package from a specific order
    public static function getPackage(Order $order, Package $package): Package{
        return Package::where("order_id", $order->id)
        ->where("id", $package->id)
        ->firstOrFail();
    }
}

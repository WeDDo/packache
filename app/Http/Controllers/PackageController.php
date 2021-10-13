<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Order;

class PackageController extends Controller
{
    public function index(Order $order){
        return Package::where("order_id", $order->id)->get();
    }

    public function read(Order $order, Package $package){
        return self::getPackage($order, $package);
    }

    public function create(Request $request, Order $order){
        $package = Package::create([
            "item_id" => $request->item_id,
            "order_id" => $order->id,
            "quantity" => $request->quantity
        ]);

        return response()->json($package, 201);
    }

    public function update(Request $request, Order $order, Package $package){
        $package = self::getPackage($order, $package);
        $package->update($request->all());

        return response()->json($package, 200);
    }

    public function delete(Request $request, Order $order, Package $package){
        $package = self::getPackage($order, $package);
        $package->delete();

        return response()->json(null, 204);
    }

    public static function getPackage(Order $order, Package $package){
        return Package::where("order_id", $order->id)
        ->where("id", $package->id)
        ->firstOrFail();
    }
}

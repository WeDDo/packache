<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    public function index(){
        return Package::all();
    }

    public function read(Package $package){
        return $package;
    }

    public function create(Request $request){
        $package = Package::create($request->all());
        return response()->json($package, 201);
    }

    public function update(Request $request, Package $package){
        $package->update($request->all());

        return response()->json($package, 200);
    }

    public function delete(Request $request, Package $package){
        $package->delete();

        return response()->json(null, 204);
    }
}

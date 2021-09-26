<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    public function index(){
        //with database
        return Package::all();

        //no database
        //$items = collect([new Item(['name' => 'Potato']), new Item(['name' => 'Carrot'])]);
        //return $items;
    }

    public function read(Package $package){
        //with database
        return $package;

        //no database
        //$items = collect([new Item(['name' => 'Potato']), new Item(['name' => 'Carrot'])]);
        //$item = $items[$id] ?? null;
        //
        //if($item == null){
        //    return new Response(' ', 404);
        //}
        //return $item;
    }

    public function create(Request $request){
        //with database
        $package = Package::create($request->all());
        return response()->json($package, 201);
        //no database
        //$items = collect([new Item(['name' => 'Potato']), new Item(['name' => 'Carrot'])]);
        //$item = new Item(['name' => $request->name]);
        //
        //$items->push($item);
        //
        //return $items;
    }

    public function update(Request $request, Package $package){
        //with database
        $package->update($request->all());

        return response()->json($package, 200);
        //no database
        //$items = collect([new Item(['name' => 'Potato']), new Item(['name' => 'Carrot'])]);
        //$item = $items[$id] ?? null;
        //
        //$name = $request->input('name');
        //
        //$items = collect([new Item(['name' => 'Potato']), new Item(['name' => 'Carrot'])]);
        //
        //return $items->replace([$id => ['name' => $name]]);
    }

    public function delete(Request $request, Package $package){
        //with database
        $package->delete();

        return response()->json(null, 204);

        //no database
        //$items = collect([new Item(['name' => 'Potato']), new Item(['name' => 'Carrot'])]);
        //$name = $items[$id];
        //$items->forget($id);
        //return $items;
    }
}

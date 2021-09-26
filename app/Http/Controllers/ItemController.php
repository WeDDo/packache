<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Item;
use Illuminate\Http\Response;

class ItemController extends Controller
{
    public function index(){
        //with database
        return Item::all();

        //no database
        //$items = collect([new Item(['name' => 'Potato']), new Item(['name' => 'Carrot'])]);
        //return $items;
    }

    public function read(Item $item){
        //with database
        return $item;

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
        $item = Item::create($request->all());

        return response()->json($item, 201);
        //no database
        //$items = collect([new Item(['name' => 'Potato']), new Item(['name' => 'Carrot'])]);
        //$item = new Item(['name' => $request->name]);
        //
        //$items->push($item);
        //
        //return $items;
    }

    public function update(Request $request, Item $item){
        //with database
        $item->update($request->all());

        return response()->json($item, 200);
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

    public function delete(Request $request, Item $item){
        //with database
        $item->delete();

        return response()->json(null, 204);

        //no database
        //$items = collect([new Item(['name' => 'Potato']), new Item(['name' => 'Carrot'])]);
        //$name = $items[$id];
        //$items->forget($id);
        //return $items;
    }
}

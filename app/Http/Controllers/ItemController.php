<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Item;
use Illuminate\Http\Response;

class ItemController extends Controller
{
    public function index(){
        return Item::all();
    }

    public function read(Item $item){
        return $item;
    }

    public function create(Request $request){
        $item = Item::create($request->all());

        return response()->json($item, 201);
    }

    public function update(Request $request, Item $item){
        $item->update($request->all());

        return response()->json($item, 200);
    }

    public function delete(Request $request, Item $item){
        $item->delete();

        return response()->json(null, 204);
    }
}

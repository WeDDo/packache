<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index(){
        if(Auth::user()->role == 'admin' || Auth::user()->role == 'employee'){
            return Item::all();
        }
        return response()->json(['message' => 'user not authorized for this action!'], 401);
    }

    public function read(Item $item){
        if(Auth::user()->role == 'admin' || Auth::user()->role == 'employee'){
            return $item;
        }
        else{
            return response()->json(['message' => 'user not authorized for this action!'], 401);
        }
    }

    public function create(Request $request){
        if($request->user()->role == 'admin'){
            $item = Item::create($request->all());
            return response()->json($item, 201);
        }
        else{
            return response()->json(['message' => 'user not authorized for this action!'], 401);
        }
    }

    public function update(Request $request, Item $item){
        if($request->user()->role == 'admin'){
            $item->update($request->all());
            return response()->json($item, 200);
        }
        else{
            return response()->json(['message' => 'user not authorized for this action!'], 401);
        }
    }

    public function delete(Request $request, Item $item){
        if($request->user()->role == 'admin'){
            $item->delete();

            return response()->json(null, 204);
        }
        else{
            return response()->json(['message' => 'user not authorized for this action!'], 401);
        }
    }
}

<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public $successStatus = 200;

    public function create(Request $request){ 
        $input = $request->all();
        Cart::create($input);
        return response()->json(['success' => $input], $this-> successStatus);
    }

    public function cart(Request $request){
        $user = Auth::user();
        $cart = Cart::all()->where('user_id', $user->id);
        return response()->json(['success' => $cart], $this-> successStatus);
    }

    public function all(Request $request){
        $carts = Cart::all();
        return response()->json(['success' => $carts], $this-> successStatus);
    }

    public function delete(Request $request){
        $user = Auth::user();
        $id = $request->route('id');
        Cart::find($id)->where('user_id', $user->id)->delete();
        $carts = Cart::all();
        return response()->json(['success' => $carts], $this-> successStatus);
    }

    public function update(Request $request){
        $user = Auth::user();
        $id = $request->route('id');
        $cart = Cart::find($id)->where('user_id', $user->id);
        $input = $request->all();
        $cart->quantity = $input['quantity'];
        $cart->save();
        $carts = Cart::all();
        return response()->json(['success' => $carts], $this-> successStatus);
    }
}

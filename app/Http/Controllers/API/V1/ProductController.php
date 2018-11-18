<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{
    public $successStatus = 200;

    public function create(Request $request){
        $input = $request->all();
        Product::create($input);
        return response()->json(['success' => $input], $this-> successStatus);
    }

    public function product(Request $request){
        $id = $request->route('id');
        if(is_numeric($id)){
            $profile = Product::find($id);
            return response()->json(['success' => $profile], $this-> successStatus);
        }else{
            return $this->all($request);
        }
    }

    private function all(Request $request){
        $profiles = Product::all();
        return response()->json(['success' => $profiles], $this-> successStatus);
    }

    public function delete(Request $request){
        $id = $request->route('id');
        Product::destroy($id);
        $products = Product::all();
        return response()->json(['success' => $products], $this-> successStatus);
    }

    public function update(Request $request){
        $id = $request->route('id');
        $product = Product::find($id);
        $input = $request->all();
        $input['name']!=''?$product->amount=$input['name']:'';
        $input['amount']!=''?$product->amount=$input['amount']:'';
        $input['category']!=''?$product->amount=$input['category']:'';
        $product->save();
        $products = Product::all();
        return response()->json(['success' => $products], $this-> successStatus);
    }
}

<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    public $successStatus = 200;

    public function create(Request $request){ 
        $input = $request->all();
        Category::create($input);
        return response()->json(['success' => $input], $this-> successStatus);
    }

    public function category(Request $request){
        $id = $request->route('id');
        if(is_numeric($id)){
            $category = Category::find($id);
            return response()->json(['success' => $category], $this-> successStatus);
        }else{
            return $this->all($request);
        }
    }

    private function all(Request $request){
        $categories = Category::all();
        return response()->json(['success' => $categories], $this-> successStatus);
    }

    public function delete(Request $request){
        $id = $request->route('id');
        Category::destroy($id);
        $categories = Category::all();
        return response()->json(['success' => $categories], $this-> successStatus);
    }

    public function update(Request $request){
        $id = $request->route('id');
        $category = Category::find($id);
        $input = $request->all();
        $category->name = $input['name'];
        $category->save();
        $categories = Category::all();
        return response()->json(['success' => $categories], $this-> successStatus);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Database\Schema;
use App\Product;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        if ($products->count() == 0){
            $product = DB::table('products')
                        ->get();
            $attributes = array_keys($product->toArray());
            return view('index', ['attributes'=>$attributes]);
        } else {
        $product = $products->first();
        $attributes = array_keys($product->toArray());
        return view('index', ['products'=>$products, 'attributes'=>$attributes]);
        }
        
    }
    public function update(Request $request, $id){ 
        $validatedData = $request->validate([
            'price' => 'required|integer|max:255',
            'rating' => 'required|integer|max:10|min:1',
        ]);
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->rating = $request->rating;
        $product->save();
    }
    public function getDataForm($id){
        return Product::find($id);
    }
    public function delete($id){
        $product = Product::find($id);
        $product->delete();
    }
    public function create(Request $request){
        $validatedData = $request->validate([
            'price' => 'required|integer|max:255',
            'rating' => 'required|integer|max:10|min:1',
        ]);
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->rating = $request->rating; 
        $product->save();
    }
    public function sort($fieldsort,$parametrSort){
        $products = DB::table('products')
                        ->orderBy($fieldsort,$parametrSort)
                        ->get();
        return $products;
    }
    public function sortView($fieldsort,$parametrSort){
        $products = DB::table('products')
        ->orderBy($fieldsort,$parametrSort)
        ->get();
        $products = Product::all();
        $attributes = array_keys($products->first()->toArray());
        return view('index', ['products'=>$products, 'attributes'=>$attributes]);
    }
}
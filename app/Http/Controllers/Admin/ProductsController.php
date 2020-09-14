<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use App\Category;
use App\Product;

class ProductsController extends Controller
{
    public function index () {
      if (auth()->user()->category == 'customer') {
        return redirect()->route('home');
      }

      $categories = Category::all();

      return view('admin.products', compact('categories'));
    }

    public function get () {
      $products = Product::orderBy('id')->get();

      return response()->json(array('response' => $products, 'flag' => true));
    }

    public function store (Request $request) {
      $validator = Validator::make($request->all(), [
        'category' => 'required|integer|exists:Categories,id',
        'name' => 'required|max:190',
        'description' => 'required|max:200',
        'quantity' => 'required|integer',
        'price' => 'required|integer',
        'file' => 'required|image|max:1999'
      ]);

      if ($validator->fails()) {
        return response()->json(array('response' => $validator->messages(), 'flag' => false));
      }

      // save file
      $filename = time() . '.' . $tmp = $request->file('file')->getClientOriginalExtension();
      $request->file('file')->storeAs('products', $filename, 'public');

      $category = Category::find($request->category);
      $product  = new Product;

      $product->category_id	       = $category->id;
      $product->category_name	     = $category->name;
      $product->name        = $request->name;
      $product->description = $request->description;
      $product->quantity    = $request->quantity;
      $product->price       = $request->price;
      $product->code        = time();
      $product->photo_link  = 'uploads/products/' . $filename;
      $product->save();

      return response()->json(array('response' => $product, 'flag' => true));
    }

    public function show (Request $request) {
      $product = Product::find($request->id);

      return isset($product) ?
              response()->json(array('response' => $product, 'flag' => true)) :
              response()->json(array('response' => '', 'flag' => false));
    }

    public function search (Request $request) {

      $products = $request->category != null ?
                  Product::where('name', 'like', $request->name .'%')
                    ->where('price', 'like', $request->price . '%')
                    ->where('category_id', '=', $request->category)
                    ->get()
              :   Product::where('name', 'like', $request->name .'%')
                ->where('price', 'like', $request->price . '%')
                ->get();

      return response()->json(array('response' => $products, 'flag'=>true));
    }

    public function destroy (Request $request) {
      $product = Product::find($request->id);

      $product->delete();

      return response()->json(array('response' => $product, 'flag' => true));
    }
}

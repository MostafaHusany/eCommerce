<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Product;
use App\Category;

class MainController extends Controller
{
    public function getLatest () {
      $products = Product::limit(30)->get();

      return response()->json(array('response' => $products, 'flag' => true));
    }

    public function getProducts (Request $request) {
      $products = $request->id != -1 ?
                  Category::find($request->id)->products :
                  Product::limit(30)->get();

      if (isset($products)) {
        return response()->json(array('response' => $products, 'flag' => true));
      }

      return response()->json(array('response' => null, 'flag' => false));
    }
}

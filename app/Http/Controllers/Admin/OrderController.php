<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Validator;
use App\User;
use App\Order;
use App\Category;
use App\Product;

class OrderController extends Controller
{
    public function index () {
      $products   = Product::all();
      $users      = User::all();

      return view('admin.orders', compact('products', 'users'));
    }

    public function get () {
      $products = DB::table('products')
            ->join('orders', 'products.id', '=', 'orders.product_id')
            ->orderBy('products.id')->get();

      return response()->json(array('response' => $products, 'flag' => true));
    }

    public function store (Request $request) {
      $validator = Validator::make($request->all(), [
        'user_id' => 'required|exists:users,id',
        'product_id' => 'required|exists:products,id',
      ]);

      if ($validator->fails()) {
        return response()->json(array('response' => $validator->messages(), 'flag' => false));
      }

      $user     = User::find($request->user_id);
      $product  = Product::find($request->product_id);

      $order = new Order;
      $order->user_id   = $user->id;
      $order->user_name = $user->name;
      $order->product_id   = $product->id;
      $order->product_name = $product->name;
      $order->state        = 'wating';
      $order->save();


      $product = DB::table('products')
            ->join('orders', 'products.id', '=', 'orders.product_id')
            ->where('orders.product_id', '=', $order->product_id)
            ->where('orders.user_id', '=', $order->user_id)
            ->first();

      return response()->json(array('response' => $product, 'flag' => true));
    }

    public function destroy (Request $request) {
      $order = Order::find($request->id);

      $order->delete();

      return response()->json(array('response' => $order, 'flag' => true));
    }
}

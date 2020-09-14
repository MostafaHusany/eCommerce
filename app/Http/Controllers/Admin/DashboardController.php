<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Product;

class DashboardController extends Controller
{
    // show the dashboard view page
    public function index () {
      if (auth()->user()->category == 'customer') {
        return redirect()->route('home');
      }

      $usersCount     = User::count();
      $productsCount  = Product::count();

      $latestUsers = User::where('created_at', 'like', date('Y-m-d').'%')->get();
      
      return view('admin.dashboard', compact('usersCount', 'productsCount', 'latestUsers'));
    }
}

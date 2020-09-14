<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use App\Category;

class CategoriesController extends Controller
{
    public function index () {

      if (auth()->user()->category == 'customer') {
        return redirect()->route('home');
      }

      return view('admin.categories');
    }

    public function get () {
      $categories = Category::orderBy('id')->get();

      return response()->json(array('response' => $categories, 'flag' => true));
    }

    public function store (Request $request) {
      $validator = Validator::make($request->all(), [
        'name' => 'required|max:190',
        'description' => 'required|max:200',
        'file' => 'required|image|max:1999'
      ]);

      if ($validator->fails()) {
        return response()->json(array('response' => $validator->messages(), 'flag' => false));
      }

      // save file
      $filename = time() . '.' . $tmp = $request->file('file')->getClientOriginalExtension();
      $request->file('file')->storeAs('categories', $filename, 'public');

      $categorie = new Category;

      $categorie->name        = $request->name;
      $categorie->description = $request->description;
      $categorie->count      = 0;
      $categorie->photo_link  = 'uploads/categories/' . $filename;
      $categorie->save();

      return response()->json(array('response' => $categorie, 'flag' => true));
    }

    public function show (Request $request) {
      $category = Category::find($request->id);

      return isset($category) ?
              response()->json(array('response' => $category, 'flag' => true)) :
              response()->json(array('response' => '', 'flag' => false));
    }

    public function destroy (Request $request) {
      $category = Category::find($request->id);

      $category->delete();

      return response()->json(array('response' => $category, 'flag' => true));
    }
}

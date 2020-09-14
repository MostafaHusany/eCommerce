<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use Validator;
use App\User;

class UsersController extends Controller
{
    public function index () {
      if (auth()->user()->category == 'customer') {
        return redirect()->route('home');
      }

      return view('admin.users');
    }

    // get all users for the main Schaduale
    public function get () {
      $users = User::orderBy('id', 'asc')->get();

      return response()->json(array('response' => $users, 'flag' => true));
    }

    // find specific user through id
    public function find (Request $request) {
      $user = User::find($request->id);

      if (!isset($user)) {
        return response()->json(array('response' => 'User not found', 'flag' => false));
      }

      return response()->json(array('response' => $user, 'flag' => true));
    }

    // search users result
    public function search (Request $request) {
      $users = $request->category != null ?
                  User::where('name', 'like', $request->name .'%')
                    ->where('email', 'like', $request->email .'%')
                    ->where('category', '=', $request->category)
                    ->get()
              :   User::where('name', 'like', $request->name .'%')
                ->where('email', 'like', $request->email .'%')
                ->get();

      return response()->json(array('response' => $users, 'flag'=>true));
    }

    // store new user
    public function store (Request $request) {
      $validator = Validator::make($request->all(), [
        'name' => 'required|max:190|unique:users,name',
        'category' => 'required|max:190',
        'email' => 'email|required|unique:users,email',
        'password' => 'required',
        'password_confirm' => 'required|same:password'
      ]);

      if ($validator->fails()) {
        $response = array('response' => $validator->messages(), 'flag' => false);
        return response()->json($response);
      }

      $user = new User;
      $user->name      = $request->name;
      $user->category  = $request->category;
      $user->email     = $request->email;
      $user->password  =  Hash::make($request->password);
      $user->save();

      return response()->json(array('response' => $user, 'flag' => true));
    }

    // update user
    public function update (Request $request) {
      $validator = Validator::make($request->all(), [
        'id'  => 'required|integer|exists:users,id',
        'name' => 'required|max:190|unique:users,name,'.$request->id,
        'category' => 'required|max:190',
        'email' => 'email|required|unique:users,email,'.$request->id,
        'password' => 'required',
        'password_confirm' => 'required|same:password'
      ]);

      if ($validator->fails()) {
        $response = array('response' => $validator->messages(), 'flag' => false);
        return response()->json($response);
      }

      $user            = User::find($request->id);
      $user->name      = $request->name;
      $user->category  = $request->category;
      $user->email     = $request->email;
      $user->password  =  Hash::make($request->password);
      $user->save();

      return response()->json(array('response' => $user, 'flag' => true));
    }

    // delete user
    public function destroy (Request $request) {
      $validator = Validator::make($request->all(),[
        'id' => 'required|integer',
      ]);

      if ($validator->fails()) {
        $response = array('response' => $validator->messages, 'flag' => false);
      }

      $user = User::find($request->id);

      // $user->delete();

      return response()->json(array('response' => $user, 'flag' => true));
    }
}

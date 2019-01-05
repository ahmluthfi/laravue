<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){
    	 //$users = User::all();
    	 $users = User::orderBy('id','DESC')->paginate(2);

    	 return response()->json($users);
    }

    public function store(Request $request){

    	 $user = new User();
    	 
    	 $user->name = $request->get('name');
    	 $user->email = $request->get('email');
    	 $user->password = bcrypt($request->get('password'));
    	 
    	 $user->save();

    	 return response()->json($user);
    }

    public function show($id){
    	 $users = User::find($id);

    	 return response()->json($users);
    }


    public function update($id, Request $request){
    	 $user = User::find($id);
    	 
    	 $user->name = $request->get('name');
    	 $user->email = $request->get('email');
    	 
    	 $user->update();

    	 return response()->json($user);
    }


    public function destroy($id){
    	 $user = User::find($id);
    	 $user->delete();

    	 return response()->json('User Deleted');
    }
}

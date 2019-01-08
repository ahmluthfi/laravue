<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){

    	if (isset($_GET['page'])) {
    		$page = $_GET['page'];
    	}else{
    		$page = 1;
    	}
    	
    	$limit = 10;

    	$no = (($page-1)*$limit)+1;

    	 $users = User::orderBy('id','DESC')->paginate($limit);
    	 foreach ($users as $key => $value) {
    	 	$users[$key]['no'] = $no;
    	 	$no++;
    	 }
    	 return response()->json($users);
    }

    public function store(Request $request){

    	 $user = new User();
    	 
    	 if (!empty($request->get('image'))) {
    	 	$explode = explode(',', $request->get('image'));
	    	$decode = base64_decode($explode[1]);
	    	
    	 	if (str_contains($explode[0],'jpeg')) {
	    	 	$extension = 'jpg';
	    	 }else{
	    	 	$extension = 'png';
	    	 }

	    	 $filename = str_random().'.'.$extension;
	    	 $path = public_path().'/image/'.$filename;
	    	 file_put_contents($path, $decode);	
    	 	
    	 	$image_save = 'image/'.$filename;
    	 	$user->image = $image_save;
    	 }else{
    	 	$image_save = '';
    	 }

    	 
    	 $user->name = $request->get('name');
    	 $user->email = $request->get('email');
    	 $user->password = bcrypt($request->get('password'));
    	 
    	 
    	 $user->save();

    	 return response()->json($user);
    }

    public function simpan(Request $request){

    	 $user = new User();
    	 
    	 if (!empty($request->get('image'))) {
    	 	$explode = explode(',', $request->get('image'));
	    	$decode = base64_decode($explode[1]);
	    	
    	 	if (str_contains($explode[0],'jpeg')) {
	    	 	$extension = 'jpg';
	    	 }else{
	    	 	$extension = 'png';
	    	 }

	    	 $filename = str_random().'.'.$extension;
	    	 $path = public_path().'/image/'.$filename;
	    	 file_put_contents($path, $decode);	
    	 	
    	 	$image_save = 'image/'.$filename;
    	 	$user->image = $image_save;
    	 }else{
    	 	$image_save = '';
    	 }

    	 
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
    	 
    	
    	 if ($request->get('image')) {
    	 	 $explode = explode(',', $request->get('image'));
	    	 $decode = base64_decode($explode[1]);
    	 	if (str_contains($explode[0],'jpeg')) {
	    	 	$extension = 'jpg';
	    	 }else{
	    	 	$extension = 'png';
	    	 }

	    	 $filename = str_random().'.'.$extension;
	    	 $path = public_path().'/image/'.$filename;

	    	 file_put_contents($path, $decode);	
    	 	
    	 	$image_save = 'image/'.$filename;

	    	$user->image = $image_save;
    	 }else{
    	 	$image_save = '';
    	 }

    	 $user->name  = $request->get('name');
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

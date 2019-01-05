<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
    	 return view("layouts.users");
    }


    public function create(){
    	 return view("layouts.create");
    }


    public function edit($id){
    	$data['id'] = $id;
    	return view("layouts.edit", $data);
    }
}

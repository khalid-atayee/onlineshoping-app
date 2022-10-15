<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function register(Request $request){

        $users = new User();
        $users->name=$request->username;
        $users->email=$request->email;
        $users->password=md5($request->password);
        $users->save();
        return response()->json(['message'=>'You have succssfuly signed up']);

    }
}

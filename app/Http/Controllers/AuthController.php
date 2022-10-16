<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function register(Request $request){

            $user = new User();
            $user->name=$request->username;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $user->save();

            return response()->json([
                'status'=>true,
                'message'=>'user created successfully',


            ],200);



    }
    function login(Request $request){
        $user = User::where('email',$request->email)->first();
        if($user && Hash::check($request->password,$user->password)){
            Auth::login($user);
            return response()->json([
               'status'=>true,
               'Token'=>$user->createToken('API Token')->plainTextToken,
            ]);

        }

    }
}

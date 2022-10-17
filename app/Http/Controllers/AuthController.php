<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    // function sendOtp(Request $request){

    //     $otp = rand(1000,9999);
    //     dd($otp);

    //     Mail::to($request->email)->send(new SendMail($otp));

    // }

    function register(Request $request){
        
        $otp_no = rand(1000,9999);
        $otp = new Otp();
        $otp->otp=$otp_no;
        $otp->name = $request->username;
        $otp->email=$request->email;
        $otp->password=Hash::make($request->password);
        $otp->save();

        Mail::to($request->email)->send(new SendMail($otp_no));
        return response()->json(['id'=>$otp->id],200);


}
function verify(Request $request){
    $otp = $request->otpForm['value1'].''.$request->otpForm['value2'].''.$request->otpForm['value3'].''.$request->otpForm['value4'];
    $otp = (int)$otp;
    $otp_id = $request->id;
    $otp_data = Otp::find($otp_id);

    
    echo '<pre>';
    print_r($otp_data);

}
    // function register(Request $request){
        

    //         $user = new User();
    //         $user->name=$request->username;
    //         $user->email=$request->email;
    //         $user->password=Hash::make($request->password);
    //         $user->save();

    //         return response()->json([
    //             'status'=>true,
    //             'message'=>'user created successfully',


    //         ],200);



    // }
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

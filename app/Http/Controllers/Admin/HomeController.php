<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Session;
use Hash;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function login(){
        return view("auth.admin.login");
    }
    public function PhoneLogin(Request $request){
        $user = User::where('phone',$request->phone)->where('user_type','admin')->orWhere('user_type','staff')->first();
        if($user){
            return send_otp($request->phone,"Your otp is 123456");
        }else{
            return ['error' => true , 'message' => "User not found "];
        }
    }
    public function PhoneLoginVerify(Request $request){

        $user = User::where('phone',$request->phone)->where('user_type','admin')->orWhere('user_type','staff')->first();
        if($user){
            if($request->cookie('otp')==$request->otp){

                if($request->kip_signed=="true"){

                    Auth::login($user,true);
                }
                else{
                    Auth::login($user,false);
                }
                return ['error' => false , 'message' => "Login successfully","redirect"=> route('admin.dashboard')];
            }else{
                return ['error' => true , 'message' => "OTP not match"];
            }
        }else{
            return ['error' => true , 'message' => "User not found "];
        }


    }
    
}

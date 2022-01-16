<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function login(){

        // return Auth::user();
        if(Auth::check()){
            return redirect(route("admin.dashboard"));
        }
        return view("auth.admin.login");
    }
    public function PhoneLogin(Request $request){
        $otp = random_int(100000, 999999);
        $user = User::where('phone',$request->phone)->where('user_type','admin')->orWhere('user_type','staff')->first();
        if($user){
            return send_otp($request->phone,$otp);
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
    public function LoginAdmin(Request $request){
        $user = User::whereIn('user_type', ['admin', 'seller'])->where('email', $request->email)->first();
        if($user != null){
            if(Hash::check($request->password, $user->password)){
                if($request->has('remember')){
                    auth()->login($user, true);
                }
                else{
                    auth()->login($user, false);
                }
            }
            return redirect(route("admin.dashboard"));
        }else{
            return back()->with("error","User not found ");
        }

    }

}

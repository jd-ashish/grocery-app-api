<?php /** @noinspection PhpUndefinedClassInspection */

namespace App\Http\Controllers\Api;

use App\Models\BusinessSetting;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Models\PayoutIds;
use App\Models\UserAddress;
use App\Http\Controllers\FmcController;
use App\Http\Controllers\Controller;
use App\Models\User as ModelsUser;
use Illuminate\Foundation\Auth\User as AuthUser;

class AuthController extends Controller
{
    public function signup(Request $request)
    {

        // $request->validate([
        //     'name' => 'required|string',
        //     'email' => 'required|string|email|unique:users',
        //     'password' => 'required|string|min:8'
        // ]);

        if(is_numeric($request->get('email'))){
            $byPhone = ['phone'=> $request->get('email')];
            if($this->ifUserDataIsNotExist($byPhone,"","")){
                return $this->CreateUser($request,"phone");
                //continue to submit form return $this->message(["message"=>"Phone number valid!"]);
            }else{
                return $this->message(["message"=>"This user already exist!" , "error"=>true]);
            }

        }elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            $byEmail = ['email' => $request->get('email')];

            if($this->ifUserDataIsNotExist("",$byEmail,"")){
                return $this->CreateUser($request,"email");
                //continue to submit form return $this->message(["message"=>"Phone number valid!"]);
            }else{
                return $this->message(["message"=>"This user already exist!" , "error"=>true]);
            }

        }else{
            $byUsername = ['email' => $request->get('email')];
            if($this->ifUserDataIsNotExist("","",$byUsername)){
                return $this->CreateUser($request,"username");
                //continue to submit form return $this->message(["message"=>"Phone number valid!"]);
            }else{
                return $this->message(["message"=>"This user already exist!" , "error"=>true]);
            }
        }
        return $request;
        // $user = new User([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => bcrypt($request->password),
        //     'email_verified_at' => Carbon::now()
        // ]);
        // $user->save();
        // $customer = new Customer;
        // $customer->user_id = $user->id;
        // $customer->save();
        // return response()->json([
        //     'message' => 'Registration Successful. Please log in to your account'
        // ], 201);
    }
    public function CreateUser(Request $request,$type){
        if($type=="phone"){
            //send otp to mobile number
            // return $this->message(["message"=>"This user created phone" , "error"=>true]);
            return $this->sendOtp($request);
        }
        if($type=="email"){
            //send otp to email iD
            // return $this->message(["message"=>"This user created email" , "error"=>true]);
            return $this->sendOtpEmail($request);
        }
        if($type=="username"){
            //send otp to email ID
            // return $this->message(["message"=>"This user created email" , "error"=>true]);
            return $this->sendOtpEmail($request);
        }

    }

    public function verifyAccount(Request $request){
        // return $this->message(["message"=>"Something wrong to create user chaeck android code! ".$request->device_token , "error"=>true]);
        if(is_numeric($request->get('email'))){
            $user = User::create([
            'name' => $request->name,
                'phone' => $request->email,
                'password' => bcrypt($request->password),
                'plateform' => $request->plateform,
                'device_token' => $request->device_token,
                'email_verified_at' => Carbon::now()
            ]);

        }elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            $user = User::create([
            'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'plateform' => $request->plateform,
                'device_token' => $request->device_token,
                'email_verified_at' => Carbon::now()
            ]);

        }else{
            $user = User::create([
            'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'plateform' => $request->plateform,
                'device_token' => $request->device_token,
                'email_verified_at' => Carbon::now()
            ]);
        }

        $customer = new Customer;
        $customer->user_id = $user->id;
        $customer->save();

        fmcSend("You have successfully create accounnt","Welcome bonos credit in scress card",null,'scratch',$user->id,user_device_id($user->id));

        $sct_data = array();
        $sct_data['user_id'] = $user->id;
        $sct_data['title'] = "welcome bonus";
        $sct_data['message'] = "welcome bonus";
        $sct_data['amount'] = 10;
        $sct_data['coupon_text'] = "welcome bonus won RS 10";
        $sct_data['type'] = "text";
        $sct_data['image'] = "";
        $sct_data['visibility'] = 1;
        $sct_data['cases'] = env('IN_CASH');
        addScratchCoupons($sct_data);

        if($user){
            return $this->message(["message"=>"This user created successfully" , "error"=>false]);
        }else{
            return $this->message(["message"=>"Something wrong to create user , Your device token not match!" , "error"=>true]);
        }

    }
    public function sendPhoneOtp(Request $request){
        if(strlen($request->get('phone'))==10){
            if(is_numeric($request->get('phone'))){
                if($this->ifUserDataIsNotExist($request->get('phone'),"","")){
                    $otp = gOTP();
                    if(send_otp_phone("Ms. User",$otp,$request->get('phone'),true)){
                       return $this->message(["message"=>"Sussessfully OTP send to ".$request->get('phone') , "OTP"=>$otp, "error"=>false,"type"=>"OTP"]);
                   }else{
                       return $this->message(["message"=>"OTP not send , Try after some time ", "error"=>true,"type"=>"OTP"]);

                   }

                    // return $this->sendOtp($request);
                }else{
                    return $this->message(["message"=>"This Phone already exist!" , "error"=>true]);
                }
            }else{
                return $this->message(["message"=>"Not valid phone number", "error"=>true,"type"=>"OTP"]);
            }
        }else{
            return $this->message(["message"=>"Not valid phone number , phone number must be 10 degit without +91", "error"=>true,"type"=>"OTP"]);
        }


    }
    public function sendEmailOtp(Request $request){

       if(filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)){
            if($this->ifUserDataIsNotExist("",$request->get('email'),"")){
                return $this->sendOtpEmail($request);
            }else{
                return $this->message(["message"=>"This email already exist!" , "error"=>true]);
            }
        }else{
            return $this->message(["message"=>"Not valid email ID", "error"=>true,"type"=>"OTP"]);
        }
    }
    public function sendOtp(Request $request){
        /*
        pass last paramiter true or false
        if pass true the OTP not send
        if pass fasle the OTP will send
        */

        $otp = gOTP();
        // return send_otp_phone($request->name,$otp,$request->email,true);
        // return $this->message(["message"=>"OTP not send , Try after some time ".$request->email, "error"=>false,"type"=>"OTP"]);
       if(send_otp_phone($request->name,$otp,$request->email,true)){
           return $this->message(["message"=>"Sussessfully OTP send to ".$request->email , "OTP"=>$otp, "error"=>false,"type"=>"OTP"]);
       }else{
           return $this->message(["message"=>"OTP not send , Try after some time ", "error"=>true,"type"=>"OTP"]);

       }
    }
    public function sendOtpEmail(Request $request){
        $otp = gOTP();
        $data = ['message' => "Your Otp is ",'otp'=>$otp,'subject'=>'OTP for login for regester Maniyar Bangles app'];
        send_otp_mail($request->email,$data);
        return $this->message(["message"=>"Sussessfully OTP send to ".$request->email , "OTP"=>$otp, "error"=>false,"type"=>"OTP"]);
    }
    public function message($sms = array()){
        return response()->json($sms, 201);
    }
    public function login(Request $request)
    {
        if(setting("is_dummy")=="1"){
            $otp = 123456;
        }else{
            $otp = random_int(100000, 999999);
        }

        if($request->phone==""){
            return $this->message(["message"=>"Enter email filed " ,"error"=>true]);
        }
        $byEmail = array();
        $byUsername = array();

        if(is_numeric($request->get('phone'))){
            $user = ModelsUser::where('phone',$request->phone)->where('status',1)->first();
            send_otp($request->phone,$otp);
            return $this->message(["message"=>"Otp send successfully " ,"error"=>false,"otp" => $otp]);


        }elseif (filter_var($request->get('phone'), FILTER_VALIDATE_EMAIL)) {
            $byEmail = ['email' => $request->get('phone'), 'password'=>$request->get('password')];

            if (!Auth::attempt($this->login_byPass($byEmail))){
                return $this->weatherUserIsExist("",$request->get('email'),"");
            }else{
                $user = $request->user();
                $tokenResult = $user->createToken('Personal Access Token');
                return $this->loginSuccess($tokenResult, $user, $request->device_token);
            }
        }else{
            $byUsername = ['email' => $request->get('phone'), 'password'=>$request->get('password')];
            if (!Auth::attempt($this->login_byPass($byUsername))){
                return $this->weatherUserIsExist("","",$request->get('email'));
            }else{
                $user = $request->user();
                $tokenResult = $user->createToken('Personal Access Token');
                return $this->loginSuccess($tokenResult, $user, $request->device_token);
            }
        }
    }
    public function verify_login(Request $request)
    {

        // return $request->phone;
        if($request->phone==""){
            return $this->message(["message"=>"Enter email filed " ,"error"=>true]);
        }
        $byEmail = array();
        $byUsername = array();

        if(is_numeric($request->get('phone'))){
            $user = ModelsUser::where('phone',$request->phone)->where('status',1)->first();
            if($user){
                // return $this->message(["message"=>"Otp send successfully " ,"error"=>false,"otp" => 123456]);
                $tokenResult = $user->createToken('User login api');
                return $this->loginSuccess($tokenResult, $user , $request->device_token);
            }else{
                // return $this->message(["message"=>"Otp send successfully " ,"error"=>false,"otp" => 123456]);
                if(is_numeric($request->get('phone'))){
                    $user_data = ModelsUser::create([
                        'name' => "Name",
                        'phone' => $request->phone,
                        'password' => bcrypt($request->otp),
                        'plateform' => $request->plateform,
                        'device_token' => $request->device_token,
                        'email_verified_at' => Carbon::now()
                    ]);

                }

                $customer = new Customer;
                $customer->user_id = $user_data->id;
                $customer->save();
                $tokenResult = $user_data->createToken('user User login api');
                return $this->loginSuccess($tokenResult, $user_data , $request->device_token);
            }


        }
    }
//save_address
    public function save_address(Request $request)
    {
        // return $request->phone;
        if($request->user_id==""){
            return $this->message(["message"=>"Please Login " ,"error"=>true]);
        }
        $user = ModelsUser::where('id',$request->user_id)->where('status',1)->first();
        if($user){
            $address = new UserAddress();
            $address->user_id = $request->user_id;
            $address->address = $request->address;
            $address->city= $request->city;
            $address->state = $request->state;
            $address->country = $request->country;
            $address->postalCode = $request->postalCode;
            $address->knownName = $request->knownName;
            $address->longitude = $request->longitude;
            $address->lattitude = $request->lattitude;
            $address->status = 1;
            $address->save();
            return $address;
        }else{
            return $this->message(["message"=>"This user not found " ,"error"=>true]);
        }
    }
    public function login_byPass($res = array()){
          return $res;
    }
    public function ifUserDataIsNotExist($phone,$email,$un){
        if($email!=""){
            $auth_email= User::where('email',$email)->first();
            if($auth_email){
                //details exist !
                return false;
            }else{
                return true;
            }
        }

        if($un!=""){
            $auth_email= User::where('email',$un)->first();
            if($auth_email){
                //details exist !
                return false;
            }else{
                return true;
            }
        }


        if($phone!=""){
            $auth_email= User::where('phone',$phone)->first();
            if($auth_email){
                //details exist !
                return false;
            }else{
                return true;
            }
        }

    }

    public function weatherUserIsExist($phone,$email,$un){
        if($email!=""){
            $auth_email= User::where('email',$email)->where("provider_id","!=","")->first();
            if($auth_email){
                return $this->message(["message"=>"This email is regester by Social media like facebook or gmail" , "error"=>true]);
            }else{
                return $this->message(["message"=>"This user is not found" , "error"=>true]);
            }
        }

        if($un!=""){
            $auth_email= User::where('email',$un)->where("provider_id","!=","")->first();
            if($auth_email){
                return $this->message(["message"=>"This phone is regester by Social media like facebook or gmail" , "error"=>true]);
            }else{
                return $this->message(["message"=>"This user is not found" , "error"=>true]);
            }
        }


        if($phone!=""){
            $auth_email= User::where('phone',$phone)->where("provider_id","!=","")->first();
            if($auth_email){
                return $this->message(["message"=>"This user is regester by Social media like facebook or gmail" , "error"=>true]);
            }else{
                return $this->message(["message"=>"This user is not found" , "error"=>true]);
            }
        }

    }

    public function OtpData($otp_data){

        if($otp_data=="" || $otp_data=="otp_data"){
            return $this->message(["message"=>"Enter Email/Phone to get OTP " ,"error"=>true]);
        }
        if(is_numeric($otp_data)){
            //send otp to mobile
            $otp = gOTP();
           if(send_otp_phone("Ms. User",$otp,$otp_data,true)){
               return $this->message(["message"=>"Sussessfully OTP send to ".$otp_data ,"single_data"=>$otp_data, "otp"=>$otp, "error"=>false,"type"=>"otp"]);
           }else{
               return $this->message(["message"=>"OTP not send , Try after some time ", "error"=>true,"type"=>"otp"]);
           }
        }elseif (filter_var($otp_data, FILTER_VALIDATE_EMAIL)) {
            //send otp to email
            $otp = gOTP();
            $data = ['message' => "Your Otp is ",'otp'=>$otp ,"single_data"=>$otp_data ,'subject'=>'OTP for forgot password @ Maniyar Bangles app'];
            send_otp_mail($otp_data,$data);
            return $this->message(["message"=>"Sussessfully OTP send to ".$otp_data , "otp"=>$otp, "error"=>false,"type"=>"otp"]);
        }else{
            return $this->message(["message"=>"Enter Email/Phone to get OTP " ,"error"=>true]);
        }
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function socialLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email'
        ]);

        if (User::where('email', $request->email)->count() > 0) {
            if($request->plateform && $request->personPhoto){
                $update_u = User::where('email', $request->email)->first();
                $update_u->plateform = $request->plateform;
                $update_u->avatar = $request->personPhoto;
                $update_u->avatar_original = $request->personPhoto;
                $update_u->save();

                $user = User::where('email', $request->email)->first();
            }else{
                $user = User::where('email', $request->email)->first();
            }

        } else {
            if($request->plateform){
                $user = new User([
                    'name' => $request->name,
                    'email' => $request->email,
                    'plateform' => $request->plateform,
                    'avatar' => $request->personPhoto,
                    'avatar_original' => $request->personPhoto,
                    'provider_id' => $request->provider,
                    'email_verified_at' => Carbon::now()
                ]);
            }elseif($request->personPhoto){
                $user = new User([
                    'name' => $request->name,
                    'email' => $request->email,
                    'plateform' => $request->plateform,
                    'avatar' => $request->personPhoto,
                    'avatar_original' => $request->personPhoto,
                    'provider_id' => $request->provider,
                    'email_verified_at' => Carbon::now()
                ]);
            }else{
                $user = new User([
                    'name' => $request->name,
                    'email' => $request->email,
                    'provider_id' => $request->provider,
                    'email_verified_at' => Carbon::now()
                ]);
            }

            $user->save();
            $customer = new Customer;
            $customer->user_id = $user->id;
            $customer->save();

            fmcSend("You have successfully create accounnt","Welcome bonos credit in scress card",null,'scratch',$user->id,user_device_id($user->id));

            $sct_data = array();
            $sct_data['user_id'] = $user->id;
            $sct_data['title'] = "welcome bonus";
            $sct_data['message'] = "welcome bonus";
            $sct_data['amount'] = 10;
            $sct_data['coupon_text'] = "welcome bonus won RS 10";
            $sct_data['type'] = "text";
            $sct_data['image'] = "";
            $sct_data['visibility'] = 1;
            $sct_data['cases'] = env('IN_CASH');
            addScratchCoupons($sct_data);

        }
        $tokenResult = $user->createToken('Personal Access Token');
        return $this->loginSuccess($tokenResult, $user, $request->device_token);
    }



    protected function loginSuccess($tokenResult, $user , $device_token)
    {


        // return $tokenResult;
        // $token = $tokenResult->plainTextToken;
        // // $token->expires_at = Carbon::now()->addWeeks(100);
        // $token->save();

        $user_tok = ModelsUser::where('id',$user->id)->first();
        if($user_tok){
            $user_tok->device_token  = $device_token;
            $user_tok->save();
        }
        // FmcController::sendFmcByUid("Welcome to ".env('APP_NAME'),"Login Successfully",null,"account",$user->id);
        return response()->json([
            'access_token' => $tokenResult->plainTextToken,
            'token_type' => 'Bearer',
            'error' => false,
            'message' => 'Login Success',
            'user' => [
                'id' => $user->id,
                'type' => $user->user_type,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => ($user->avatar=="" || $user->avatar==null)? "": get_image_by_upload_id($user->avatar),
                'avatar_original' => $user->avatar_original,
                'phone' => $user->phone,
                'plateform' => $user->plateform,
                'provider_id' => $user->provider_id,
            ]
        ]);
    }
}


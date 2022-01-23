<?php

namespace App\Http\Controllers\Admin\SMS;

use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageBird extends Controller
{
    public function sendOtp($data){
        $messageBird = new \MessageBird\Client(setting("message_bird_api_key"));
        // $balance = json_encode($messageBird->balance->read());
//         // return $balance;

      $Message = new \MessageBird\Objects\Message();
      $Message->originator = env("APP_NAME");
      $Message->recipients = array($data["phone"]);
      $Message->body = "Your OTP is : ".$data["otp"];

      return json_encode($messageBird->messages->create($Message));

        // print_r(json_decode($balance));
        // return "sdhgjgcjhf ". gettype($balance);

    }
    public function isMessageBirdInstall(Request $request){
        if(setting("message_bird_api_key")==""){
            return false;
        }
        SettingController::createUpdate("default_sms", "message_bird_api_key");
        return true;

    }
    public function saveMessageBird(Request $request){

        if($request->has("message_bird_api_key")){
            SettingController::createUpdate("message_bird_api_key",$request->message_bird_api_key);
        }

    }
    public function ballance(){

        $messageBird = new \MessageBird\Client(setting("message_bird_api_key"));
        $balance = json_encode($messageBird->balance->read());
        return json_decode($balance);

//   $Message = new \MessageBird\Objects\Message();
//   $Message->originator = 'TestMessage';
//   $Message->recipients = array(+917079692988);
//   $Message->body = 'This is a test message';

//   return json_encode($messageBird->messages->create($Message));

//         print_r(json_decode($balance));
//         return "sdhgjgcjhf ". gettype($balance);


    }
}

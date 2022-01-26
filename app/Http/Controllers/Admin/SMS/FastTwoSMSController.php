<?php

namespace App\Http\Controllers\Admin\SMS;

use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class FastTwoSMSController extends Controller
{
    public static function sendOTP($data = array()){
        $fields = array(
            "variables_values" => $data['otp'],
            "route" => "otp",
            "numbers" => $data['phone'],
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($fields),
          CURLOPT_HTTPHEADER => array(
            "authorization: ". setting('fast_2_sms_api_key'),
            "accept: */*",
            "cache-control: no-cache",
            "content-type: application/json"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        return $response;
    }

    public function saveF2s(Request $request){
        if(env('DEMO')){
            return back()->with("error","cannot update in demo");
        }
        if($request->has("fast_2_sms_api_key")){
            SettingController::createUpdate("fast_2_sms_api_key",$request->fast_2_sms_api_key);
        }

        if($request->has("is_f2s_dlt")){
            SettingController::createUpdate("is_f2s_dlt", ($request->is_f2s_dlt=="true")? "1":"0");
        }

    }
    public function isF2sInstall(Request $request){
        if(setting("fast_2_sms_api_key")==""){
            return false;
        }
        SettingController::createUpdate("default_sms", "fast_2_sms");
        return true;

    }
}

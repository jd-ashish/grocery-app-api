<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\ImageSlider;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class SettingController extends Controller
{
    public function ImageSliderIndex(){
        $slider = ImageSlider::orderBy('id','desc')->get();
        return view('admin.settings.home_section.image_slider.index',compact('slider'));
    }
    public function ImageSliderUpload(Request $request){
        return view('admin.settings.home_section.image_slider.create');
    }
    public function Cron(Request $request){
        return view('admin.cron.cron');
    }
    public function ImageSliderEdit($id){
        $slider = ImageSlider::findOrFail(decrypt($id));
        return view('admin.settings.home_section.image_slider.create',compact('slider'));
    }
    public function ImageSliderUploadDb(Request $request){
        $imageSlider = new ImageSlider();
        $imageSlider->user_id = Auth::user()->id;
        $imageSlider->image =$request->image;
        $imageSlider->status = 1;
        $imageSlider->save();
        return redirect(route('image.slider'))->with("success","Slider upload successfully");
    }
    public function ImageSliderUpdate(Request $request){
        $imageSlider =ImageSlider::findOrFail($request->id);
        $imageSlider->image =$request->image;
        $imageSlider->status = 1;
        $imageSlider->save();
        return redirect(route('image.slider'))->with("success","Slider update successfully");
    }
    public function ImageSliderDelete($id){
        ImageSlider::destroy(decrypt($id));
        return redirect(route('image.slider'))->with("success","Slider delete successfully");
    }
    public function GeneralSetting(){
        $general_setting = GeneralSetting::where('user_id',Auth::user()->id)->first();
        return view('admin.settings.home_section.general_setting',compact('general_setting'));
    }
    public function GeneralSettingStore(Request $request){
        if(env('DEMO')){
            return back()->with("error","cannot update in demo");
        }
        $general_setting = new GeneralSetting();
        $general_setting->user_id = Auth::user()->id;
        $general_setting->logo = $request->image;
        $general_setting->site_name = $request->site_name;
        $general_setting->address = $request->address;
        $general_setting->phone = $request->phone;
        $general_setting->email = $request->email;
        $general_setting->favicon = $request->favicon;
        $general_setting->facebook = $request->facebook;
        $general_setting->instagram = $request->instagram;
        $general_setting->twitter = $request->twitter;
        $general_setting->youtube = $request->youtube;
        if($general_setting->save()){
            notification("General setting Update","general setting saved successfully","general_setting",Auth::user()->id);
            return back()->with("success","general setting saved successfully");
        }else{
            return back()->with("error","Some thing going wrong , try after some time");
        }
    }
    public function GlobalSetting(){
        $general_setting = GeneralSetting::where('user_id',Auth::user()->id)->first();
        return view('admin.settings.home_section.GlobalSetting',compact('general_setting'));
    }
    public function privacy_policy_index(){
        return view("admin.settings.policy.privacy_policy");
    }
    public function TermsConditions(){
        return view("admin.settings.policy.terms_and_conditions");
    }
    public function returnPolicy(){
        return view("admin.settings.policy.return");
    }
    public function contactUs(){
        return view("admin.settings.policy.contact_us");
    }
    public function aboutUs(){
        return view("admin.settings.policy.about_us");
    }
    public function privacy_policy(Request $request){
        if(env('DEMO')){
            return back()->with("error","cannot update in demo");
        }
        $this->createUpdate($request->key,$request->val);
        notification("Policy update",ucfirst(str_replace("_"," ",$request->key))." Updated","global_setting",Auth::user()->id);
        return back()->with("success",ucfirst(str_replace("_"," ",$request->key))." Updated successfully");
    }
    public function GlobalSettingStore(Request $request){
        if(env('DEMO')){
            return back()->with("error","cannot update in demo");
        }

        // return $request;
        $setting = Setting::where('key_name','default_storage')->first();
        if($request->has("default_storage_driver")){
            $setting->value = $request->default_storage_driver;
        }



        $rzp = 0;
        $rzp_details = array();
        if($request->has("razorpay")){
            $rzp = 1;

            $this->updateENV("RZP_SECRT",$request->RZP_SECRT);
            $this->updateENV("RZP_KEY",$request->RZP_KEY);
            $this->updateENV("RZP_AUTH",$request->RZP_AUTH);
            $rzp_details = array(
                'RZP_SECRT' =>$request->RZP_SECRT,
                'RZP_KEY' => $request->RZP_KEY,
                'RZP_AUTH' => $request->RZP_AUTH
            );
        }
        if($request->has("razorpay")){
            $this->createUpdate("razorpay",$rzp);
            $this->createUpdate("rzp_details",$rzp_details);
        }

        $cashfree = 0;
        $cashfree_details = array();
        if($request->has("cashfree")){
            $cashfree = 1;

            $this->updateENV("APP_ID",$request->APP_ID);
            $this->updateENV("SecretKey",$request->SecretKey);
            $cashfree_details = array(
                'APP_ID' =>$request->APP_ID,
                'SecretKey' => $request->SecretKey
            );
        }

        if($request->has("cashfree")){
            $this->createUpdate("cashfree",$cashfree);
            $this->createUpdate("cashfree_details",$cashfree_details);
        }

        if($request->has("max_execlusive")){
            $this->createUpdate("max_execlusive",$request->max_execlusive);
        }
        if($request->has("system_default_currency")){
            $this->createUpdate("system_default_currency",$request->system_default_currency);
        }
        if($request->has("symbol_format")){
            $this->createUpdate("symbol_format",$request->symbol_format);
        }
        if($request->has("no_of_decimals")){
            $this->createUpdate("no_of_decimals",$request->no_of_decimals);
        }
        if($request->has("exclusive_offer_type")){
            $this->createUpdate("exclusive_offer_type",$request->exclusive_offer_type);
        }
        if($request->has("fmc")){
            $this->createUpdate("fmc",$request->fmc);
        }
        if($request->has("login_by_phone")){
            $this->createUpdate("login_by_phone",($request->login_by_phone=="on")? "1":"0");
        }else{
            $this->createUpdate("login_by_phone","0");
        }
        if($request->has("is_dummy")){
            $this->createUpdate("is_dummy",($request->is_dummy=="on")? "1":"0");
        }else{
            $this->createUpdate("is_dummy","0");
        }
        if($request->has("app_logo")){
            if($request->hasFile("app_logo")){
                if(setting("app_logo")!=""){
                    unlink(setting("app_logo"));
                }
                $path = $request->app_logo->store('uploads/media/logo');
                ImageOptimizer::optimize(base_path('public/').$path);
                $this->createUpdate("app_logo",$path);
            }
        }
        if($request->has("favicon")){
            if($request->hasFile("favicon")){
                if(setting("favicon")!=""){
                    unlink(setting("favicon"));
                }
                $path = $request->favicon->store('uploads/media/logo');
                ImageOptimizer::optimize(base_path('public/').$path);
                $this->createUpdate("favicon",$path);
            }
        }
        $this->createUpdate("is_send_email_at_time_order",($request->is_send_email_at_time_order=="on")? "yes":"no");
        $this->createUpdate("cod",($request->cod=="on")? "1":"0");

        if($setting->save()){
            notification("global setting Update","global setting saved successfully","global_setting",Auth::user()->id);
            return back()->with("success","Setting save successfully");
        }
    }
    public static function createUpdate($key,$val){

        $setting_update_create = Setting::where("key_name",$key)->first();
        if($setting_update_create){
            $setting_update_create->value = $val;
            $setting_update_create->save();
        }else{
            $setting_create = new Setting();
            $setting_create->key_name = $key;
            if($val!=""){
                $setting_create->value = $val;
            }
            $setting_create->save();
            $setting_update = Setting::where("key_name",$key)->first();
            $setting_update->value = $val;
            $setting_update->save();
        }
    }
    public function updateENV($key,$val){
        if(env($key)!=""){

        }else{
            $this->envUpdate($key,$val);
        }
    }
    public function StorageDriverCheck(Request $request){

        if($request->driver=="CloudinarDriver"){
            if(env('CLOUDINARY_URL')==""){
                return "error";
            }
            if(env('CLOUDINARY_UPLOAD_PRESET')==""){
                return "error";
            }
        }
    }
    public function StorageDriverSaveCloudinaryConfig(Request $request){
        $test = "2";
        if(env("CLOUDINARY_URL")!=""){

        }else{
            $this->envUpdate('CLOUDINARY_URL',$request->CLOUDINARY_URL);
        }

        if(env("CLOUDINARY_UPLOAD_PRESET")!=""){

        }else{
            $this->envUpdate('CLOUDINARY_UPLOAD_PRESET',$request->CLOUDINARY_UPLOAD_PRESET);
        }

        if(env("CLOUDINARY_NOTIFICATION_URL")!=""){

        }else{
            if($request->CLOUDINARY_NOTIFICATION_URL!=null){
                $this->envUpdate('CLOUDINARY_NOTIFICATION_URL',$request->CLOUDINARY_NOTIFICATION_URL);
            }
        }
        return $request;
    }
    public function env_create(Request $request)
    {
        $rand = rand(0,20);
        $host_key = "HOST".$rand;
        $host_value = $request->Host;

        $user_key = "USER".$rand;
        $user_value = $request->user;

        $PASSWORD_key = "PASSWORD".$rand;
        $PASSWORD_value = $request->pwd;

        $DBNAME_key = "DBNAME".$rand;
        $DBNAME_value = $request->DatabaseName;
        if(env($host_key) && env($user_key) && env($PASSWORD_key) && env($DBNAME_key)){
                echo "yes";
            return "All information already present key tyr another!";
        }else{
            $file = base_path('.env');
            $text = $host_key." = ".$host_value."\r\n";
            $text .= $user_key." = ".$user_value."\r\n";
            $text .= $PASSWORD_key." = ".$PASSWORD_value."\r\n";
            $text .= $DBNAME_key." = ".$DBNAME_value."\r\n\r\n";
            file_put_contents($file, $text, FILE_APPEND);
            return "Successfully place database created!";
        }
    }
    public static function envUpdate($key, $value)
    {
        file_put_contents(app()->environmentFilePath(), str_replace(
            $key . '=' . env($value),
            $key . '=' . $value,
            file_get_contents(app()->environmentFilePath())
        ));
    }

    public function Currency(){

    }
}

<?php

use App\Models\Notification;
use App\Models\Product;
use App\Models\Uploads;
use App\Setting;
use Facade\FlareClient\Http\Response;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

include 'api_helpers.php';
if (! function_exists('setting')) {
    function setting($key) {
        $setting = Setting::where('key_name', $key)->first();
        if($setting){
            return $setting->value;
        }
    }
}

if (! function_exists('send_otp')) {
    function send_otp($phone,$message) {

        Cookie::queue(Cookie::forget('otp'));
        Cookie::queue('otp', 123456, 10);
        return ['error' => false,'message' => "OTP send successfully" , 'otp' => 123456];
    }
}


if (! function_exists('notification')) {
    function notification($title,$description,$type,$user_id,$img=null) {
        return Notification::create([
            'user_id' => $user_id,
            'title' => $title,
            'description' => $description,
            'type' => $type,
            'status' => 1,
        ]);
    }
}
if (! function_exists('inline_brd')) {
    function inline_brd($arr = array()) {
        ?>
            <div class="d-flex align-items-end flex-wrap">
                <div class="d-flex">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>
                    <?php

                        for($i=0; $i<count($arr); $i++){
                            $class = 'text-muted';
                            $sps = '';
                            $sps2 = '';
                            if(($i+1)==count($arr)){
                                $class = 'text-primary';
                            }
                            if($i==0){
                                $sps = '&nbsp;/&nbsp;';
                            }
                            if($i>0 && ($i+1)<count($arr)){
                                $sps2 = '&nbsp;/&nbsp;';
                            }
                            echo $data = '<p class="'.$class.' mb-0 hover-cursor">'.$sps . $arr[$i] . $sps .$sps2.'</p>';
                        }
                    ?>
                </div>
            </div>
        <?php
    }
}
if (! function_exists('get_image_by_upload_id')) {
    function get_image_by_upload_id($id) {
        $upload = Uploads::where("id",$id)->first();
        if($upload->upload_to=="cloudinar"){
            return $upload->single_file_full_url;
        }
        if($upload->upload_to=="local"){
            return asset($upload->single_file);
        }
    }
}
if (! function_exists('get_all_image_by_upload_id')) {
    function get_all_image_by_upload_id($ids) {
        $photos = array();
        foreach(explode("|",$ids) as $id){
            $upload = Uploads::where("id",$id)->first();
            if($upload->upload_to=="cloudinar"){
                $photos[] = $upload->single_file_full_url;
            }
            if($upload->upload_to=="local"){
                $photos[] = asset($upload->single_file);
            }
        }
        return ($photos);

    }
}

if (! function_exists('get_image_array_by_upload_id')) {
    function get_image_array_by_upload_id($id) {
        $arr = array();
        $upload = Uploads::where("id",$id)->first();
        if($upload->upload_to=="cloudinar"){
            $obj = json_decode($upload->json_data);
            $arr = array(
                "created_at" => $upload->created_at->diffForHumans(),
                "image_id" => $upload->id,
                "img_url" => $upload->single_file_full_url,
                "size" => $obj->getReadableSize,
                "dimensions" => $obj->getHeight." X ".$obj->getWidth,
                "title" => "",
                "alt" => $upload->alt,
            );
        }
        if($upload->upload_to=="local"){
            $arr = array(
                "created_at" => $upload->created_at->diffForHumans(),
                "image_id" => $upload->id,
                "img_url" => asset($upload->single_file),
                "size" => "",
                "dimensions" => "",
                "title" => "",
                "alt" => $upload->alt,
            );
        }

        return $arr;
    }
}


if (! function_exists('delete_image_by_upload_id')) {
    function delete_image_by_upload_id($upload_id) {
        $upload = Uploads::where("id",$upload_id)->first();

        if($upload==null){
            return ["error" => true , "message" => "No data found! "];
        }
        if($upload->in_use==1){
            return ["error" => true , "message" => "This image already used you can not delete this!"];
        }
        if($upload->upload_to=="cloudinar"){

            // return json_decode($upload->json_data)->id;
            Cloudinary::destroy(json_decode($upload->json_data)->id);
            $upload->delete();
        }
        if($upload->upload_to=="local"){

            // return json_decode($upload->json_data)->id;
            unlink(($upload->single_file));
            $upload->delete();
        }
        if($upload->location_type=="user"){

            $user = User::where('avatar',$upload_id)->first();
            $user->avatar = "";
            $user->save();
        }
        return ["error" => false , "message" => "This image deleted successfully!"];
    }
}

if (! function_exists('seo_')){
    function seo_($str){
        $seo = strtolower(str_replace("--","-",str_replace(":","-",str_replace("://","-",str_replace(".","-",str_replace(" ","-",$str))))));
        return $seo;
    }
}

//returns combinations of customer choice options array
if (! function_exists('combinations')) {
    function combinations($arrays) {
        $result = array(array());
        foreach ($arrays as $property => $property_values) {
            $tmp = array();
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, array($property => $property_value));
                }
            }
            $result = $tmp;
        }
        return $result;
    }
}

if (! function_exists('table_more')) {
    function table_more($arr) {
        ?>
            <div class="dropdown">
                <a class="nav-link " href="#"
                        data-toggle="dropdown" id="profileDropdown">
                        <i class="mdi mdi-drag-vertical"></i>
                </a>
                <div class="dropdown-menu">
                    <?php
                    foreach($arr as $item){
                        ?>
                        <a class="dropdown-item <?php if($item['isDelete']==true) {echo "cnf-del";}else{echo "";} ?>" style="font-size: 18px; padding:11px" href="<?php if($item['isLink']==true) {echo $item['route'];}else{echo "#".$item['name2'];} ?>" route="<?= $item['route']?>">
                        <?= $item['icon']?>
                        <?= $item['name']?>
                    </a>
                        <?php
                    }

                    ?>


                </div>
            </div>
        <?php
    }
}


//Api
if (! function_exists('homeBasePrice')) {
    function homeBasePrice($id)
    {
        $product = Product::findOrFail($id);
        $price = $product->unit_price;
        if ($product->tax_type == 'percent') {
            $price += ($price * $product->tax) / 100;
        } elseif ($product->tax_type == 'amount') {
            $price += $product->tax;
        }
        return $price;
    }
}

if (! function_exists('homeDiscountedPrice')) {
    function homeDiscountedPrice($id)
    {
        $product = Product::findOrFail($id);
        $lowest_price = $product->unit_price;
        $highest_price = $product->unit_price;

        if ($product->variant_product) {
            foreach ($product->stocks as $key => $stock) {
                if($lowest_price > $stock->price){
                    $lowest_price = $stock->price;
                }
                if($highest_price < $stock->price){
                    $highest_price = $stock->price;
                }

            }
        }
        // $lowest_price = convertPrice($lowest_price);
        // $highest_price = convertPrice($highest_price);

        return $lowest_price.' - '.$highest_price;
    }
}

if (! function_exists('homeDiscountedPrice')) {
    function homeDiscountedPrice($id)
    {
        $product = Product::findOrFail($id);
        $lowest_price = $product->unit_price;
        $highest_price = $product->unit_price;

        if ($product->variant_product) {
            foreach ($product->stocks as $key => $stock) {
                if($lowest_price > $stock->price){
                    $lowest_price = $stock->price;
                }
                if($highest_price < $stock->price){
                    $highest_price = $stock->price;
                }
            }
        }


        // $lowest_price = convertPrice($lowest_price);
        // $highest_price = convertPrice($highest_price);

        return $lowest_price.' - '.$highest_price;
    }
}

// if (! function_exists('convertPrice')) {
//     function convertPrice($price)
//     {
//         $business_settings = BusinessSetting::where('type', 'system_default_currency')->first();
//         if ($business_settings != null) {
//             $currency = Currency::find($business_settings->value);
//             $price = floatval($price) / floatval($currency->exchange_rate);
//         }
//         $code = Currency::findOrFail(BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
//         if (Session::has('currency_code')) {
//             $currency = Currency::where('code', Session::get('currency_code', $code))->first();
//         } else {
//             $currency = Currency::where('code', $code)->first();
//         }
//         $price = floatval($price) * floatval($currency->exchange_rate);
//         return $price;
//     }
// }

//converts currency to home default currency
if (! function_exists('convert_price')) {
    function convert_price($price)
    {
        // $business_settings = BusinessSetting::where('type', 'system_default_currency')->first();
        // if($business_settings!=null){
        //     $currency = Currency::find($business_settings->value);
        //     $price = floatval($price) / floatval($currency->exchange_rate);
        // }

        // $code = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
        // if(Session::has('currency_code')){
        //     $currency = Currency::where('code', Session::get('currency_code', $code))->first();
        // }
        // else{
        //     $currency = Currency::where('code', $code)->first();
        // }

        // $price = floatval($price) * floatval($currency->exchange_rate);

        return $price;
    }
}

//formats currency
if (! function_exists('format_price')) {
    function format_price($price)
    {

        return $price;
        // if(BusinessSetting::where('type', 'symbol_format')->first()->value == 1){
        //     return currency_symbol().ceil($price);
        //     //return currency_symbol().(int)(number_format($price, BusinessSetting::where('type', 'no_of_decimals')->first()->value));
        // }
        // return number_format($price, BusinessSetting::where('type', 'no_of_decimals')->first()->value).currency_symbol();
    }
}
//formats currency
// if (! function_exists('format_price2')) {
//     function format_price2($price)
//     {
//         if(BusinessSetting::where('type', 'symbol_format')->first()->value == 1){
//             // return currency_symbol().ceil($price);
//             return currency_symbol().(number_format($price, BusinessSetting::where('type', 'no_of_decimals')->first()->value));
//         }
//         return number_format($price, BusinessSetting::where('type', 'no_of_decimals')->first()->value).currency_symbol();
//     }
// }
//formats price to home default price with convertion
if (! function_exists('single_price')) {
    function single_price($price)
    {
        return format_price(convert_price($price));
    }
}

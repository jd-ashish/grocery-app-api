<?php

namespace App\Http\Controllers\Admin\MAIL;

use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Controller;
use App\Mail\ConfirmOrder;
use App\Mail\TestConfig;
use App\Mail\TestPdfConfig;
use App\Models\Order;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index(){
        return view('admin.conf.email');
    }

    public function sendTestSmtpEmail(Request $request){
        if(env("MAIL_HOST")=="" || env('MAIL_PORT')=="" || env('MAIL_USERNAME')=="" || env('MAIL_PASSWORD')=="" || env('MAIL_ENCRYPTION')=="" || env('MAIL_FROM_ADDRESS')==""){
            return [
                "error" => true,
                "message" => "Complete email config form"
            ];
        }

        // $array = array("message" =>  "woo good","status" => 200);

        // $pdf = PDF::setOptions([
        //     'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
        //     'logOutputFile' => storage_path('logs/log.htm'),
        //     'tempDir' => storage_path('logs/')
        // ])->loadView('mail.test_config', compact('array'));

        // $details =[
        //     'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
        //     'logOutputFile' => storage_path('logs/log.htm'),
        //     'tempDir' => storage_path('logs/')
        // ];
        // $pdf = PDF::loadView('Your view path', $details);
// $output = $pdf->output();
// file_put_contents('public/invoices/'.'Order#456465.pdf', $output);

// $array['view'] = 'emails.invoice';
// $array['subject'] = 'Order Placed - '.$order->code;
// $array['from'] = env('MAIL_USERNAME');
// $array['content'] = 'Hi. A new order has been placed. Please check the attached invoice.';
// $array['file'] = 'public/invoices/Order#'.$order->code.'.pdf';
// $array['file_name'] = 'Order#'.$order->code.'.pdf';

$order = Order::where("id",12)->first();

// $admin_products = array();
// $seller_products = array();
// foreach ($order->orderDetails as $key => $orderDetail){
// if($orderDetail->product->added_by == 'admin'){
//     array_push($admin_products, $orderDetail->product->id);
// }
// else{
//     $product_ids = array();
//     if(array_key_exists($orderDetail->product->user_id, $seller_products)){
//         $product_ids = $seller_products[$orderDetail->product->user_id];
//     }
//     array_push($product_ids, $orderDetail->product->id);
//     $seller_products[$orderDetail->product->user_id] = $product_ids;
// }
// }

// Mail::to($request->SEND_TEST_EMAIL)->queue(new TestPdfConfig($array));



        Mail::to($request->SEND_TEST_EMAIL)->send(new ConfirmOrder($order));
        if(env("SEND_TEST_EMAIL")!=""){
            $this->overWriteEnvFile("SEND_TEST_EMAIL",$request->SEND_TEST_EMAIL);
        }else{
            SettingController::envUpdate("SEND_TEST_EMAIL",$request->SEND_TEST_EMAIL);
        }

        // Mail::to($request->SEND_TEST_EMAIL)->queue(new TestConfig());
        return [
            "error" => false,
            "message" => "Test message send successfully to ". $request->SEND_TEST_EMAIL
        ];
    }

    public function saveSmtp(Request $request){


        $validated = $request->validate([
            'MAIL_HOST' => 'required',
            'MAIL_PORT' => 'required',
            'MAIL_USERNAME' => 'required',
            'MAIL_PASSWORD' => 'required',
            'MAIL_ENCRYPTION' => 'required',
            'MAIL_FROM_ADDRESS' => 'required',
        ]);


        // return $request;

        $this->overWriteEnvFile("MAIL_HOST",$request->MAIL_HOST);
        $this->overWriteEnvFile("MAIL_PORT",$request->MAIL_PORT);
        $this->overWriteEnvFile("MAIL_USERNAME",$request->MAIL_USERNAME);
        $this->overWriteEnvFile("MAIL_PASSWORD",$request->MAIL_PASSWORD);
        $this->overWriteEnvFile("MAIL_ENCRYPTION",$request->MAIL_ENCRYPTION);
        $this->overWriteEnvFile("MAIL_FROM_ADDRESS",$request->MAIL_FROM_ADDRESS);
        SettingController::createUpdate("default_email", "smtp");


    }



    public function overWriteEnvFile($key, $val)
    {

        $path = base_path('.env');

    if(is_bool(env($key)))
    {
        $old = env($key)? 'true' : 'false';
    }
    elseif(env($key)===null){
        $old = 'null';
    }
    else{
        $old = env($key);
    }

    if (file_exists($path)) {
        file_put_contents($path, str_replace(
            "$key=".$old, "$key=".$val, file_get_contents($path)
        ));
    }
        // $path = base_path('.env');
        // if (file_exists($path)) {
        //     $val = '"'.trim($val).'"';
        //     if(is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0){
        //         file_put_contents($path, str_replace(
        //             $type.'="'.env($type).'"', $type.'='.$val, file_get_contents($path)
        //         ));
        //     }
        //     else{
        //         file_put_contents($path, file_get_contents($path)."\r\n".$type.'='.$val);
        //     }
        // }
    }
}

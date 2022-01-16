<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmOrder;
use App\Models\CronJobModel\OrderJob;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CronJobController extends Controller
{
    public function Order(){
        $JobOrder = OrderJob::where('status',0)->get();
        foreach ($JobOrder as $key => $value) {
            $order = Order::findOrFail($value->order_id);

            if($order->user->email!=""){
                notification("New Order","New order has been placed successfully","new_order",$order->user->id);
                Mail::to($order->user->email)->send(new ConfirmOrder($order));
                $value->status = 1;
                $value->save();
            }

        }
    }
}

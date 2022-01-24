<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseHistoryCollection;
use App\Mail\ConfirmOrder;
use App\Models\Carts;
use App\Models\CronJobModel\OrderJob;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\RefundOrder;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function processOrder(Request $request)
    {
        // $shippingAddress = json_decode($request->shipping_address);
        // create an order


        $cartItems = Carts::where('user_id', Auth::user()->id)->get();
        if(count($cartItems)==0){
            return response()->json([
                'error' => true,
                'message' => 'Your have not added any grocery product in your cart'
            ]);
        }
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'shipping_address' => $request->address_id,
            'payment_type' => $request->payment_type,
            'payment_status' => $request->payment_status,
            'payment_details' => $request->payment_details,
            'grand_total' => $request->grand_total,
            'coupon_discount' => 0,
            'code' => date('Ymd-his'),
            'date' => strtotime('now')
        ]);
        // save order details
        foreach ($cartItems as $cartItem) {
            $product = Product::findOrFail($cartItem->product_id);
            if ($cartItem->product_stock_id) {
                $cartItemVariation = $cartItem->product_stock_id;
                $product_stocks = ProductStock::where("id",$cartItem->product_stock_id)->first();
                $product_stocks->qty -= $cartItem->qty;
                $product_stocks->save();
            } else {
                $product->update([
                    'current_stock' => DB::raw('current_stock - ' . $cartItem->qty)
                ]);
            }
            OrderDetail::create([
                'order_id' => $order->id,
                'seller_id' => $product->user_id,
                'product_id' => $product->id,
                'variation' => ($cartItem->product_stock_id)? ProductStock::where("id",$cartItem->product_stock_id)->first()->variant:$cartItem->product_stock_id,
                'price' => $cartItem->price * $cartItem->qty,
                'quantity' => $cartItem->qty,
                'payment_status' => $request->payment_status
            ]);
            $product->update([
                'num_of_sale' => DB::raw('num_of_sale + ' . $cartItem->qty)
            ]);
        }
        // apply coupon usage
        // if ($request->coupon_code != '') {
        //     CouponUsage::create([
        //         'user_id' => Auth::user()->id,
        //         'coupon_id' => Coupon::where('code', $request->coupon_code)->first()->id
        //     ]);
        // }

                //stores the pdf for invoice


        // calculate commission
        // $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
        // foreach ($order->orderDetails as $orderDetail) {
        //     if ($orderDetail->product->user->user_type == 'seller') {
        //         $seller = $orderDetail->product->user->seller;
        //         $price = $orderDetail->price + $orderDetail->tax + $orderDetail->shipping_cost;
        //         $seller->update([
        //             'admin_to_pay' => ($request->payment_type == 'cash_on_delivery') ? $seller->admin_to_pay - ($price * $commission_percentage) / 100 : $seller->admin_to_pay + ($price * (100 - $commission_percentage)) / 100
        //         ]);
        //     }
        // }
        // clear user's cart
        $user = User::findOrFail(Auth::user()->id);
        $user->carts()->delete();


        if(setting("is_send_email_at_time_order")=="no" && Auth::user()->email!=""){
            Mail::to($request->SEND_TEST_EMAIL)->send(new ConfirmOrder($order));
        }else{
            $OrderJob = new OrderJob();
            $OrderJob->order_id = $order->id;
            $OrderJob->type = "success";
            $OrderJob->action = "email";
            $OrderJob->status = 0;
            $OrderJob->save();
        }
        if(setting("is_send_email_at_time_order")=="no"){
            notification("New Order","New order has been placed successfully","new_order",Auth::user()->id);
        }else{
            $OrderJob = new OrderJob();
            $OrderJob->order_id = $order->id;
            $OrderJob->type = "success";
            $OrderJob->action = "notification";
            $OrderJob->status = 0;
            $OrderJob->save();
        }

        $data_fmc=[
            "title"=>"Order placed successfully",
            "message"=>"Your order has been placed successfully",
            "image"=>null,
            "type"=>"new_order",
            "user_id"=> Auth::user()->id,
        ];

        fmc($data_fmc);

        return response()->json([
            'error' => false,
            'message' => 'Your order has been placed successfully'
        ]);
    }

    public function store(Request $request)
    {
        // return $user = User::findOrFail(Auth::user()->id);
        // return $user->carts;
        return $this->processOrder($request);
    }
    public function orders_history(Request $request,$status)
    {
        if($status=="null"){
            return new PurchaseHistoryCollection(Order::where('user_id', Auth::user()->id)->latest()->paginate(10));
        }else{
            return new PurchaseHistoryCollection(Order::where('user_id', Auth::user()->id)->where('delivery_status',$status)->latest()->paginate(10));
        }
        //->where('payment_status',$status)
    }
    public function orders_track($id)
    {
        return new PurchaseHistoryCollection(Order::where('user_id', Auth::user()->id)->where('code',$id)->latest()->get());
    }
    public function orders_cancel($id)
    {
        $order = Order::where('user_id', Auth::user()->id)->where('code',$id)->first();
        $oid_cancel = $order->orderDetails->first();

        if($oid_cancel->delivery_status=='cancel'){
            notification("Order cancel","Your order had already canceled","order_cancel_fail",Auth::user()->id);

            return response()->json([
                'error' => true,
                'message' => 'Your order had already canceled'
            ]);;
        }

        if($oid_cancel->delivery_status=='on_review'){
            if($order->payment_status=='paid' || $order->payment_status=='done'){

                $refund_order = new RefundOrder();
                $refund_order->user_id = Auth::user()->id;
                $refund_order->order_Id = $order->id;
                $refund_order->details = $order->payment_details;
                $refund_order->status = 0;
                $refund_order->save();
            }
            $order->delivery_status = 'cancel';
		OrderDetail::where('order_id', $order->id)->update(['delivery_status'=>"cancel"]);

        }
        if($oid_cancel->delivery_status=='pending'){
            if($order->payment_status=='paid' || $order->payment_status=='done'){

                $refund_order = new RefundOrder();
                $refund_order->user_id = Auth::user()->id;
                $refund_order->order_Id = $order->id;
                $refund_order->details = $order->payment_details;
                $refund_order->status = 0;
                $refund_order->save();
            }
            $order->delivery_status = 'cancel';
            OrderDetail::where('order_id', $order->id)->update(['delivery_status'=>"cancel"]);
        }
        $users = User::where('id',$order->user_id)->first();


        //print_r(json_encode($order));

        $order->delivery_viewed = '0';

        // return $order;
        $order->save();

        // if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_delivery_status')->first()->value){
        //     try {
        //         $otpController = new OTPVerificationController;
        //         $otpController->send_delivery_status($order);
        //     } catch (\Exception $e) {
        //     }
        // }
        notification("Order cancel","Your order is cancelled successfully","order_cancel_success",Auth::user()->id);
        return response()->json([
                'error' => false,
                'message' => 'Your order is cancelled successfully'
            ]);;
    }
}

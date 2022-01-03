<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource to seller.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = DB::table('orders')
                    ->orderBy('code', 'desc')
                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->where('order_details.seller_id', Auth::user()->id)
                    ->select('orders.id')
                    ->distinct()
                    ->paginate(15);

        foreach ($orders as $key => $value) {
            $order = Order::find($value->id);
            $order->viewed = 1;
            $order->save();
        }

        return view('admin.order.index', compact('orders'));
    }

    /**
     * Display a listing of the resource to admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_orders(Request $request)
    {

        $payment_status = null;
        $delivery_status = null;
        $sort_search = null;
        $admin_user_id = User::where('user_type', 'admin')->first()->id;
        $orders = DB::table('orders')
                    ->orderBy('code', 'desc')
                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->where('order_details.seller_id', $admin_user_id)
                    ->select('orders.id')
                    ->distinct();

        if ($request->payment_type != null){
            $orders = $orders->where('order_details.payment_status', $request->payment_type);
            $payment_status = $request->payment_type;
        }
        if ($request->delivery_status != null) {
            $orders = $orders->where('order_details.delivery_status', $request->delivery_status);
            $delivery_status = $request->delivery_status;
        }
        if ($request->has('search')){
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%'.$sort_search.'%');
        }
        $orders = $orders->paginate(15);
        return view('admin.order.index', compact('orders','payment_status','delivery_status', 'sort_search', 'admin_user_id'));
    }


    // /**
    //  * Display a listing of the sales to admin.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function sales(Request $request)
    // {
    //     CoreComponentRepository::instantiateShopRepository();

    //     $sort_search = null;
    //     $orders = Order::orderBy('code', 'desc');
    //     if ($request->has('search')){
    //         $sort_search = $request->search;
    //         $orders = $orders->where('code', 'like', '%'.$sort_search.'%');
    //     }
    //     $orders = $orders->paginate(15);
    //     return view('sales.index', compact('orders', 'sort_search'));
    // }


    // public function order_index(Request $request)
    // {
    //     if (Auth::user()->user_type == 'staff') {
    //         //$orders = Order::where('pickup_point_id', Auth::user()->staff->pick_up_point->id)->get();
    //         $orders = DB::table('orders')
    //                     ->orderBy('code', 'desc')
    //                     ->join('order_details', 'orders.id', '=', 'order_details.order_id')
    //                     ->where('order_details.pickup_point_id', Auth::user()->staff->pick_up_point->id)
    //                     ->select('orders.id')
    //                     ->distinct()
    //                     ->paginate(15);

    //         return view('pickup_point.orders.index', compact('orders'));
    //     }
    //     else{
    //         //$orders = Order::where('shipping_type', 'Pick-up Point')->get();
    //         $orders = DB::table('orders')
    //                     ->orderBy('code', 'desc')
    //                     ->join('order_details', 'orders.id', '=', 'order_details.order_id')
    //                     ->where('order_details.shipping_type', 'pickup_point')
    //                     ->select('orders.id')
    //                     ->distinct()
    //                     ->paginate(15);

    //         return view('pickup_point.orders.index', compact('orders'));
    //     }
    // }

    // public function pickup_point_order_sales_show($id)
    // {
    //     if (Auth::user()->user_type == 'staff') {
    //         $order = Order::findOrFail(decrypt($id));
    //         return view('pickup_point.orders.show', compact('order'));
    //     }
    //     else{
    //         $order = Order::findOrFail(decrypt($id));
    //         return view('pickup_point.orders.show', compact('order'));
    //     }
    // }

    // /**
    //  * Display a single sale to admin.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    public function sales_show($id)
    {
        $order = Order::findOrFail(decrypt($id));
        $order->viewed = 1;
        $order->save();
        return view('admin.order.order_details', compact('order'));
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     $order = new Order;
    //     if(Auth::check()){
    //         $order->user_id = Auth::user()->id;
    //     }
    //     else{
    //         $order->guest_id = mt_rand(100000, 999999);
    //     }

    //     $order->shipping_address = json_encode($request->session()->get('shipping_info'));

    //     // if (Session::get('delivery_info')['shipping_type'] == 'Home Delivery') {
    //     //     $order->shipping_type = Session::get('delivery_info')['shipping_type'];
    //     // }
    //     // elseif (Session::get('delivery_info')['shipping_type'] == 'Pick-up Point') {
    //     //     $order->shipping_type = Session::get('delivery_info')['shipping_type'];
    //     //     $order->pickup_point_id = Session::get('delivery_info')['pickup_point_id'];
    //     // }

    //     $order->payment_type = $request->payment_option;
    //     $order->delivery_viewed = '0';
    //     $order->payment_status_viewed = '0';
    //     $order->code = date('Ymd-His').rand(10,99);
    //     $order->date = strtotime('now');

    //     if($order->save()){
    //         $subtotal = 0;
    //         $tax = 0;
    //         $shipping = 0;
    //         foreach (Session::get('cart') as $key => $cartItem){
    //             $product = Product::find($cartItem['id']);

    //             $subtotal += $cartItem['price']*$cartItem['quantity'];
    //             $tax += $cartItem['tax']*$cartItem['quantity'];

    //             if(Session::has('online')){
    //                 $shipping += 0;
    //             }else{
    //                 if($request->payment_option=="wallet"){
    //                     $shipping += 0;
    //                 }else{
    //                     if ($cartItem['shipping_type'] == 'home_delivery') {
    //                         $shipping += \App\Product::find($cartItem['id'])->shipping_cost;//*$cartItem['quantity']
    //                     }
    //                 }

    //             }


    //             $product_variation = $cartItem['variant'];

    //             if($product_variation != null){
    //                 $product_stock = $product->stocks->where('variant', $product_variation)->first();
    //                 $product_stock->qty -= $cartItem['quantity'];
    //                 $product_stock->save();
    //             }
    //             else {
    //                 $product->current_stock -= $cartItem['quantity'];
    //                 $product->save();
    //             }

    //             $order_detail = new OrderDetail;
    //             $order_detail->order_id  =$order->id;
    //             $order_detail->seller_id = $product->user_id;
    //             $order_detail->product_id = $product->id;
    //             $order_detail->variation = $product_variation;
    //             $order_detail->price = $cartItem['price'] * $cartItem['quantity'];
    //             $order_detail->tax = $cartItem['tax'] * $cartItem['quantity'];
    //             $order_detail->shipping_type = $cartItem['shipping_type'];
    //             $order_detail->product_referral_code = $cartItem['product_referral_code'];

    //             if ($cartItem['shipping_type'] == 'home_delivery') {
    //                 $order_detail->shipping_cost = \App\Product::find($cartItem['id'])->shipping_cost;//*$cartItem['quantity']
    //             }
    //             else{
    //                 $order_detail->shipping_cost = 0;
    //                 $order_detail->pickup_point_id = $cartItem['pickup_point'];
    //             }

    //             $order_detail->quantity = $cartItem['quantity'];
    //             $order_detail->save();

    //             $product->num_of_sale++;
    //             $product->save();
    //         }



    //         $order->grand_total = $subtotal + $tax + $shipping;


    //         if(Session::has('coupon_discount')){
    //             $order->grand_total -= Session::get('coupon_discount');
    //             $order->coupon_discount = Session::get('coupon_discount');

    //             $coupon_usage = new CouponUsage;
    //             $coupon_usage->user_id = Auth::user()->id;
    //             $coupon_usage->coupon_id = Session::get('coupon_id');
    //             $coupon_usage->save();
    //         }
    //         if(Session::has('coupon_desc')){
    //             $order->cashback_coupon = 1;

    //             $coupon_usage = new CouponUsage;
    //             $coupon_usage->user_id = Auth::user()->id;
    //             $coupon_usage->coupon_id = Session::get('coupon_id');
    //             $coupon_usage->save();
    //         }


    //         $order->save();

    //         $CashbackCronjob = \App\CashbackCronjob::where('user_id', $order->user_id)->where('order_id',0)->orderBy('id','DESC')->first();
    //         if($CashbackCronjob){
    //             $CashbackCronjob->order_id =$order->id;
    //             $CashbackCronjob->status =1;
    //             $CashbackCronjob->save();
    //         }

    //         //stores the pdf for invoice
    //         $pdf = PDF::setOptions([
    //                         'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
    //                         'logOutputFile' => storage_path('logs/log.htm'),
    //                         'tempDir' => storage_path('logs/')
    //                     ])->loadView('invoices.customer_invoice', compact('order'));
    //         $output = $pdf->output();
    // 		file_put_contents('public/invoices/'.'Order#'.$order->code.'.pdf', $output);

    //         $array['view'] = 'emails.invoice';
    //         $array['subject'] = 'Order Placed - '.$order->code;
    //         $array['from'] = env('MAIL_USERNAME');
    //         $array['content'] = 'Hi. A new order has been placed. Please check the attached invoice.';
    //         $array['file'] = 'public/invoices/Order#'.$order->code.'.pdf';
    //         $array['file_name'] = 'Order#'.$order->code.'.pdf';

    //         $admin_products = array();
    //         $seller_products = array();
    //         foreach ($order->orderDetails as $key => $orderDetail){
    //             if($orderDetail->product->added_by == 'admin'){
    //                 array_push($admin_products, $orderDetail->product->id);
    //             }
    //             else{
    //                 $product_ids = array();
    //                 if(array_key_exists($orderDetail->product->user_id, $seller_products)){
    //                     $product_ids = $seller_products[$orderDetail->product->user_id];
    //                 }
    //                 array_push($product_ids, $orderDetail->product->id);
    //                 $seller_products[$orderDetail->product->user_id] = $product_ids;
    //             }
    //         }

    //         foreach($seller_products as $key => $seller_product){
    //             try {
    //                 Mail::to(\App\User::find($key)->email)->queue(new InvoiceEmailManager($array));
    //             } catch (\Exception $e) {

    //             }
    //         }

    //         if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_order')->first()->value){
    //             try {
    //                 $otpController = new OTPVerificationController;
    //                 $otpController->send_order_code($order);
    //             } catch (\Exception $e) {

    //             }
    //         }

    //         //sends email to customer with the invoice pdf attached
    //         if(env('MAIL_USERNAME') != null){
    //             try {
    //                 Mail::to($request->session()->get('shipping_info')['email'])->queue(new InvoiceEmailManager($array));
    //                 Mail::to(User::where('user_type', 'admin')->first()->email)->queue(new InvoiceEmailManager($array));
    //             } catch (\Exception $e) {

    //             }
    //         }
    //         unlink($array['file']);

    //         $request->session()->put('order_id', $order->id);
    //     }
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     $order = Order::findOrFail(decrypt($id));
    //     $order->viewed = 1;
    //     $order->save();
    //     return view('orders.show', compact('order'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     $order = Order::findOrFail($id);

    //     if($order != null){
    //         foreach($order->orderDetails as $key => $orderDetail){
    //             $orderDetail->delete();
    //         }
    //         OrderCancelDetails::where('order_id', $id)->delete();
    //         CourierDetails::where('order_id', $id)->delete();
    //         $order->delete();
    //         flash('Order has been deleted successfully')->success();
    //     }
    //     else{
    //         flash('Something went wrong')->error();
    //     }
    //     return back();
    // }

    // public function order_details(Request $request)
    // {
    //     $order = Order::findOrFail($request->order_id);
    //     //$order->viewed = 1;
    //     $order->save();
    //     return view('frontend.partials.order_details_seller', compact('order'));
    // }

    public function update_delivery_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $oid_cancel = $order->orderDetails->first();
        if($oid_cancel->delivery_status=='cancel'){
            return 2;
        }
        $users = User::where('id',$order->user_id)->first();


        //print_r(json_encode($order));


        if($request->status=="on_delivery"){

            /* if($order->payment_type=="cash_on_delivery"){
                $paymentMod = "cod";
            }else{
                $paymentMod = "Prepaid";
            }

            $arrayData = array(
                'order_id'               =>      $order->code,
                'order_date'        =>     $order->created_at,
                'pickup_location'   =>      "Bhowrra",
                'billing_customer_name'             =>      json_decode($order->shipping_address)->name,
                'billing_last_name'             =>          "",
                'billing_address'               =>          json_decode($order->shipping_address)->address,
                'billing_address_2'             =>          "",
                'billing_city'              =>              json_decode($order->shipping_address)->city,
                'billing_pincode'               =>          json_decode($order->shipping_address)->postal_code,
                'billing_state'             =>              $users->state,
                'billing_country'               =>          json_decode($order->shipping_address)->country,
                'billing_email'             =>              json_decode($order->shipping_address)->email,
                'billing_phone'             =>              json_decode($order->shipping_address)->phone,
                'shipping_is_billing'               =>      true,
                'shipping_customer_name'            =>      "",
                'shipping_last_name'            =>      "",
                'shipping_address'              =>      "",
                'shipping_address_2'            =>      "",
                'shipping_city'             =>          "",
                'shipping_pincode'              =>      "",
                'shipping_country'              =>      "",
                'shipping_state'            =>          "",
                'shipping_email'            =>          "",
                'shipping_phone'            =>          "",
                'payment_method'            =>          $paymentMod,
                'shipping_charges'              =>      0,
                'giftwrap_charges'              =>      0,
                'transaction_charges'               =>      0,
                'total_discount'            =>          0,
                'sub_total'             =>      $order->grand_total,
                'length'            =>      $request->length,
                'breadth'               =>      $request->breadth,
                'height'            =>      $request->height,
                'weight'            =>      $request->weight,

            );
            $html = array();
            foreach($order->orderDetails->where('seller_id', \App\User::where('user_type', 'admin')->first()->id) as $key => $orderDetails){
                $html[] = array(
                    "name"  => $orderDetails->product->name,
                    "sku"   => explode("-",$order->code)[1]."-".$orderDetails->product->id,
                    "units"  => $orderDetails->quantity,
                    "selling_price"     => ($orderDetails->price),
                    "discount"   => "",
                    "tax"    => "",
                    "hsn"    => ""
                );
            }

            //echo json_encode($html);
            $arrayData['order_items'] = $html;
            $courier_status_code = json_decode(courier_order($arrayData), true);
            print_r($courier_status_code);
            if($courier_status_code['status_code'] == 1){
                $CourierDetails->order_id = $order->code;
                $CourierDetails->courier_details_josn = json_encode($courier_status_code);
                $CourierDetails->save();
            } */

        }


        if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'seller'){
            foreach($order->orderDetails->where('seller_id', Auth::user()->id) as $key => $orderDetail){
                $orderDetail->delivery_status = $request->status;
                $orderDetail->save();
            }
        }
        else{
            foreach($order->orderDetails->where('seller_id', User::where('user_type', 'admin')->first()->id) as $key => $orderDetail){
                $orderDetail->delivery_status = $request->status;
                $orderDetail->save();
            }
        }

        $order->delivery_status = $request->status;
        $order->delivery_viewed = '0';
        $order->save();
        // if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_delivery_status')->first()->value){
        //     try {
        //         $otpController = new OTPVerificationController;
        //         $otpController->send_delivery_status($order);
        //     } catch (\Exception $e) {
        //     }
        // }
        return 1;
    }

    public function update_payment_status(Request $request){



        $order = Order::findOrFail($request->order_id);
        $oid_cancel = $order->orderDetails->first();
        if($oid_cancel->delivery_status=='cancel'){
            return 4;
        }
        $order->payment_status_viewed = '0';
        $order->save();

        if(Auth::user()->user_type == 'customer'){
            $OrderDetail = OrderDetail::where('order_id',$order->id)->first();
            // print_r(json_encode($order));
            if($OrderDetail->delivery_status!="cancel" || $OrderDetail->delivery_status=='pending' || $OrderDetail->delivery_status=='on_review'){
                $user = \App\Users::where('id','=',$order->user_id)->first();
                if($order->payment_type!="cash_on_delivery"){
                    if($order->payment_type=='wallet' || $request->status=='wallet'){
                        // grand_total



                        if ($order->cashback_coupon==1) {
                            $CashbackCronjob = \App\CashbackCronjob::where('user_id', $order->user_id)->where('order_id',$order->id)->first();
                            $amt = json_decode($CashbackCronjob->json)->coupon_discount;
                            $t_amt = $order->grand_total-$amt;
                        }else{
                            $t_amt = $order->grand_total;
                        }
                        $user->balance = $user->balance + $t_amt;
                        $user->save();

                        $wallet = new Wallet;
                        $wallet->user_id = $order->user_id;
                        $wallet->amount = $t_amt;
                        $wallet->payment_method = "Refund order cancel";
                        $wallet->payment_details = "Order cancel refund in wallet";
                        $wallet->add_status = 1;
                        $wallet->save();

                        $u = Users::where('id',$order->user_id)->first();
                        $message = "";
                        $message .= "<p>Dear ".$u->name."</p>";
                        $message .= "<p>Your wallet have successfully credit ".((int)$user->balance + (int)$t_amt)." Login your account and check details</p>";

                        $data = ['message' => $message,'subject'=>'order cancel refund to bank'];
                        Mail::to($u->email)->send(new TestEmail($data));

                    }else{
                        if($request->status=='bank_transfer'){

                            if ($order->cashback_coupon==1) {
                                $CashbackCronjob = \App\CashbackCronjob::where('user_id', $order->user_id)->where('order_id',$order->id)->first();
                                $amt = json_decode($CashbackCronjob->json)->coupon_discount;
                                $t_amt = $order->grand_total-$amt;
                            }else{
                                $t_amt = $order->grand_total;
                            }
                            $bank_detail = array(
                                'bank_name' => json_decode($request->details)[0],
                                'bank_ifsc' => json_decode($request->details)[1],
                                'bank_account_number' => json_decode($request->details)[2]
                            );

                            $OrderCancelDetails = new OrderCancelDetails;
                            $OrderCancelDetails->user_id = $user->id;
                            $OrderCancelDetails->order_id = $request->order_id;
                            $OrderCancelDetails->type = $request->type;
                            $OrderCancelDetails->amount = $t_amt;
                            $OrderCancelDetails->details = json_encode($bank_detail);
                            $OrderCancelDetails->save();


                        }
                    }
                }

                $OrderDetail_all = OrderDetail::where('order_id',$order->id)->get();
                foreach($OrderDetail_all as $OrderDetail_all_update){
                    $OrderDetail_all_update->delivery_status = 'cancel';
                    $OrderDetail_all_update->save();

                }
                return 1;
            }else{
                return 2;
            }



        }



        if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'seller'){

            foreach($order->orderDetails->where('seller_id', Auth::user()->id) as $key => $orderDetail){
                $orderDetail->payment_status = $request->status;
                $orderDetail->save();
            }
        }
        else{
            foreach($order->orderDetails->where('seller_id', User::where('user_type', 'admin')->first()->id) as $key => $orderDetail){
                $orderDetail->payment_status = $request->status;
                $orderDetail->save();
            }
        }

        $status = 'paid';
        foreach($order->orderDetails as $key => $orderDetail){
            if($orderDetail->payment_status != 'paid'){
                $status = 'unpaid';
            }
        }
        $order->payment_status = $status;
        $order->save();

    //     if($order->payment_status == 'paid' && $order->commission_calculated == 0){
    //         if ($order->payment_type == 'cash_on_delivery') {
    //             if (BusinessSetting::where('type', 'category_wise_commission')->first()->value != 1) {
    //                 $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
    //                 foreach ($order->orderDetails as $key => $orderDetail) {
    //                     $orderDetail->payment_status = 'paid';
    //                     $orderDetail->save();
    //                     if($orderDetail->product->user->user_type == 'seller'){
    //                         $seller = $orderDetail->product->user->seller;
    //                         $seller->admin_to_pay = $seller->admin_to_pay - ($orderDetail->price*$commission_percentage)/100;
    //                         $seller->save();
    //                     }
    //                 }
    //             }
    //             else{
    //                 foreach ($order->orderDetails as $key => $orderDetail) {
    //                     $orderDetail->payment_status = 'paid';
    //                     $orderDetail->save();
    //                     if($orderDetail->product->user->user_type == 'seller'){
    //                         $commission_percentage = $orderDetail->product->category->commision_rate;
    //                         $seller = $orderDetail->product->user->seller;
    //                         $seller->admin_to_pay = $seller->admin_to_pay - ($orderDetail->price*$commission_percentage)/100;
    //                         $seller->save();
    //                     }
    //                 }
    //             }
    //         }
    //         elseif($order->manual_payment) {
    //             if (BusinessSetting::where('type', 'category_wise_commission')->first()->value != 1) {
    //                 $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
    //                 foreach ($order->orderDetails as $key => $orderDetail) {
    //                     $orderDetail->payment_status = 'paid';
    //                     $orderDetail->save();
    //                     if($orderDetail->product->user->user_type == 'seller'){
    //                         $seller = $orderDetail->product->user->seller;
    //                         $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price*(100-$commission_percentage))/100;
    //                         $seller->save();
    //                     }
    //                 }
    //             }
    //             else{
    //                 foreach ($order->orderDetails as $key => $orderDetail) {
    //                     $orderDetail->payment_status = 'paid';
    //                     $orderDetail->save();
    //                     if($orderDetail->product->user->user_type == 'seller'){
    //                         $commission_percentage = $orderDetail->product->category->commision_rate;
    //                         $seller = $orderDetail->product->user->seller;
    //                         $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price*(100-$commission_percentage))/100;
    //                         $seller->save();
    //                     }
    //                 }
    //             }
    //         }

    //         if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
    //             $affiliateController = new AffiliateController;
    //             $affiliateController->processAffiliatePoints($order);
    //         }

    //         if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated) {
    //             $clubpointController = new ClubPointController;
    //             $clubpointController->processClubPoints($order);
    //         }

    //         $order->commission_calculated = 1;
    //         $order->save();
    //     }

    //     if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_paid_status')->first()->value){
    //         try {
    //             $otpController = new OTPVerificationController;
    //             $otpController->send_payment_status($order);
    //         } catch (\Exception $e) {
    //         }
    //     }
        return 1;
    }
}

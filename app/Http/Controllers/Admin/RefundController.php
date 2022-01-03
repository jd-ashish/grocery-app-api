<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RefundOrder;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function order_cancel_refund(){
        $refund = RefundOrder::orderBy('id','desc')->get();
        return view("admin.refund.order_cancel_refund",compact('refund'));
    }
    public function order_refund_payment_details(Request $request){
        $refund = RefundOrder::where('id',$request->id)->first();
        return view("admin.parts.refund-data",compact('refund'));
    }
    public function normal_refund(Request $request){
        // return $request;
        $refund = RefundOrder::where('id',$request->redund_id)->first();
        $refund->payment_json = rzp_norman_refund($request->pay_id,($request->amount/100));
        $refund->status = 1;
        $refund->save();
        return back()->with("success","Refund processed");
    }
    public function cashfree_refund(Request $request){
        // return $request;
        // return  cashFree_refund_order($request->order_id,$request->refund_amount,$request->refund_id,$request->refund_note);;
        $refund = RefundOrder::where('id',$request->id)->first();
        $refund->payment_json = cashFree_refund_order($request->order_id,$request->refund_amount,$request->refund_id,$request->refund_note);
        $refund->status = 1;
        $refund->save();
        return back()->with("success","Refund processed");
    }
}

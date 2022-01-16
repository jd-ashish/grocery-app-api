<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationCollection;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function get_api_notification(){
        $notification = Notification::where('user_id',Auth::user()->id)->orderBy("id","desc")->get();
        return new NotificationCollection($notification);
    }
    public function viewed(Request $request){
        $notification = Notification::where('id',$request->id)->first();
        $notification->viewed = 1;
        $notification->save();
    }
}

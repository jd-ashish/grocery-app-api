<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingsCollection;
use App\Models\GeneralSetting;
use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function get(){
        // return Setting::get();
        return new SettingsCollection( GeneralSetting::all() );
    }
}

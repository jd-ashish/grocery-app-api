<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Currency;
use App\Setting;

class SettingsCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                $setting = array();
                $setting['name'] = $data->name;
                $setting['logo'] = $data->logo;
                $setting['facebook'] = $data->facebook;
                $setting['twitter'] = $data->twitter;
                $setting['instagram'] = $data->instagram;
                $setting['youtube'] = $data->youtube;
                $setting['google_plus'] = $data->google_plus;



                foreach(Setting::all() as  $key => $item){
                    if($item->key_name == "rzp_details"){
                        $rzp_details = array();
                        foreach(json_decode($item->value) as $key => $item){
                            $rzp_details[$key] = $item;
                        }
                        $setting["rzp_details"] = ($rzp_details);
                    }else if($item->key_name == "cashfree_details"){
                        $rzp_details = array();
                        foreach(json_decode($item->value) as $key => $item){
                            $rzp_details[$key] = $item;
                        }
                        $setting["cashfree_details"] = ($rzp_details);
                    }else{
                        $setting[$item->key_name] = $item->value;
                    }

                }
                $setting['currency'] = [
                    'name' => Currency::findOrFail(setting("system_default_currency"))->name,
                    'symbol' => Currency::findOrFail(setting("system_default_currency"))->symbol,
                    'exchange_rate' => (double) $this->exchangeRate(Currency::findOrFail(setting("system_default_currency"))),
                    'code' => Currency::findOrFail(setting("system_default_currency"))->code
                ];

                return $setting;
                // return [
                //     'name' => $data->name,
                //     'logo' => $data->logo,
                //     'facebook' => $data->facebook,
                //     'twitter' => $data->twitter,
                //     'instagram' => $data->instagram,
                //     'youtube' => $data->youtube,
                //     'google_plus' => $data->google_plus,
                //     // 'currency' => [
                //     //     'name' => Currency::findOrFail(BusinessSetting::where('type', 'system_default_currency')->first()->value)->name,
                //     //     'symbol' => Currency::findOrFail(BusinessSetting::where('type', 'system_default_currency')->first()->value)->symbol,
                //     //     'exchange_rate' => (double) $this->exchangeRate(Currency::findOrFail(BusinessSetting::where('type', 'system_default_currency')->first()->value)),
                //     //     'code' => Currency::findOrFail(BusinessSetting::where('type', 'system_default_currency')->first()->value)->code
                //     // ],
                //     // 'currency_format' => $data->currency_format
                // ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }

    public function exchangeRate($currency){
        $base_currency = Currency::find(setting("system_default_currency"));
        return $currency->exchange_rate/$base_currency->exchange_rate;
    }
}

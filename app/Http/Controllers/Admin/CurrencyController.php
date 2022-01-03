<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{

    public function changeCurrency(Request $request)
    {
    	$request->session()->put('currency_code', $request->currency_code);
        $currency = Currency::where('code', $request->currency_code)->first();
    	// flash(__('Currency changed to ').$currency->name)->success();
    }

    public function Currency(Request $request)
    {
        $currencies = Currency::orderBy("name")->get();
        $active_currencies = Currency::where('status', 1)->get();

        return view('admin.settings.currency.index', compact('currencies', 'active_currencies'));
    }

    // public function updateCurrency(Request $request)
    // {
    //     $currency = Currency::findOrFail($request->id);
    //     $currency->exchange_rate = $request->exchange_rate;
    //     $currency->status = $request->status;
    //     if($currency->save()){
    //         flash('Currency updated successfully')->success();
    //         return '1';
    //     }
    //     flash('Something went wrong')->error();
    //     return '0';
    // }

    public function updateYourCurrency(Request $request)
    {
        $currency = Currency::findOrFail($request->id);
        $currency->name = $request->name;
        $currency->symbol = $request->symbol;
        $currency->code = $request->code;
        $currency->exchange_rate = $request->exchange_rate;
        $currency->status = $currency->status;
        if($currency->save()){
            // flash('Currency updated successfully')->success();
            return redirect()->route('currency.index');
        }
        else {
            // flash('Something went wrong')->error();
            return redirect()->route('currency.index');
        }
    }

    public function create()
    {
        return view('admin.settings.currency.currency_create');
    }

    public function edit(Request $request)
    {
        $currency = Currency::findOrFail($request->id);
        return view('admin.settings.currency.currency_edit', compact('currency'));
    }

    public function store(Request $request)
    {
        $currency = new Currency;
        $currency->name = $request->name;
        $currency->symbol = $request->symbol;
        $currency->code = $request->code;
        $currency->exchange_rate = $request->exchange_rate;
        $currency->status = '0';
        if($currency->save()){
            flash('Currency updated successfully')->success();
            return redirect()->route('currency.index');
        }
        else {
            flash('Something went wrong')->error();
            return redirect()->route('currency.index');
        }
    }

    public function update_status(Request $request)
    {
        $currency = Currency::findOrFail($request->id);
        $currency->status = $request->status;
        if($currency->save()){
            return 1;
        }
        return 0;
    }
}

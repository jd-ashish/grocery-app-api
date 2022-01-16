<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfferExclusive;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    public function index(){
        $offer_exclusive = OfferExclusive::orderBy('id','desc')->get();
        return view('admin.offer.index',compact('offer_exclusive'));
    }
    public function create(){
        if(Auth::user()->user_type=="admin"){
            $product = Product::where('published',1)->get();
        }else{
            $product = Product::where('published',1)->where('user_id',Auth::user()->id)->get();
        }

        return view('admin.offer.create',compact('product'));
    }
    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|max:255',
            'image' => 'required',
            'select_products' => 'required',
        ]);
        // return $request;
        $offer_exclusive = new OfferExclusive();
        $offer_exclusive->user_id = Auth::user()->id;
        $offer_exclusive->title = $request->title;
        $offer_exclusive->image = $request->image;
        $offer_exclusive->products = json_encode($request->select_products);
        $offer_exclusive->save();
        return back()->with("success","Offer set successfully");
    }
    public function status(Request $request){
        // return $request;
        $offer_exclusive = OfferExclusive::findOrFail($request->id);
        $offer_exclusive->status = ($request->status=="true")? 1:0;
        $offer_exclusive->save();
        return [
            "status" => "success",
            "message" => "data saved!"
        ];
        return "data saved!";
    }
    public function delete($id){
        OfferExclusive::destroy(decrypt($id));
        return back()->with("success","Offer Exclusive delete successfully");
    }
    public function edit($id){
        if(Auth::user()->user_type=="admin"){
            $product = Product::where('published',1)->get();
        }else{
            $product = Product::where('published',1)->where('user_id',Auth::user()->id)->get();
        }
        $offer_exclusive = OfferExclusive::findOrFail(decrypt($id));

        return view('admin.offer.create',compact('offer_exclusive','product'));
    }
    public function update(Request $request,$id){
        $offer_exclusive = OfferExclusive::findOrFail(decrypt($id));
        $offer_exclusive->user_id = Auth::user()->id;
        $offer_exclusive->title = $request->title;
        $offer_exclusive->image = $request->image;
        $offer_exclusive->products = json_encode($request->select_products);
        $offer_exclusive->save();
        return back()->with("success","Offer update successfully");
    }
}

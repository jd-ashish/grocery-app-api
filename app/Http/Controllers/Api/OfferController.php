<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferCollection;
use App\Http\Resources\ProductCollection;
use App\Models\OfferExclusive;
use App\Models\Product;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function get(){
        return new OfferCollection(OfferExclusive::where('status',1)->get());
    }
    public function getById($id){

        $product = array();
        $oe = OfferExclusive::where('id',$id)->first();
                foreach(json_decode($oe->products) as $item){
                    $product[] = (Product::where('published',1)->where('id',$item)->first());
                }
                return new ProductCollection($product);

    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartCollection;
use App\Models\Carts;
use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//return Auth::user();
        // $crt =  Carts::where('user_id', Auth::user()->id)->latest()->get();
        return new CartCollection(Carts::where('user_id', Auth::user()->id)->latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product = Product::findOrFail($request->product_id);
        if ($request->product_stock_id=="0" || $request->product_stock_id==null)
            $price = $product->unit_price;
        else {
            $product_stock = ProductStock::findOrFail($request->product_stock_id);
            $price = $product_stock->price;
        }

$qty = '1';
if($request->qty){
$qty = $request->qty;
}

        Carts::updateOrCreate([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'product_stock_id' => $request->product_stock_id
        ], [
            'price' => $price,
            'plateform' => $request->plateform,
            'status' => 1,
            'qty' => DB::raw('qty + '.$qty)
        ]);
        return response()->json([
            "error" => false , "message" => "Cart added successfully"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function changeQuantity(Request $request)
    {
        $cart = Carts::findOrFail($request->id);
        $cart->update([
            'qty' => $request->qty
        ]);
        return response()->json(['error' => false,'message' => 'Cart updated'], 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Carts::destroy($id);
        return response()->json(['message' => 'Product is successfully removed from your cart',"error" => false], 200);
    }
}

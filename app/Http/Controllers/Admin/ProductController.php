<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use Auth;

class ProductController extends Controller
{
    public function index(){

        $product = Product::orderBy('id','desc')->get();
        return view('admin.products.product.index',compact("product"));
    }
    public function create(){
        $category = Category::orderBy('id','desc')->get();
        return view('admin.products.product.create',compact('category'));
    }
    public function store(Request $request){


        // return array($request->image);
        // return $request;
        $product = array();
        $choice_options = array();
        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $str = 'choice_options_'.$no;

                $item['attribute_id'] = $no;
                $item['values'] = explode(',', implode('|', $request[$str]));

                array_push($choice_options, $item);
            }
        }
        if (!empty($request->choice_no)) {
            $product = json_encode($request->choice_no);
        }
        else {
            $product = json_encode(array());
        }
        // return $request->choice_no;

        $product = new Product();
        $product->name = $request->product_name;
        $product->added_by = Auth::user()->user_type;
        $product->user_id = Auth::user()->id;
        $product->category_id = $request->select_category;
        $product->photos = $request->image_gallery;
        $product->thumbnail_img = $request->image;
        $product->tags = $request->tags;
        $product->description = $request->product_details;
        $product->nutritions = $request->Nutritions;
        $product->caution = $request->Caution;
        $product->unit = $request->unit;
        $product->unit_price = $request->unit_price;
        $product->current_stock = $request->current_stock;
        if($request->has("purchase_price")){
            $product->purchase_price = $request->purchase_price;
        }else{
            $product->purchase_price = "";
        }

        $product->discount = $request->discount;

        if($request->choice_attributes!=null){
            $product->variant_product = count($request->choice_attributes);
        }else{
            $product->variant_product = "";
        }
        if (!empty($request->choice_no)) {
            $product->attributes = json_encode($request->choice_no);
        }
        else {
            $product->attributes = json_encode(array());
        }
        $product->choice_options = json_encode($choice_options);
        $product->published = 1;
        $product->discount_type = $request->discount_type;
        $product->slug = seo_($request->product_name);
        $product->refundable = 0;
        $product->rating = 0;
        if($request->product_code){
            $product->product_code = $request->product_code;
        }else{
            $product->product_code = "";
        }

        // $ProductStock = new ProductStock();
        // $ProductStock->product_id = 1;
        // $ProductStock->variant = 1;
        // $ProductStock->sku = 1;
        // $ProductStock->price = 1;
        // $ProductStock->qty = 1;

        // return $product;
        $product->save();;

        //combinations start
        $options = array();

        // Color option will avowable soon
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
        }

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                $my_str = implode('|',$request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }

        //Generates the combinations of customer choice options
        // return $options;
        $combinations = combinations($options);
        if(count($combinations[0]) > 0){
            $product->variant_product = 1;
            foreach ($combinations as $key => $combination){
                $str = '';
                foreach ($combination as $key => $item){
                    if($key > 0 ){
                        $str .= '-'.str_replace(' ', '', $item);
                    }
                    else{
                        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
                            $color_name = \App\Color::where('code', $item)->first()->name;
                            $str .= $color_name;
                        }
                        else{
                            $str .= str_replace(' ', '', $item);
                        }
                    }
                }
                // $item = array();
                // $item['price'] = $request['price_'.str_replace('.', '_', $str)];
                // $item['sku'] = $request['sku_'.str_replace('.', '_', $str)];
                // $item['qty'] = $request['qty_'.str_replace('.', '_', $str)];
                // $variations[$str] = $item;

                $product_stock = ProductStock::where('product_id', $product->id)->where('variant', $str)->first();
                if($product_stock == null){
                    $product_stock = new ProductStock;
                    $product_stock->product_id = $product->id;
                }
                $product_stock->product_id = $product->id;
                $product_stock->variant = $str;
                $product_stock->price = $request['price_'.str_replace('.', '_', $str)];
                $product_stock->sku = $request['sku_'.str_replace('.', '_', $str)];
                $product_stock->qty = $request['qty_'.str_replace('.', '_', $str)];
                $product_stock->save();
            }
        }

        // combinations end


	    $product->save();;
        return redirect(route('product.index'))->with("success","Product create successfully");

    }
    public function sku_combination(Request $request)
    {

        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
        }
        else {
            $colors_active = 0;
        }

        $unit_price = $request->unit_price;
        $product_name = $request->product_name;

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                $my_str = implode('', $request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }

        $combinations = combinations($options);
        return view('admin.content.products.product.sku_combinations', compact('combinations', 'unit_price', 'colors_active', 'product_name'));
    }
    public function sku_combination_edit(Request $request)
    {
        $product = Product::findOrFail($request->id);

        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
        }
        else {
            $colors_active = 0;
        }

        $product_name = $request->name;
        $unit_price = $request->unit_price;

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                $my_str = implode('|', $request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }

        $combinations = combinations($options);
        return view('admin.content.products.product.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));
    }
    public function edit(Request $request,$id){
        $product = Product::findOrFail(decrypt($id));
        //dd(json_decode($product->price_variations)->choices_0_S_price);
        $tags = json_decode($product->tags);
        $category = Category::all();
        return view('admin.products.product.edit', compact('product', 'category', 'tags'));
    }
    public function update(Request $request,$id){

        // return $request;
        $product = Product::findOrFail($id);
        if($request->product_code){
            $product->product_code = $request->product_code;
        }else{
            $product->product_code = "";
        }
        $product->name = $request->product_name;
        $product->category_id = $request->select_category;
        $product->current_stock = $request->current_stock;
        $product->photos = $request->image_gallery;
        $product->thumbnail_img = $request->image;
        $product->unit = $request->unit;
        $product->tags = $request->tags;
        $product->description = $request->product_details;
        $product->nutritions = $request->Nutritions;
        $product->caution = $request->Caution;
        $product->unit_price = $request->unit_price;
        $product->purchase_price = $request->purchase_price;
        $product->discount = $request->discount;
        $product->discount_type = $request->discount_type;
        $product->slug = seo_($request->product_name);



        $choice_options = array();
        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $str = 'choice_options_'.$no;

                $item['attribute_id'] = $no;
                $item['values'] = explode(',', implode('|', $request[$str]));

                array_push($choice_options, $item);
            }
        }

        if($product->attributes != json_encode($request->choice_attributes) || $product->colors != json_encode($request->colors_active)){
            foreach ($product->stocks as $key => $stock) {
                $stock->delete();
            }
        }

        if (!empty($request->choice_no)) {
            $product->attributes = json_encode($request->choice_no);
        }
        else {
            $product->attributes = json_encode(array());
        }

        $product->choice_options = json_encode($choice_options);

        //combinations start
        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
        }

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                $my_str = implode('|',$request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }

        $combinations = combinations($options);
        if(count($combinations[0]) > 0){
            $product->variant_product = 1;
            foreach ($combinations as $key => $combination){
                $str = '';
                foreach ($combination as $key => $item){
                    if($key > 0 ){
                        $str .= '-'.str_replace(' ', '', $item);
                    }
                    else{
                        //Comming soon
                        // if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
                        //     $color_name = \App\Color::where('code', $item)->first()->name;
                        //     $str .= $color_name;
                        // }
                        // else{
                        //     $str .= str_replace(' ', '', $item);
                        // }
                        $str .= str_replace(' ', '', $item);
                    }
                }

                $product_stock = ProductStock::where('product_id', $product->id)->where('variant', $str)->first();
                if($product_stock == null){
                    $product_stock = new ProductStock;
                    $product_stock->product_id = $product->id;
                }

                $product_stock->variant = $str;
                $product_stock->price = $request['price_'.str_replace('.', '_', $str)];
                $product_stock->sku = $request['sku_'.str_replace('.', '_', $str)];
                $product_stock->qty = $request['qty_'.str_replace('.', '_', $str)];
                $product_stock->save();
            }
        }

        $product->save();
        return redirect(route('product.index'))->with("success","Update successfully");

    }
    public function duplicate($id)
    {
        $product = Product::find(decrypt($id));
        $product_new = $product->replicate();
        $product_new->slug = seo_($product_new->slug);
        if($product_new->save()){
            return redirect(route('product.index'))->with("success","Product has been duplicated successfully");
        }
        else{
            return back()->with("error","Something went wrong");
        }
    }

    public function execlusive_offer(Request $request){
        $product = Product::find($request->id);
        $product->exclusive_offer = ($request->status=="true")? 1:0;
        $product->save();
        return "Exclusives offer successfully live";
    }
}

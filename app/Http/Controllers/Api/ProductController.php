<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductDetailCollection;
use App\Http\Resources\SearchProductCollection;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function admin()
    {
        return new ProductCollection(Product::where('added_by', 'admin')->latest()->paginate(10));
    }
    public function category($id)
    {
        return new ProductCollection(Product::where('category_id', $id)->latest()->paginate(10));
    }
    public function bestSelling()
    {
        return new ProductCollection(Product::orderBy('num_of_sale', 'desc')->limit(20)->get());
    }
    public function show($id)
    {
        // return Product::where('id', $id)->get();
        return new ProductDetailCollection(Product::where('id', $id)->get());
    }
    public function filter($id,$price,$date)
    {
        $product = Product::where('published', "1")->where('category_id', $id);
        if($price=="desc"){
            $product->orderBy("unit_price",$price);
        }
        if($price=="asc"){
            $product->orderBy("unit_price",$price);
        }
        if($price=="desc" && $date=="desc"){
            $product->orderBy("unit_price",$price)->orderBy("created_at", $date);
        }
        if($price=="asc" && $date=="asc"){
            $product->orderBy("unit_price",$price)->orderBy("created_at", $date);
        }
        if($date=="desc"){
            $product->orderBy("created_at",$date);
        }
        if($date=="asc"){
            $product->orderBy("created_at",$date);
        }
        if($price=="popularity"){
	    $key = $date;
            $collection = new ProductCollection(Product::where('name', 'like', "%{$key}%")->where('category_id',"=", 6)->where('tags', 'like', "%{$key}%")->orderBy('num_of_sale', 'desc')->paginate(10));
            $collection->appends(['key' =>  $key, 'scope' => $price]);
            return $collection;
        }

        return new ProductCollection($product->paginate(10));
    }
    public function search()
    {
        $key = request('key');
        $scope = request('scope');



        switch ($scope) {

            case 'price_low_to_high':
                $collection = new ProductCollection(Product::where('name', 'like', "%{$key}%")->orWhere('tags', 'like', "%{$key}%")->orderBy('unit_price', 'asc')->paginate(10));
                $collection->appends(['key' =>  $key, 'scope' => $scope]);
                return $collection;

            case 'price_high_to_low':
                $collection = new ProductCollection(Product::where('name', 'like', "%{$key}%")->orWhere('tags', 'like', "%{$key}%")->orderBy('unit_price', 'desc')->paginate(10));
                $collection->appends(['key' =>  $key, 'scope' => $scope]);
                return $collection;

            case 'new_arrival':
                $collection = new ProductCollection(Product::where('name', 'like', "%{$key}%")->orWhere('tags', 'like', "%{$key}%")->orderBy('created_at', 'desc')->paginate(10));
                $collection->appends(['key' =>  $key, 'scope' => $scope]);
                return $collection;

            case 'popularity':
		if($key=="" || $key==null){
			$collection = new ProductCollection(Product::orderBy('num_of_sale', 'desc')->paginate(10));
                	$collection->appends(['key' =>  $key, 'scope' => $scope]);
                	return $collection;
		}
                $collection = new ProductCollection(Product::where('name', 'like', "%{$key}%")->orWhere('tags', 'like', "%{$key}%")->orderBy('num_of_sale', 'desc')->paginate(10));
                $collection->appends(['key' =>  $key, 'scope' => $scope]);
                return $collection;

            case 'top_rated':
                $collection = new ProductCollection(Product::where('name', 'like', "%{$key}%")->orWhere('tags', 'like', "%{$key}%")->orderBy('rating', 'desc')->paginate(10));
                $collection->appends(['key' =>  $key, 'scope' => $scope]);
                return $collection;

            // case 'category':
            //
            //     $categories = Category::select('id')->where('name', 'like', "%{$key}%")->get()->toArray();
            //     $collection = new SearchProductCollection(Product::where('category_id', $categories)->orderBy('num_of_sale', 'desc')->paginate(10));
            //     $collection->appends(['key' =>  $key, 'scope' => $scope]);
            //     return $collection;
            //
            // case 'brand':
            //
            //     $brands = Brand::select('id')->where('name', 'like', "%{$key}%")->get()->toArray();
            //     $collection = new SearchProductCollection(Product::where('brand_id', $brands)->orderBy('num_of_sale', 'desc')->paginate(10));
            //     $collection->appends(['key' =>  $key, 'scope' => $scope]);
            //     return $collection;
            //
            // case 'shop':
            //
            //     $shops = Shop::select('user_id')->where('name', 'like', "%{$key}%")->get()->toArray();
            //     $collection = new SearchProductCollection(Product::where('user_id', $shops)->orderBy('num_of_sale', 'desc')->paginate(10));
            //     $collection->appends(['key' =>  $key, 'scope' => $scope]);
            //     return $collection;

            default:
                $collection = new SearchProductCollection(Product::where('name', 'like', "%{$key}%")->orWhere('tags', 'like', "%{$key}%")->orderBy('num_of_sale', 'desc')->paginate(10));
                $collection->appends(['key' =>  $key, 'scope' => $scope]);
                return $collection;
        }
    }
    public function variantPrice(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $str = '';
        $tax = 0;
$variant_id = '';

        if ($request->has('color')) {
            $data['color'] = $request['color'];
            $str = Color::where('code', $request['color'])->first()->name;
        }

        foreach (json_decode($request->choice) as $option) {
            $str .= $str != '' ?  '-'.str_replace(' ', '', $option->name) : str_replace(' ', '', $option->name);
        }

        if($str != null && $product->variant_product){
            $product_stock = $product->stocks->where('variant', $str)->first();
            $price = ($product_stock!=null) ? $product_stock->price:"";
            $stockQuantity = $product_stock->qty;
            $variant_id = $product_stock->id;
        }
        else{
            $price = $product->unit_price;
            $stockQuantity = $product->current_stock;
        }


        if ($product->tax_type == 'percent') {
            $price += ($price*$product->tax) / 100;
        }
        elseif ($product->tax_type == 'amount') {
            $price += $product->tax;
        }

        return response()->json([
            'product_id' => $product->id,
            'variant' => $str,
            'variant_id' => $variant_id,
            'price' => (double) $price,
            'in_stock' => $stockQuantity < 1 ? false : true
        ]);
    }
    public function execlusive_offer(Request $request){
        return new ProductCollection(Product::orderBy('id', 'desc')->where('exclusive_offer',1)->limit(setting('max_execlusive'))->get());
    }
}

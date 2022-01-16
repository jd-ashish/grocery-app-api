<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\OfferExclusive;
use App\Models\Order;
use App\Models\RefundOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messageBird = new \MessageBird\Client('mFbdjOR8FSoTS5P9XPQiyDg3v');
        $balance = json_encode($messageBird->balance->read());
//         // return $balance;

//   $Message = new \MessageBird\Objects\Message();
//   $Message->originator = 'TestMessage';
//   $Message->recipients = array(+917079692988);
//   $Message->body = 'This is a test message';

//   return json_encode($messageBird->messages->create($Message));

//         print_r(json_decode($balance));
//         return "sdhgjgcjhf ". gettype($balance);

        $user = User::all();
        $order = Order::all();
        $OfferExclusive = OfferExclusive::all();
        $Category = Category::all();
        $RefundOrder = RefundOrder::all();
        return view('admin.index',compact('user','order','OfferExclusive','Category','RefundOrder'));
    }

    public function yearWise(){
        $created_at = OrderDetail::select(
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as year"),
            DB::raw('max(created_at) as createdAt')
        )
            ->where("created_at", ">", Carbon::now()->subYear(6))
            ->orderBy('createdAt', 'desc')
            ->groupBy('year')
            ->get();


            //    return $arr_month;
            $arr = array();
            for($i=0; $i<count($created_at); $i++){

                $results = array();
                preg_match('/[0-9]{4}/', $created_at[$i]->year, $results);

                $months = OrderDetail::select(
                    DB::raw('order_id as `oid`'),
                    DB::raw('sum(price) as `sums`'),
                    DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"),
                    DB::raw('max(created_at) as createdAt')
             )
                   ->where("created_at", ">", \Carbon\Carbon::now()->subMonths(6))
                   ->whereYear('created_at', $results[0])
                   ->orderBy('createdAt', 'desc')
                   ->groupBy('months')
                   ->get();

                   $arr_month = array();
                   for($j=0; $j<count($months); $j++){
                       $arr_month[$j] = $months[$j]->sums;
                   }

                $arr[$i]['label'] = $results[0];
                $arr[$i]['data'] =  array_merge($arr_month,[$i+99,$i+89]);
                $arr[$i]['borderColor'] = [
                    'transparent'
                  ];
                $arr[$i]['borderWidth'] = 2;
                $arr[$i]['fill'] = true;
                if($i==0){
                    $arr[$i]['backgroundColor'] = "rgba(47,91,191,0.77)";
                }else if($i==0){
                    $arr[$i]['backgroundColor'] = "rgba(77,131,255,0.77)";
                }else{
                    $arr[$i]['backgroundColor'] = "rgba(77,131,255,0.43)";
                }
            }

            return $arr;
    }


    public function search(Request $request)
    {

        // return $request;
        $query = $request->q;
        $user_id = (User::where('name', 'like', '%'.$request->name.'%')->orWhere('email','like', '%'.$request->name.'%')->orWhere('phone','like', '%'.$request->name.'%')->first() != null) ?
        User::where('name', 'like', '%'.$request->name.'%')->orWhere('email','like', '%'.$request->name.'%')->orWhere('phone','like', '%'.$request->name.'%')->first()->id : null;

        // return Product::where('name', 'Like', '%'.$request->name.'%')->first();

        $product_id = (Product::where('name', 'like', '%'.$request->name.'%')->orWhere('tags', 'like', '%'.$request->name.'%')->orWhere('slug', 'like', '%'.$request->name.'%')->first() != null) ?
        Product::where('name', 'like', '%'.$request->name.'%')->orWhere('tags', 'like', '%'.$request->name.'%')->orWhere('slug', 'like', '%'.$request->name.'%')->first()->id : null;

        $order_id = (Order::where('delivery_status', 'like', '%'.$request->name.'%')->orWhere('code', 'like', '%'.$request->name.'%')->orWhere('payment_type', 'like', '%'.$request->name.'%')->orWhere('payment_details', 'like', '%'.$request->name.'%')->first() != null) ?
        Order::where('delivery_status', 'like', '%'.$request->name.'%')->orWhere('code', 'like', '%'.$request->name.'%')->orWhere('payment_type', 'like', '%'.$request->name.'%')->orWhere('payment_details', 'like', '%'.$request->name.'%')->first()->id : null;


        // $subcategory_id = (SubCategory::where('slug', $request->subcategory)->first() != null) ? SubCategory::where('slug', $request->subcategory)->first()->id : null;
        // $subsubcategory_id = (SubSubCategory::where('slug', $request->subsubcategory)->first() != null) ? SubSubCategory::where('slug', $request->subsubcategory)->first()->id : null;
        // $min_price = $request->min_price;
        // $max_price = $request->max_price;
        // $seller_id = $request->seller_id;

        // $conditions = ['published' => 1];

        if($user_id != null){
            return redirect(route('dashboard.user.details',encrypt($user_id)));
        }
        if($product_id != null){
            return redirect(route('product.product.edit',encrypt($product_id)));
        }
        if($order_id != null){
            return redirect(route('order.details',encrypt($order_id)));
        }

        return "null";
        if($subsubcategory_id != null){
            $conditions = array_merge($conditions, ['subsubcategory_id' => $subsubcategory_id]);
        }
        if($seller_id != null){
            $conditions = array_merge($conditions, ['user_id' => Seller::findOrFail($seller_id)->user->id]);
        }

        $products = Product::where($conditions);

        if($min_price != null && $max_price != null){
            $products = $products->where('unit_price', '>=', $min_price)->where('unit_price', '<=', $max_price);
        }

        if($query != null){
            $searchController = new SearchController;
            $searchController->store($request);
            $products = $products->where('name', 'like', '%'.$query.'%')->orWhere('tags', 'like', '%'.$query.'%');
        }

        if($sort_by != null){
            switch ($sort_by) {
                case '1':
                    $products->orderBy('created_at', 'desc');
                    break;
                case '2':
                    $products->orderBy('created_at', 'asc');
                    break;
                case '3':
                    $products->orderBy('unit_price', 'asc');
                    break;
                case '4':
                    $products->orderBy('unit_price', 'desc');
                    break;
                default:
                    // code...
                    break;
            }
        }





        $products = filter_products($products)->paginate(12)->appends(request()->query());

        return view('frontend.product_listing', compact('products', 'query', 'category_id', 'subcategory_id', 'subsubcategory_id', 'brand_id', 'sort_by', 'seller_id','min_price', 'max_price', 'attributes', 'selected_attributes', 'all_colors', 'selected_color'));
    }

    public function profile(){
        return view('admin.user.profile');
    }

    public function updateProfile(Request $request){
        // return $request;
        $user = User::where("id",$request->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if($request->has("password")){
            if($request->password!=""){
                $user->password = Hash::make($request->password);
            }
        }
        // return $user;
        $user->save();
        $user->getUserDetails->gender = $request->gender;
        $user->getUserDetails->save();

        notification("Profile Update","Profile update successfully","update",Auth::user()->id);
        return back()->with("success","Profile update successfully");
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Models\OrderDetail;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Product;

class PurchaseHistoryCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                $od = OrderDetail::where('order_id', $data->id)->get();
                $ProductCollection = array();
                foreach($od as $item){
                    $ProductCollection[] = new ProductCollection(Product::where('id', $item->product_id)->get());
                }

                return [
                    'code' => $data->code,
                    'user' => [
                        'name' => $data->user->name,
                        'email' => $data->user->email,
                        'phone' => $data->user->phone,
                        'avatar' => $data->user->avatar,
                        'avatar_original' => $data->user->avatar_original
                    ],
                    'orderDetails' => $od,
                    'shipping_address' => $data->order_address,
                    'payment_type' => str_replace('_', ' ', $data->payment_type),
                    'products' => $ProductCollection,
                    'payment_status' => $data->payment_status,
                    'grand_total' => (double) $data->grand_total,
                    'coupon_discount' => (double) $data->coupon_discount,
                    'shipping_cost' => (double) $data->orderDetails->sum('shipping_cost'),
                    'subtotal' => (double) $data->orderDetails->sum('price'),
                    'tax' => (double) $data->orderDetails->sum('tax'),
                    'date' => Carbon::createFromTimestamp($data->date)->format('d-m-Y'),
                    // 'links' => [
                    //     'details' => route('purchaseHistory.details', $data->id)
                    // ]
                ];
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
}

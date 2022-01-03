<?php

namespace App\Http\Resources;

use App\Models\ProductStock;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CartCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' => $data->id,
                    'product' => [
                        'id' => $data->product->id,
                        'name' => $data->product->name,
                        'thumbnail_image' => get_image_by_upload_id($data->product->thumbnail_img),
                        'featured_image' => $data->product->featured_img,
                        'flash_deal_image' => $data->product->flash_deal_img,
                        'base_price' => (double) homeBasePrice($data->product->id),
                        'todays_deal' => (integer) $data->product->todays_deal,
                        'featured' =>(integer) $data->product->featured,
                        'unit' => $data->product->unit,
                        'perUnit' => ProductStock::where('product_id',$data->product->id)->inRandomOrder()->first(),
                        'discount' => (double) $data->product->discount,
                        'discount_type' => $data->product->discount_type,
                        'rating' => (double) $data->product->rating,
                        'sales' => (integer) $data->product->num_of_sale,
                        'description' => $data->product->description,
                        'nutritions' => $data->product->nutritions,
                        'caution' => (integer) $data->product->caution
                    ],
                    'productStock' => [
                        'id' => ($data->productStock!=null)? $data->productStock->id : "",
                        'variation' => ($data->productStock!=null) ? $data->productStock->variant : ""
                    ],
                    'price' => (double) $data->price,
                    'qty' => (integer) $data->qty,
                    'date' => $data->created_at->diffForHumans()
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

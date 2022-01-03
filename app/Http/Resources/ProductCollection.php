<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use \App\Models\ProductStock;

class ProductCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'name' => $data->name,
                    'id' => $data->id,
                    'category_id' => $data->category_id,
                    'photos' => get_all_image_by_upload_id($data->photos),
                    'thumbnail_image' => get_image_by_upload_id($data->thumbnail_img),
                    'featured_image' => $data->featured_img,
                    'flash_deal_image' => $data->flash_deal_img,
                    'base_price' => (double) homeBasePrice($data->id),
                    'todays_deal' => (integer) $data->todays_deal,
                    'featured' =>(integer) $data->featured,
                    'unit' => $data->unit,
                    'perUnit' => ProductStock::where('product_id',$data->id)->inRandomOrder()->first(),
                    'discount' => (double) $data->discount,
                    'discount_type' => $data->discount_type,
                    'rating' => (double) $data->rating,
                    'sales' => (integer) $data->num_of_sale,
                    'description' => $data->description,
                    'nutritions' => $data->nutritions,
                    'caution' => $data->caution
                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'error' => false,
            'status' => 200
        ];
    }
}

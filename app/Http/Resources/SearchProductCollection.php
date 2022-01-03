<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SearchProductCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'thumbnail_image' => $data->thumbnail_img,
                    'base_price' => (double) homeBasePrice($data->id),
                    // 'base_discounted_price' => (double) homeDiscountedBasePrice($data->id),
                    'rating' => (double) $data->rating
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

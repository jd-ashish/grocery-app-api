<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'icon' => get_image_by_upload_id($data->upload_id),
                    // 'brands' => brandsOfCategory($data->id),
                    'links' => [
                        'products' => route('api.products.category', $data->id),
                    ]
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

<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OfferCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                $arr = array();
                $arr['title'] = $data->title;
		$arr['id'] = $data->id;
                $arr['image'] = get_image_by_upload_id($data->image);
                $product = array();
                foreach(json_decode($data->products) as $item){
                    $product[] = new ProductCollection(Product::where('published',1)->where('id',$item)->get());
                }
                $arr['products'] = $product;

                return $arr;
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

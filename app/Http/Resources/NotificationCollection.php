<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NotificationCollection extends ResourceCollection
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
            'data' => $this->collection->map(function($data){
                return [
                    'id' => $data->id,
                    'title' => $data->title,
                    'description' => $data->description,
                    'img' => $data->img,
                    'type' => $data->type,
                    'status' => $data->status,
                    'viewed' => $data->viewed,
                    'created_at' => $data->created_at->diffForHumans(),
                ];
            })
        ];
    }
    public function with($request){
        return [
            'success' => true,
            'status' => 200,
        ];
    }
}

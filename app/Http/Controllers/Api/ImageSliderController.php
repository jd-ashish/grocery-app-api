<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImageSliderCollection;
use App\Models\ImageSlider;
use Illuminate\Http\Request;

class ImageSliderController extends Controller
{
    public function index(){
        $slider = ImageSlider::where('status',1)->orderBy('id','desc')->get();

        return new ImageSliderCollection($slider);
    }
}

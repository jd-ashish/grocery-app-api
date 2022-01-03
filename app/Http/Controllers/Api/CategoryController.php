<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($search)
    {
        if($search==null || $search=='null'){
            return new CategoryCollection(Category::all());

        }else{
            return new CategoryCollection(Category::where('name', 'like', "%{$search}%")->orderBy('id', 'desc')->get());
        }

    }
}

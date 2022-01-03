<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function user_list(){
        $users = User::all();
        return view("admin.user.index",compact('users'));
    }

    public function details($id){

        $user = User::where('id',decrypt($id))->first();
        return view("admin.user.details",compact('user'));
    }
}

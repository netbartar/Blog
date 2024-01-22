<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function userList()
    {
        $users = User::select('id','name','email','created_at')->withCount('posts')->get();
        return view('user.index',compact('users'));
    }


    public function userDelete(string $id)
    {
        User::find($id)->delete();
        return redirect()->back();
    }
}

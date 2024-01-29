<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{


    public function writeContent()
    {
        if(Storage::put('test.txt','test'))
        {

        }
        else{

        }
    }

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

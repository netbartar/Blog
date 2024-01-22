<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function createPost()
    {
        $categories = Category::select('id','title')->get();
        return view('posts.create',compact('categories'));
    }

    public function storePost(CreatePostRequest $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'author_id' => Auth::id()
        ]);
        $post->categories()->attach($request->category_ids);
        return redirect()->route('posts.index');
    }

    public function postList()
    {

        $query = Post::select('id','title','publication_date','publication_status','author_id')
            ->with('author:id,name');
        if(!$this->isAdmin())
        {
            $query = $query->where('author_id',Auth::id());
        }
        $posts = $query->get();
        return view('posts.index',compact('posts'));
    }

    public function isAdmin()
    {
        $result = false;
        if(Auth::user()->role_id == 1)
            $result = true;

        return $result;

    }

    public function postDetails($id)
    {
        $post = Post::find($id);
        return view('posts.show',compact('post'));
    }

    public function postEdit($id)
    {
        $post = Post::find($id);
        return view('posts.edit',compact('post'));
    }

    public function postUpdate(UpdatePostRequest $request, $id)
    {
        $post = Post::find($id);
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('posts.index');
    }
}

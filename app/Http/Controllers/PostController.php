<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Role;
use Carbon\Carbon;
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

        $categories = $request->category_ids;
        if(!$request->category_ids)
            $categories = [$this->findUnCategorize()];

        $post->categories()->attach($categories);
        return redirect()->route('posts.index');
    }

    public function findUnCategorize()
    {
        $unCategorize = Category::where('title', 'un categorize')->first();
        return $unCategorize->id;
    }


    public function postList()
    {
        $adminRoleId = Role::where('title','Admin')->first()->id;
        $userRoleId = Auth::user()->role_id;
        $query = Post::getPost();
        if(!$this->isAdmin())
        {
            $query = $query->where('author_id',Auth::id());
        }
        $posts = $query->get();
        return view('posts.index',compact('posts','adminRoleId','userRoleId'));
    }


    public function postOtherList()
    {
        $query = Post::getPost();
        $posts = $query
            ->where('author_id','!=',Auth::id())
            ->where('publication_status','publish')
            ->get();
        return view('posts.other',compact('posts'));
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
        $post = Post::with('comments')->find($id);
//        if($post->author_id == Auth::id())
            return view('posts.show',compact('post'));
//        return 'forbidden';
    }

    public function postEdit($id)
    {
        $post = Post::with('categories:id,title')->where('id',$id)->first();
        $selected_categories = $post->categories->pluck('id')->toArray();
        $categories = Category::select('id','title')->get();
        return view('posts.edit',compact('post','categories','selected_categories'));
    }

    public function postUpdate(UpdatePostRequest $request, $id)
    {
        $post = Post::with('categories:id,title')->find($id);
        $postCategories = $post->categories->pluck('id')->toArray();
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        if($request->category_ids)
        {
            $requestCategories = $request->category_ids;
            foreach ($postCategories as $key=>$post_category)
            {
                foreach ($requestCategories as $key2=>$category)
                {
                    if(in_array($post_category,$requestCategories))
                    {
                        unset($postCategories[$key]);
                        unset($requestCategories[$key2]);
                    }
                }
            }
            if(count($postCategories))
                $post->categories()->detach($postCategories);

            $post->categories()->attach($requestCategories);
        }
        return redirect()->route('posts.index');
    }


    public function postDelete($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->back();
    }

    public function postPublish($id)
    {


//        $post = Post::find($id);
//        $status = 'publish';
//        $date = Carbon::now();
//        if($post->publication_status == 'publish')
//        {
//            $status = 'draft';
//            $date = null;
//        }
//
//        $post->update([
//            'publication_status' => $status,
//            'publication_date' => $date
//        ]);

        $post = Post::find($id);
        $post->update([
            'publication_status' => 'publish',
            'publication_date' => Carbon::now()
        ]);

        return redirect()->back();

    }
}

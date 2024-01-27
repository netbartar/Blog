<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function commentCreate($id)
    {
        $post = Post::find($id);
        return view('comment.create',compact('post'));
    }

    public function storeComment(StoreCommentRequest $request)
    {
        Comment::create([
            'comment' => $request->comment,
            'post_id' => $request->post_id
        ]);

        return redirect()->route('posts.other');
    }

    public function commentDelete($id)
    {
        Comment::find($id)->delete();
        return redirect()->back();
    }

    public function commentApprove($id)
    {
        $comment = Comment::find($id);
        $comment->status = 'approve';
        $comment->save();

        return redirect()->back();
    }

    public function commentList()
    {
        $comments = Comment::with('post:id,title,author_id','author')
            ->where('status','approve')
            ->get();
        dd($comments);
        return view('comment.index',compact('comments'));
    }
}

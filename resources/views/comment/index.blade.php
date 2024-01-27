@extends('layout.master')

@section('title')
    Posts
@endsection

@section('content')
    <br><br>

    <h2>List of Posts</h2>
    <table class="table">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Comment</th>
            <th>post Title</th>
            <th>Comment Status</th>
            <th>Post Author</th>
        </tr>
        </thead>
        <tbody>
        @if($comments)
            @foreach($comments as $key => $comment)
                <tr>
                    <td class="text-center">{{$key + 1}}</td>
                    <td>{{$comment->comment}}</td>
                    <td>{{$comment->status}}</td>
                    <td>{{$comment->post->title}}</td>
                    <td>{{$comment->post->author->name}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>




@endsection

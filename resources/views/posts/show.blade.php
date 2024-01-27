@extends('layout.master')

@section('title')
    post details

@endsection

@section('content')

    <div class="card card-nav-tabs">
        <div class="card-header card-header-warning">
            publish at {{$post->publication_date}}
        </div>
        <div class="card-body">
            <h4 class="card-title">{{$post->title}}</h4>
            <p class="card-text">{{$post->body}}</p>
            <a href="{{route('posts.create')}}" class="btn btn-primary">Create new post</a>
        </div>
        <br><br>

        <h2>List of Posts</h2>
        <table class="table">
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Comment</th>
                <th>Status</th>
                <th class="text-right">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if($post->comments)
                @foreach($post->comments as $key => $comment)

                    <tr>
                        <td class="text-center">{{$key + 1}}</td>
                        <td>{{$comment->comment}}</td>
                        <td>{{$comment->status}}</td>
                        <td class="td-actions text-right">

                                <form class="d-inline-block" method="POST" action="{{route('comment.delete',$comment->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" rel="tooltip" class="btn btn-danger btn-sm btn-icon">
                                        <i class="now-ui-icons ui-1_simple-remove"></i>
                                    </button>
                                </form>
                                <a href="{{route('comment.approve',$comment->id)}}">
                                    <button type="button" rel="tooltip" class="btn btn-info btn-sm btn-icon">
                                        <i class="now-ui-icons users_single-02"></i>
                                    </button>
                                </a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

@endsection

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
    </div>

@endsection

@extends('layout.master')

@section('title')
    Update Post
@endsection

@section('content')

    <br><br>
    <h2>update {{$post->title}}</h2>

    <form method="POST" action="{{route('posts.update',$post->id)}}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="{{$post->title}}">
            @if($errors->has('title'))
                <span class="text-danger">{{$errors->first('title')}}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea class="form-control" id="body" rows="3" name="body">{{$post->body}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection

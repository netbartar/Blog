@extends('layout.master')

@section('title')
    comment
@endsection

@section('content')

    <br><br>
    <h2>comment for {{$post->title}}</h2>

    <form method="POST" action="{{route('comment.store')}}">
        @csrf
        <input value="{{$post->id}}" type="hidden" name="post_id">
        <div class="form-group">
            <label for="comment">Body</label>
            <textarea class="form-control" id="comment" rows="3" name="comment"></textarea>
            @if($errors->has('comment'))
                <span class="text-danger">{{$errors->first('comment')}}</span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection

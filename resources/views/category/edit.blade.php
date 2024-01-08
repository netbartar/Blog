@extends('layout.master')

@section('title')
    catgories
@endsection

@section('content')
    <br><br>
    <h2>update {{$category->title}}</h2>

    <form method="POST" action="{{route('categories.update',$category->id)}}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$category->title}}">
            @if($errors->has('title'))
                <span class="text-danger">{{$errors->first('title')}}</span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>



@endsection

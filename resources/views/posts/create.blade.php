@extends('layout.master')

@section('title')
    create new post
@endsection

@section('content')

    <br><br>
    <h2>Creat new post</h2>

    <form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
            @if($errors->has('title'))
                <span class="text-danger">{{$errors->first('title')}}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="category">Select Categories</label>
            <select multiple class="form-control" id="category" name="category_ids[]">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea class="form-control" id="body" rows="3" name="body"></textarea>
        </div>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image">
            @if($errors->has('image'))
                <span class="text-danger">{{$errors->first('image')}}</span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection

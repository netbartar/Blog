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
            <th>Title</th>
            <th>Author</th>
            <th>Publication Status</th>
            <th>Publication Date</th>
            <th class="text-right">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($posts)
            @foreach($posts as $key => $post)
                <tr>
                    <td class="text-center">{{$key + 1}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->author->name}}</td>
                    <td>{{$post->publication_status}}</td>
                    <td>{{$post->publication_date}}</td>
                    <td class="td-actions text-right">

{{--                            <form class="d-inline-block" method="POST" action="{{route('posts.delete',$post->id)}}">--}}
{{--                                @csrf--}}
{{--                                @method('DELETE')--}}
{{--                                <button type="submit" rel="tooltip" class="btn btn-danger btn-sm btn-icon">--}}
{{--                                    <i class="now-ui-icons ui-1_simple-remove"></i>--}}
{{--                                </button>--}}
{{--                            </form>--}}

                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>




@endsection

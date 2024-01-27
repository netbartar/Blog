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
                        <a href="{{route('comment.create',$post->id)}}">
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




@endsection

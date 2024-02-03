@extends('layout.master')

@section('title')
    Users
@endsection

@section('content')
    <br><br>

    <h2>List of Users</h2>
    <table class="table">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Post Count</th>
            <th>Register At</th>
            <th class="text-right">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($users)
            @foreach($users as $key => $user)
                <tr>
                    <td class="text-center">{{$key + 1}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->posts_count}}</td>
                    <td>{{verta($user->created_at) }}</td>
                    @if($user->id != 1)
                        <td class="td-actions text-right">
                            <form method="POST" action="{{route('user.delete',$user->id)}}" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" rel="tooltip" class="btn btn-danger btn-sm btn-icon">
                                    <i class="now-ui-icons ui-1_simple-remove"></i>
                                </button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    {{$users->links()}}


@endsection

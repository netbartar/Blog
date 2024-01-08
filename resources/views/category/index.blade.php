@extends('layout.master')

@section('title')
    catgories
@endsection

@section('content')
    <br><br>

    <div class="row">
        <div class="col-sm-6">
            <br>
            <h2>List of categories</h2>
            <table class="table">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Title</th>
                    <th>Post Count</th>
                    <th class="text-right">Actions</th>
                </tr>
                </thead>
                <tbody>

                @if($categories)
                    @foreach($categories as $key => $category)
                        <tr>
                            <td class="text-center">{{$key + 1}}</td>
                            <td>{{$category->title}}</td>
                            <td>--</td>
                            @if($category->id != 1)
                                <td class="td-actions text-right">
                                    <a href="{{route('categories.edit',$category->id)}}">
                                        <button type="button" rel="tooltip" class="btn btn-success btn-sm btn-icon">
                                            <i class="now-ui-icons ui-2_settings-90"></i>
                                        </button>
                                    </a>
                                    <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon">
                                        <i class="now-ui-icons ui-1_simple-remove"></i>
                                    </button>
                                </td>
                            @endif

                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm4">
            <br>
            <h2>Creat new category</h2>

            <form method="POST" action="{{route('categories.store')}}">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                    @if($errors->has('title'))
                        <span class="text-danger">{{$errors->first('title')}}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>


@endsection

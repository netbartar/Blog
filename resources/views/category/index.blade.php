@extends('layout.master')

@section('title')
    catgories
@endsection

@section('content')
    <br><br>

    <div class="row">
        <div class="col-sm-6">
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
                                    <button type="button" rel="tooltip" class="btn btn-success btn-sm btn-icon">
                                        <i class="now-ui-icons ui-2_settings-90"></i>
                                    </button>
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
    </div>


@endsection

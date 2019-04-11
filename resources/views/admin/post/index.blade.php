@extends('admin.layout')
@section('title','Post')
@section('module','Bài viết')
@section('content')
    <a href="{{route('posts.create')}}" class="btn btn-success">Thêm mới</a>

    <form class="form-inline" method="get" action="{{route('posts.store')}}" id="form-search">
        <div class="col-md-3 pro-col3">
            <div class="form-group">
                <label for="per-page">Show:</label>
                <select class="form-control" name="per" id="per-page">
                    <option value="10" {{app('request')->get('per') == 10 ? 'selected' : ''}}>10</option>
                    <option value="25" {{app('request')->get('per') == 25 ? 'selected' : ''}}>25</option>
                    <option value="50" {{app('request')->get('per') == 50 ? 'selected' : ''}}>50</option>
                    <option value="100" {{app('request')->get('per') == 100 ? 'selected' : ''}}>100</option>
                    <option value="200" {{app('request')->get('per') == 200 ? 'selected' : ''}}>200</option>
                </select>
            </div>
        </div>

        <div class="col-md-9 text-right pro-col9">
            <div class="form-group">
                <label></label>
                <input type="search" class="form-control" id="search" placeholder="Tìm kiếm...."
                       name="search" value="{{ app('request')->get('search') }}">
            </div>
            <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
        </div>

    </form>

    <table class="table table-bordered table-hover table-striped">
        <thead>
        <tr class="success">
            <th>#</th>
            <th>STT</th>
            <th>Tiêu đề</th>
            <th>Mô tả ngắn</th>
            <th>Thời gian tạo</th>
            <th>Thời gian cập nhật</th>
            <th style="width: 8%">Chức năng</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td><input type="checkbox" value="{{$post->id}}"></td>
                <td>
                    @if (app('request')->get('page') > 0)
                        {{ (app('request')->get('page') - 1) * app('request')->get('per') + $loop->iteration }}
                    @else
                        {{ $loop->iteration }}
                    @endif
                </td>
                <td>{{$post->title}}</td>
                <td>
                    {{substringIfLength($post->short_description)}}
                </td>
                <td>{{formatDate("d/m/Y H:i:s",$post->created_at,"Y-m-d H:i:s")}}</td>
                <td>{{formatDate("d/m/Y H:i:s",$post->updated_at,"Y-m-d H:i:s")}}</td>
                <td>
                    <a class="col-md-4 customer-edit btn btn-info"
                       href="{{route('posts.edit',['id' => $post->id])}}"> <i
                                class="glyphicon glyphicon-pencil" title="Sửa"></i></a>
                    <form action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-delete" type="submit"
                                onclick="return window.confirm('Bạn có muốn xóa không?')">
                            <i class="glyphicon glyphicon-trash" title="Xóa"></i>
                        </button>

                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center">{{ $posts->links() }}</div>

@endsection

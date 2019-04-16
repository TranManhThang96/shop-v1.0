@extends('admin.layout')
@section('title','Category')
@section('module','Danh Mục')
@section('content')

    <a href="{{route('categories.create')}}" class="btn btn-success">Thêm mới</a>

    <form class="form-inline" method="get" action="{{route('categories.index')}}" id="form-search">
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
                <input type="text" class="form-control" id="search" placeholder="Tìm kiếm...."
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
            <th></th>
            <th>Tên Danh Mục</th>
            <th>SEO</th>
            <th>Danh mục cha</th>
            <th>Trạng Thái</th>
            <th>Thứ tự</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td><input type="checkbox" value="{{$category->id}}"></td>
                <td>
                    @if (app('request')->get('page') > 0)
                        {{ (app('request')->get('page') - 1) * app('request')->get('per') + $loop->iteration }}
                    @else
                        {{ $loop->iteration }}
                    @endif
                </td>
                <td class="show-detail cursor"><i class="glyphicon glyphicon-option-horizontal"></i></td>
                <td>{{$category->name}}</td>
                <td>{{$category->slug}}</td>
                <td>{{getParent('',$category->id,'')}}</td>
                <td class="status-category" data-id="{{$category->id}}">
                    <input type="checkbox" value="{{$category->active}}" {{$category->active == 1 ? 'checked' : ''}}>
                </td>
                <td>
                    {{$category->order}}
                </td>
                <td>
                    <a class="col-md-4 customer-edit btn btn-info"
                       href="{{route('categories.edit',['id' => $category->id])}}"> <i
                                class="glyphicon glyphicon-pencil" title="Sửa"></i></a>
                    <form action="{{ route('categories.destroy', ['id' => $category->id]) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-delete" type="submit"
                                onclick="return window.confirm('Bạn có muốn xóa không?')">
                            <i class="glyphicon glyphicon-trash" title="Xóa"></i>
                        </button>

                    </form>
                </td>
            </tr>
            <tr class="display-none">
                <td colspan="12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Chi Tiết</div>
                        <div class="panel-body">

                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center">{{ $categories->links() }}</div>
@endsection

@section('script')
    <script>
        $('.status-category').on('click', function () {
            let id = $(this).data('id');
            let status = 0;
            if ($(this).find('input').is(':checked')) {
                status = 1;
            }
            $.ajax({
                url: "{{route('categories.changeStatus')}}",
                method: 'post',
                dataType: 'json',
                data: {
                    id: id,
                    status: status,
                    _token: "{{csrf_token()}}"
                },
                success(res) {
                    console.log('danh mục chuyển trạng thái sang ', status)
                }

            })
        })
    </script>
@endsection
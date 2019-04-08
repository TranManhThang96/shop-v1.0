@extends('admin.layout')
@section('title','Brand')
@section('module','Thương Hiệu')
@section('content')
    <a href="{{route('brands.create')}}" class="btn btn-success">Thêm mới</a>

    <form class="form-inline" method="get" action="{{route('brands.store')}}" id="form-search">
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
            <th>Thương hiệu</th>
            <th>Hình ảnh</th>
            <th>Mô tả</th>
            <th>Sản Phẩm</th>
            <th>Chức năng</th>
        </tr>
        </thead>
        <tbody>
        @foreach($brands as $brand)
            <tr>
                <td><input type="checkbox" value="{{$brand->id}}"></td>
                <td>
                    @if (app('request')->get('page') > 0)
                        {{ (app('request')->get('page') - 1) * app('request')->get('per') + $loop->iteration }}
                    @else
                        {{ $loop->iteration }}
                    @endif
                </td>
                <td class="show-detail cursor"><i class="glyphicon glyphicon-option-horizontal"></i></td>
                <td>{{$brand->name}}</td>
                <td>
                    <img src="{{asset('storage/'.$brand->image)}}" width="100">
                </td>
                <td>{!! $brand->content !!}</td>
                <td>{{$brand->product->count()}}</td>
                <td>
                    <a class="col-md-4 customer-edit btn btn-info"
                       href="{{route('brands.edit',['id' => $brand->id])}}"> <i
                                class="glyphicon glyphicon-pencil" title="Sửa"></i></a>
                    <form action="{{ route('brands.destroy', ['id' => $brand->id]) }}" method="post">
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

                    <div class="panel panel-default">
                        <div class="panel-heading">Chi Tiết</div>
                        <div class="panel-body">
                        </div>

                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center">{{ $brands->links() }}</div>

@endsection

@section('script')
    <script>
    </script>
@endsection
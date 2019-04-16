@extends('admin.layout')
@section('title','Customer')
@section('module','Khách hàng')
@section('content')

    <a href="{{route('customers.create')}}" class="btn btn-success">Thêm mới</a>

    <form class="form-inline" method="get" action="{{route('customers.index')}}" id="form-search">
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

            <div class="form-group">
                <select name="province_id" id="province" class="form-control">
                    <option value="0">-Chọn tỉnh/thành phố-</option>
                    @foreach($allProvinces as $province)
                        <option value="{{$province->id}}" {{$province->id == app('request')->get('province_id') ? 'selected':''}}>{{$province->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <select name="district_id" id="district" class="form-control">
                    <option value="0">-Chọn quận/huyện-</option>
                    @isset($districts)
                        @foreach($districts as $district)
                            <option value="{{$district->id}}" {{$district->id == app('request')->get('district_id') ? 'selected':''}}>{{$district->name}}</option>
                        @endforeach
                    @endisset
                </select>
            </div>

            <div class="form-group">
                <select name="ward_id" id="ward" class="form-control">
                    <option value="0">-Chọn xã/phường-</option>
                    @isset($wards)
                        @foreach($wards as $ward)
                            <option value="{{$ward->id}}" {{$ward->id == app('request')->get('ward_id') ? 'selected':''}}>{{$ward->name}}</option>
                        @endforeach
                    @endisset
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
        </div>

    </form>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mr-15">
        <div class="col-md-2">Tổng KM <span class="text-primary text-bold"><a
                        href="{{route('customers.index')}}">({{$shareData['countCustomer']}})</a></span></div>
        <div class="col-md-offset-1 col-md-9">Kết quả tìm kiếm <span
                    class="text-danger text-bold">({{$customers->count()}})</span></div>
    </div>

    <table class="table table-bordered table-hover table-striped">
        <thead>
        <tr class="success">
            <th>#</th>
            <th>STT</th>
            <th>Chi tiết</th>
            <th>Mã KH</th>
            <th>Tên KH</th>
            <th>SĐT</th>
            <th>Mua hàng</th>
            <th>Tổng giá trị mua hàng</th>
            <th>Chức năng</th>
        </tr>
        </thead>
        <tbody>
        @foreach($customers as $customer)
            <tr>
                <td><input type="checkbox" value="{{$customer->id}}"></td>
                <td>
                    @if (app('request')->get('page') > 0)
                        {{ (app('request')->get('page') - 1) * app('request')->get('per') + $loop->iteration }}
                    @else
                        {{ $loop->iteration }}
                    @endif
                </td>
                <td class="show-detail cursor"><i class="glyphicon glyphicon-option-horizontal"></i></td>
                <td>{{$customer->code}}</td>
                <td>{{$customer->name}}</td>
                <td>{{$customer->phone}}</td>
                <td>{{$customer->order->count()}}</td>
                <td>{{$customer->order->sum('money_total')}}</td>
                <td style="width: 8%">
                    <button class="btn btn-info"><a href="{{route('customers.edit',['id' => $customer->id])}}"> <i
                                    class="glyphicon glyphicon-pencil" title="Sửa"></i></a></button>
                    <form action="{{ route('customers.destroy', ['id' => $customer->id]) }}" method="post">
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
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <p>Mã KH: {{$customer->code}}</p>
                                    <p>Tên KH: {{$customer->name}}</p>
                                    <p>SĐT: {{$customer->phone}}</p>
                                    <p>Giới tính: {{$customer->sex == 1 ? 'Nam' : 'Nữ' }}</p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <p>Email: {{$customer->email}}</p>
                                    <p>Địa chỉ: {{$customer->address}}</p>
                                    <p>Tạo bởi: {{$customer->name}}</p>
                                </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center">{{ $customers->links() }}</div>
@endsection

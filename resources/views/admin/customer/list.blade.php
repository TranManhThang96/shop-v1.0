@extends('admin.layout')
@section('title','Khách Hàng')
@section('module','Khách hàng')
@section('method','Danh sách')

@section('content')
    <div class="col-md-2">
        <a href="{{route('admin.customer.add')}}" class="btn btn-success">Thêm mới</a>
        <button class="btn btn-success">Tác vụ</button>
    </div>
    <div class="col-md-9 col-md-offset-1">
        <form class="form-inline" method="post" action="{{route('admin.customer.list')}}">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" id="keyword-search" placeholder="Tìm kiếm...."
                       name="keyword" value="{{$keyword}}">
            </div>
            <div class="form-group">
                <select name="province_id" id="province" class="form-control">
                    <option value="0">-Chọn tỉnh/thành phố-</option>
                    @foreach($dataAddress['allProvince'] as $province)
                        <option value="{{$province->id}}" {{$province->id == $dataAddress['province_id'] ? 'selected':''}}>{{$province->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <select name="district_id" id="district" class="form-control">
                    <option value="0">-Chọn quận/huyện-</option>
                    @isset($dataAddress['listDistrict'])
                        @foreach($dataAddress['listDistrict'] as $district)
                            <option value="{{$district->id}}" {{$district->id == $dataAddress['district_id'] ? 'selected':''}}>{{$district->name}}</option>
                        @endforeach
                    @endisset
                </select>
            </div>

            <div class="form-group">
                <select name="ward_id" id="ward" class="form-control">
                    <option value="0">-Chọn xã/phường-</option>
                    @isset($dataAddress['listWard'])
                        @foreach($dataAddress['listWard'] as $ward)
                            <option value="{{$ward->id}}" {{$ward->id == $dataAddress['ward_id'] ? 'selected':''}}>{{$ward->name}}</option>
                        @endforeach
                    @endisset
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Tìm Kiếm</button>

            </button>
        </form>
    </div>



    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mr-15">
        Tổng khách hàng <span class="text-primary text-bold"><a
                    href="{{route('admin.customer.list')}}">({{$shareData['countCustomer']}})</a></span>
        <span class="col-md-offset-1">Kết quả tìm kiếm <span class="text-danger text-bold">({{$countAvailable}})</span></span>
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
        @foreach($listCustomers as $customer)
            <tr>
                <td><input type="checkbox" value="{{$customer->id}}"></td>
                <td>{{($page - 1)*$limit + $loop->iteration}}</td>
                <td class="show-detail cursor"><i class="glyphicon glyphicon-option-horizontal"></i></td>
                <td>{{$customer->code}}</td>
                <td>{{$customer->name}}</td>
                <td>{{$customer->phone}}</td>
                <td>0</td>
                <td>0</td>
                <td>

                    <a class="col-md-4 customer-edit"
                       href="{{route('admin.customer.edit',$customer->id)}}"> <i
                                class="glyphicon glyphicon-pencil" title="Sửa"></i></a>
                    <a class="col-md-offset-2 col-md-4 customer-remove"
                       href="{{route('admin.customer.remove',$customer->id)}}"
                       onclick="return window.confirm('Bạn có chắc chắn muốn xóa?')" title="Xóa"> <i
                                class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
            <tr class="display-none">
                <td colspan="10">
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
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center">{{ $listCustomers->links() }}</div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('.show-detail').on('click', function () {
                $(this).parent().next().toggle();
            })
        })
    </script>
@endsection
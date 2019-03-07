@extends('admin.layout')
@section('title','Discount')
@section('module','Khuyến mại')
@section('method','Danh sách')
@section('content')
    <div class="col-md-2">
        <a href="{{route('admin.discount.add')}}" class="btn btn-success"><i
                    class="glyphicon glyphicon-plus"></i> Thêm mới</a>
    </div>


    <div class="col-md-9 col-md-offset-1">
        <form class="form-inline" method="post" action="{{route('admin.discount.list')}}">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" id="keyword-search" placeholder="Tìm kiếm...."
                       name="keyword" value="{{old('keyword')}}">

            </div>

            <div class="form-group">
                <input type="text" data-provide="datepicker" class="form-control" name="start" id="start"
                       data-date-format="dd/mm/yyyy"
                       value="{{old('start')}}"
                       data-date-autoclose="true" placeholder="Từ ngày....">
            </div>

            <div class="form-group">
                <input type="text" data-provide="datepicker" class="form-control" name="end" id="end"
                       data-date-format="dd/mm/yyyy"
                       value="{{old('end')}}"
                       data-date-autoclose="true" placeholder="Đến ngày....">
            </div>

            <div class="form-group">
                  <select class="form-control" name="typeBy">
                      <option value="0" {{old('typeBy') == 0 ? 'selected' : ''}}>KM theo</option>
                      <option value="1" {{old('typeBy') == 1 ? 'selected' : ''}}>SP</option>
                      <option value="2" {{old('typeBy') == 2 ? 'selected' : ''}}>ĐH</option>
                  </select>
            </div>
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>

            </button>
        </form>
    </div>



    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mr-15">
        <div class="col-md-2">Tổng KM <span class="text-primary text-bold"><a
                        href="{{route('admin.discount.list')}}">({{$shareData['countDiscount']}})</a></span></div>
        <div class="col-md-offset-1 col-md-9">Kết quả tìm kiếm <span class="text-danger text-bold">({{$countAvailable}})</span></div>
    </div>

    <table class="table table-bordered table-hover table-striped">
        <thead>
        <tr class="success">
            <th>#</th>
            <th>STT</th>
            <th>Chi tiết</th>
            <th>Tên KM</th>
            <th>Mã KM</th>
            <th>KM theo</th>
            <th>KM</th>
            <th>TG bắt đầu</th>
            <th>TG kết thúc</th>
            <th>Tác vụ</th>
        </tr>
        </thead>
        <tbody>
        @foreach($listDiscount as $discount)
            <tr>
                <td><input type="checkbox" value="{{$discount->id}}"></td>
                <td>{{($page - 1)*$limit + $loop->iteration}}</td>
                <td class="show-detail cursor"><i class="glyphicon glyphicon-option-horizontal"></i></td>
                <td>{{$discount->name}}</td>
                <td>{{$discount->code}}</td>
                <td>{{($discount->type_by == 1) ? 'SP' : 'ĐH'}}</td>
                <td>{{number_format($discount->discount,0,',','.')}}({{($discount->type == 1) ? '$' : '%'}})</td>
                <td>{{formatDate("d/m/Y",$discount->start,"Y-m-d H:i:s")}}</td>
                <td>{{formatDate("d/m/Y",$discount->end,"Y-m-d H:i:s")}}</td>
                <td>

                    <a class="col-md-4 customer-edit"
                       href="{{route('admin.discount.edit',$discount->id)}}"> <i
                                class="glyphicon glyphicon-pencil" title="Sửa"></i></a>
                    <a class="col-md-offset-2 col-md-4 customer-remove"
                       href="{{route('admin.discount.remove',$discount->id)}}"
                       onclick="return window.confirm('Bạn có chắc chắn muốn xóa?')" title="Xóa"> <i
                                class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
            <tr class="display-none">
                <td colspan="10">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <p>Mã KM: {{$discount->code}}</p>
                        <p>Tên KM: {{$discount->name}}</p>
                        <p>KM theo : {{($discount->type_by == 1) ? 'SP' : 'ĐH'}}</p>
                        <p>Giá trị: {{number_format($discount->discount,0,',','.')}}({{($discount->type == 1) ? '$' : '%'}})</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <p>TG bắt đầu: {{formatDate("d/m/Y H:i:s",$discount->start,"Y-m-d H:i:s")}}</p>
                        <p>TG kết thúc: {{formatDate("d/m/Y H:i:s",$discount->end,"Y-m-d H:i:s")}}</p>
                        <p>Mô tả: {{$discount->description}}</p>
                        <p>Giới hạn: {{number_format($discount->limit,0,',','.')}}($)</p>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center">{{ $listDiscount->links() }}</div>
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
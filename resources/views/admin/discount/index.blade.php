@extends('admin.layout')
@section('title','Discount')
@section('module','Khuyến mại')
@section('content')

    <a href="{{route('discounts.create')}}" class="btn btn-success">Thêm mới</a>

    <form class="form-inline" method="get" action="{{route('discounts.index')}}" id="form-search">
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
                <input type="text" data-provide="datepicker" class="form-control" name="start" id="start"
                       data-date-format="dd/mm/yyyy"
                       value="{{app('request')->get('start')}}"
                       data-date-autoclose="true" placeholder="Từ ngày....">
            </div>

            <div class="form-group">
                <input type="text" data-provide="datepicker" class="form-control" name="end" id="end"
                       data-date-format="dd/mm/yyyy"
                       value="{{app('request')->get('end')}}"
                       data-date-autoclose="true" placeholder="Đến ngày....">
            </div>

            <div class="form-group">
                <select class="form-control" name="typeBy">
                    <option value="0" {{app('request')->get('typeBy') == 0 ? 'selected' : ''}}>KM theo</option>
                    <option value="1" {{app('request')->get('typeBy') == 1 ? 'selected' : ''}}>SP</option>
                    <option value="2" {{app('request')->get('typeBy') == 2 ? 'selected' : ''}}>ĐH</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
        </div>

    </form>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mr-15">
        <div class="col-md-2">Tổng KM <span class="text-primary text-bold"><a
                        href="{{route('discounts.index')}}">({{$shareData['countDiscount']}})</a></span></div>
        <div class="col-md-offset-1 col-md-9">Kết quả tìm kiếm <span class="text-danger text-bold">({{$discounts->count()}})</span></div>
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
        @foreach($discounts as $discount)
            <tr>
                <td><input type="checkbox" value="{{$discount->id}}"></td>
                <td>
                    @if (app('request')->get('page') > 0)
                        {{ (app('request')->get('page') - 1) * app('request')->get('per') + $loop->iteration }}
                    @else
                        {{ $loop->iteration }}
                    @endif
                </td>
                <td class="show-detail cursor"><i class="glyphicon glyphicon-option-horizontal"></i></td>
                <td>{{$discount->name}}</td>
                <td>{{$discount->code}}</td>
                <td>{{($discount->type_by == 1) ? 'SP' : 'ĐH'}}</td>
                <td>{{number_format($discount->discount,0,',','.')}}({{($discount->type == 1) ? '$' : '%'}})</td>
                <td>{{formatDate($discount->start,"Y-m-d H:i:s", "d/m/Y")}}</td>
                <td>{{formatDate($discount->end,"Y-m-d H:i:s", "d/m/Y")}}</td>
                <td style="width: 8%">
                    <button class="btn btn-info"><a href="{{route('discounts.edit',['id' => $discount->id])}}"> <i
                                class="glyphicon glyphicon-pencil" title="Sửa"></i></a></button>
                    {{--<form action="{{ route('discounts.destroy', ['id' => $discount->id]) }}" method="post">--}}
                        {{--@method('DELETE')--}}
                        {{--@csrf--}}
                        {{--<button class="btn btn-danger btn-delete" type="submit"--}}
                                {{--onclick="return window.confirm('Bạn có muốn xóa không?')">--}}
                            {{--<i class="glyphicon glyphicon-trash" title="Xóa"></i>--}}
                        {{--</button>--}}

                    {{--</form>--}}
                </td>
            </tr>
            <tr class="display-none">
                <td colspan="12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Chi Tiết</div>
                        <div class="panel-body">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <p>Mã KM: {{$discount->code}}</p>
                                <p>Tên KM: {{$discount->name}}</p>
                                <p>KM theo : {{($discount->type_by == 1) ? 'SP' : 'ĐH'}}</p>
                                <p>Giá trị: {{number_format($discount->discount,0,',','.')}}({{($discount->type == 1) ? '$' : '%'}})</p>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <p>TG bắt đầu: {{formatDate($discount->start,"Y-m-d H:i:s", "d/m/Y H:i:s")}}</p>
                                <p>TG kết thúc: {{formatDate($discount->end,"Y-m-d H:i:s", "d/m/Y H:i:s")}}</p>
                                <p>Mô tả: {{$discount->description}}</p>
                                <p>Giới hạn: {{number_format($discount->limit,0,',','.')}}($)</p>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center">{{ $discounts->links() }}</div>
@endsection

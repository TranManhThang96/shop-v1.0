@extends('admin.layout')
@section('title','Supplier')
@section('module','Nhà Cung Cấp')
@section('content')
    <a href="{{route('suppliers.create')}}" class="btn btn-success">Thêm mới</a>

    <form class="form-inline" method="get" action="{{route('suppliers.store')}}" id="form-search">
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
            <th></th>
            <th>Mã NCC</th>
            <th>Tên NCC</th>
            <th>SĐT</th>
            <th>Số lần giao dịch</th>
            <th>Giá trị giao dịch</th>
            <th>Thời gian tạo</th>
            <th>Thời gian cập nhật</th>
            <th>Chức năng</th>
        </tr>
        </thead>
        <tbody>
        @foreach($suppliers as $supplier)
            <tr>
                <td><input type="checkbox" value="{{$supplier->id}}"></td>
                <td>
                    @if (app('request')->get('page') > 0)
                        {{ (app('request')->get('page') - 1) * app('request')->get('per') + $loop->iteration }}
                    @else
                        {{ $loop->iteration }}
                    @endif
                </td>
                <td class="show-detail cursor"><i class="glyphicon glyphicon-option-horizontal"></i></td>
                <td>{{$supplier->code}}</td>
                <td>
                    {{$supplier->name}}
                </td>
                <td>{{$supplier->phone}}</td>
                <td>{{$supplier->importInvoice_count ?? 0}}</td>
                <td>{{number_format($supplier->importInvoice->sum('money_total'),0,',','.')}}</td>
                <td>{{formatDate("d/m/Y H:i:s",$supplier->created_at,"Y-m-d H:i:s")}}</td>
                <td>{{formatDate("d/m/Y H:i:s",$supplier->updated_at,"Y-m-d H:i:s")}}</td>
                <td>
                    <a class="col-md-4 customer-edit btn btn-info"
                       href="{{route('suppliers.edit',['id' => $supplier->id])}}"> <i
                                class="glyphicon glyphicon-pencil" title="Sửa"></i></a>
                    <form action="{{ route('suppliers.destroy', ['id' => $supplier->id]) }}" method="post">
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
                            <div>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#detail{{$supplier->id}}"
                                                                              aria-controls="detail{{$supplier->id}}"
                                                                              role="tab" data-toggle="tab">Chi Tiết</a>
                                    </li>
                                    <li role="presentation"><a href="#history-import-invoice{{$supplier->id}}"
                                                               aria-controls="history-import-invoice{{$supplier->id}}"
                                                               role="tab"
                                                               data-toggle="tab">Lịch Sử Nhập Hàng</a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="detail{{$supplier->id}}">
                                        <p>
                                            <span class="col-md-1"><b>Mã NCC</b></span>
                                            <span>{{$supplier->code}}</span>
                                        </p>
                                        <p>
                                            <span class="col-md-1"><b>Tên NCC</b></span>
                                            <span>{{$supplier->name}}</span>
                                        </p>
                                        <p>
                                            <span class="col-md-1"><b>SĐT</b></span>
                                            <span>{{$supplier->phone}}</span>
                                        </p>
                                        <p>
                                            <span class="col-md-1"><b>Email</b></span>
                                            <span>{{$supplier->email}}</span>
                                        </p>
                                        <p>
                                            <span class="col-md-1"><b>Địa Chỉ </b></span>
                                            <span>{{$supplier->address}}</span>
                                        </p>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="history-import-invoice{{$supplier->id}}">
                                        <table class="table table-bordered table-responsive">
                                            <thead>
                                            <tr>
                                                <th>Mã phiếu</th>
                                                <th>Thời gian</th>
                                                <th>Người tạo</th>
                                                <th>Số Sp</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($supplier->importInvoice as $importInvoice)
                                                <tr>
                                                    <td>{{$importInvoice->code}}</td>
                                                    <td>{{formatDate("d/m/Y H:i:s",$importInvoice->created_at,"Y-m-d H:i:s")}}</td>
                                                    <td></td>
                                                    <td>{{$importInvoice->quantity_total}}</td>
                                                    <td>{{number_format($importInvoice->money_total,0,',','.')}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center">{{ $suppliers->links() }}</div>

@endsection

@extends('admin.layout')
@section('title','ExportInvoice')
@section('module','Hóa đơn xuất')
@section('content')
    <a href="{{route('export-invoice.create')}}" class="btn btn-success">Thêm mới</a>

    <form class="form-inline" method="get" action="{{route('export-invoice.index')}}" id="form-search">
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

    <table class="table table-bordered table-hover table-striped table-responsive">
        <thead>
        <tr class="success">
            <th>#</th>
            <th>STT</th>
            <th>Chi tiết</th>
            <th>Mã hóa đơn</th>
            <th>Số sản phẩm</th>
            <th>Tổng tiền</th>
            <th>Ghi chú</th>
            <th>Ngày tạo</th>
            <th>Chức năng</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoice)
            <tr>
                <td><input type="checkbox" value="{{$invoice->id}}"></td>
                <td>
                    @if (app('request')->get('page') > 0)
                        {{ (app('request')->get('page') - 1) * app('request')->get('per') + $loop->iteration }}
                    @else
                        {{ $loop->iteration }}
                    @endif
                </td>
                <td class="show-detail cursor"><i class="glyphicon glyphicon-option-horizontal"></i></td>
                <td>{{$invoice->code}}</td>
                <td>{{$invoice->quantity_total}}</td>
                <td>{{number_format($invoice->money_total,0,',','.')}}</td>
                <td>{{$invoice->note}}</td>
                <td>{{formatDate("d/m/Y H:i:s",$invoice->created_at,"Y-m-d H:i:s")}}</td>
                <td>
                    {{--<div class="col-sm-6">--}}
                    {{--<button class="btn btn-info"><a href="{{route('import-invoice.edit',['id' => $invoice->id])}}">--}}
                    {{--<i--}}
                    {{--class="glyphicon glyphicon-pencil" title="Sửa"></i></a></button>--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-6">--}}
                    {{--<form action="{{ route('import-invoice.destroy', ['id' => $invoice->id]) }}" method="post">--}}
                    {{--@method('DELETE')--}}
                    {{--@csrf--}}
                    {{--<button class="btn btn-danger btn-delete" type="submit"--}}
                    {{--onclick="return window.confirm('Bạn có muốn xóa không?')">--}}
                    {{--<i class="glyphicon glyphicon-trash" title="Xóa"></i>--}}
                    {{--</button>--}}
                    {{--</form>--}}
                    {{--</div>--}}
                </td>
            </tr>
            <tr class="display-none">
                <td colspan="12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation"><a href="#history-import-invoice{{$invoice->id}}"
                                                   aria-controls="history-import-invoice{{$invoice->id}}"
                                                   role="tab"
                                                   data-toggle="tab">Chi tiết</a></li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="history-import-invoice{{$invoice->id}}">
                            <table class="table table-striped table-bordered table-active table-responsive">
                                <thead>
                                <th>STT</th>
                                <th>Hình Ảnh</th>
                                <th>Sản Phẩm</th>
                                <th>SKU</th>
                                <th>Giá Bán</th>
                                <th>Số Lượng</th>
                                </thead>
                                <tbody id="product-item">
                                @if ($invoice->exportInvoiceItem->count() > 0)
                                    @foreach ($invoice->exportInvoiceItem as $item)
                                        <tr data-id="{{$loop->iteration}}">
                                            <td>{{$loop->iteration}}</td>
                                            <td><img src="{{asset('storage/'.$item->image)}}" onerror="this.src=''"/>
                                            </td>
                                            <td>
                                                <span>{{$item->name}}</span>
                                                @isset ($item->productItem->color) <p>Màu
                                                    sắc: {{$item->productItem->color}} </p>@endisset
                                                @isset ($item->productItem->ram)<p>
                                                    Ram: {{$item->productItem->ram}}</p>@endisset
                                                @isset ($item->productItem->rom) <p>
                                                    Rom:{{$item->productItem->rom}}</p>@endisset
                                                @isset ($item->productItem->size)<p>
                                                    Size: {{$item->productItem->size}}</p>@endisset
                                            </td>
                                            <td>{{$item->sku}}</td>
                                            <td>{{number_format($item->price,0,',','.')}}</td>
                                            <td>{{$item->quantity}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center">{{ $invoices->links() }}</div>

@endsection

@section('script')

@endsection
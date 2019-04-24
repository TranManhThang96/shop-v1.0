@extends('admin.layout')
@section('title','ImportInvoice')
@section('module','Hóa đơn nhập')
@section('content')
    <a href="{{route('import-invoice.create')}}" class="btn btn-success">Thêm mới</a>

    <form class="form-inline" method="get" action="{{route('import-invoice.index')}}" id="form-search">
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
            <th>Nhà cung cấp</th>
            <th>Số sản phẩm</th>
            <th>Tổng tiền</th>
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
                <td>{{$invoice->supplier_id}}</td>
                <td>{{$invoice->quantity_total}}</td>
                <td>{{number_format($invoice->money_total,0,',','.')}}</td>
                <td>{{$invoice->created_at}}</td>
                <td>
                    <div class="col-sm-6">
                        <button class="btn btn-info"><a href="{{route('import-invoice.edit',['id' => $invoice->id])}}"> <i
                                        class="glyphicon glyphicon-pencil" title="Sửa"></i></a></button>
                    </div>
                    <div class="col-sm-6">
                        <form action="{{ route('import-invoice.destroy', ['id' => $invoice->id]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-delete" type="submit"
                                    onclick="return window.confirm('Bạn có muốn xóa không?')">
                                <i class="glyphicon glyphicon-trash" title="Xóa"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            <tr class="display-none">
                {{--<td colspan="12">--}}
                    {{--<ul class="nav nav-tabs" role="tablist">--}}
                        {{--<li role="presentation" class="active"><a href="#detail{{$product->id}}"--}}
                                                                  {{--aria-controls="detail{{$product->id}}"--}}
                                                                  {{--role="tab" data-toggle="tab">Chi Tiết</a>--}}
                        {{--</li>--}}
                        {{--<li role="presentation"><a href="#history-import-invoice{{$product->id}}"--}}
                                                   {{--aria-controls="history-import-invoice{{$product->id}}"--}}
                                                   {{--role="tab"--}}
                                                   {{--data-toggle="tab">Sản phẩm con</a></li>--}}
                    {{--</ul>--}}

                    {{--<div class="tab-content">--}}
                        {{--<div role="tabpanel" class="tab-pane active" id="detail{{$product->id}}">--}}

                            {{--<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">--}}
                                {{--<p>Tên SP: {{$product->name}}</p>--}}
                                {{--<p>SKU: {{$product->sku}}</p>--}}
                                {{--<p>Barcode: {{$product->barcode}}</p>--}}
                                {{--<p>Danh mục: {{$product->category->name }}</p>--}}
                            {{--</div>--}}

                            {{--<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">--}}
                                {{--<p>Giá Nhập: {{number_format($product->iprice)}}</p>--}}
                                {{--<p>Giá bán: {{number_format($product->price)}}</p>--}}
                                {{--<p>Tạo bởi: {{$product->name}}</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div role="tabpanel" class="tab-pane" id="history-import-invoice{{$product->id}}">--}}
                            {{--<table class="table table-striped table-bordered table-active table-responsive">--}}
                                {{--<thead>--}}
                                {{--<th>STT</th>--}}
                                {{--<th>Giá Nhập</th>--}}
                                {{--<th>Giá Niêm Yết</th>--}}
                                {{--<th>Khuyến Mại</th>--}}
                                {{--<th>Chiều dài (cm)</th>--}}
                                {{--<th>Chiều rộng (cm)</th>--}}
                                {{--<th>Chiều cao (cm)</th>--}}
                                {{--<th>Cân nặng (g)</th>--}}
                                {{--<th>Màu sắc</th>--}}
                                {{--<th>Kích cỡ</th>--}}
                                {{--<th>Số Lượng</th>--}}
                                {{--<th></th>--}}
                                {{--</thead>--}}
                                {{--<tbody id="product-item">--}}
                                {{--@if ($product->productItem->count() > 0)--}}
                                    {{--@foreach ($product->productItem as $productItem)--}}
                                        {{--<tr data-id="{{$loop->iteration}}">--}}
                                            {{--<td>{{$loop->iteration}}</td>--}}
                                            {{--<td><input type="text" class="form-control item-iprice"--}}
                                                       {{--name="items[{{$loop->iteration}}][iprice]"--}}
                                                       {{--value="{{number_format($productItem->iprice)}}"/></td>--}}
                                            {{--<td><input type="text" class="form-control item-price"--}}
                                                       {{--name="items[{{$loop->iteration}}][price]"--}}
                                                       {{--value="{{number_format($productItem->price)}}"/></td>--}}
                                            {{--<td>--}}
                                                {{--<select class="form-control discount"--}}
                                                        {{--name="items[{{$loop->iteration}}][discount_id]">--}}
                                                    {{--<option value="0">--CHỌN KM--</option>--}}
                                                    {{--@if ($discounts->count() > 0)--}}
                                                        {{--@foreach ($discounts as $discount)--}}
                                                            {{--<option value="{{$discount->id}}">--}}
                                                                {{--{{$discount->name}}--}}
                                                                {{--({{number_format($discount->discount,0,',','.')}}{{($discount->type == 1) ? '$' : '%'}}--}}
                                                                {{--)--}}
                                                            {{--</option>--}}
                                                        {{--@endforeach--}}
                                                    {{--@endif--}}
                                                {{--</select>--}}
                                            {{--</td>--}}
                                            {{--<td><input type="text" class="form-control item-length"--}}
                                                       {{--name="items[{{$loop->iteration}}][length]"--}}
                                                       {{--value="{{$productItem->length}}"/></td>--}}
                                            {{--<td><input type="text" class="form-control item-width"--}}
                                                       {{--name="items[{{$loop->iteration}}][width]"--}}
                                                       {{--value="{{$productItem->width}}"/></td>--}}
                                            {{--<td><input type="text" class="form-control item-height"--}}
                                                       {{--name="items[{{$loop->iteration}}][height]"--}}
                                                       {{--value="{{$productItem->height}}"/></td>--}}
                                            {{--<td><input type="text" class="form-control item-weight"--}}
                                                       {{--name="items[{{$loop->iteration}}][weight]"--}}
                                                       {{--value="{{$productItem->weight}}"/></td>--}}
                                            {{--<td><input type="text" class="form-control item-color"--}}
                                                       {{--name="items[{{$loop->iteration}}][color]"--}}
                                                       {{--value="{{$productItem->color}}"/></td>--}}
                                            {{--<td><input type="text" class="form-control item-size"--}}
                                                       {{--name="items[{{$loop->iteration}}][size]"--}}
                                                       {{--value="{{$productItem->size}}"/></td>--}}
                                            {{--<td>--}}
                                                {{--<div class="input-group">--}}
                                                    {{--<div class="input-group-addon sub-quantity"> -</div>--}}
                                                    {{--<input type="text" class="form-control item-quantity"--}}
                                                           {{--name="items[{{$loop->iteration}}][quantity]"--}}
                                                           {{--value="{{$productItem->quantity}}"/>--}}
                                                    {{--<div class="input-group-addon plus-quantity"> +</div>--}}
                                                {{--</div>--}}
                                            {{--</td>--}}
                                            {{--<td>--}}
                                                {{--<button type="button" class="btn btn-danger remove-item"> -</button>--}}
                                                {{--<button type="button" class="btn btn-success add-item"> +</button>--}}
                                            {{--</td>--}}
                                        {{--</tr>--}}
                                    {{--@endforeach--}}
                                {{--@endif--}}
                                {{--</tbody>--}}
                            {{--</table>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                {{--</td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center">{{ $invoices->links() }}</div>

@endsection

@section('script')

@endsection
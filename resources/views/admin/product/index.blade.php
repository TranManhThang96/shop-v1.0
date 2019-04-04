@extends('admin.layout')
@section('title','Product')
@section('module','Sản Phẩm')
@section('content')
    <a href="{{route('admin.product.create')}}" class="btn btn-success">Thêm mới</a>

    <form class="form-inline" method="get" action="{{route('admin.product.index')}}" id="form-search">
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
            <th>Chi tiết</th>
            <th>SKU</th>
            <th>Barcode</th>
            <th>Tên SP</th>
            <th>Danh mục</th>
            <th>Số lượng</th>
            <th>KM</th>
            <th>Chức năng</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td><input type="checkbox" value="{{$product->id}}"></td>
                <td>
                    @if (app('request')->get('page') > 0)
                        {{ (app('request')->get('page') - 1) * app('request')->get('per') + $loop->iteration }}
                    @else
                        {{ $loop->iteration }}
                    @endif
                </td>
                <td class="show-detail cursor"><i class="glyphicon glyphicon-option-horizontal"></i></td>
                <td>{{$product->sku}}</td>
                <td>{{$product->barcode}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->category->name}}</td>
                <td>{{$product->productItem->sum->quantity}}</td>
                <td class="discount-tooltip">
                    {{$product->discount->name}}
                    <div class="show-tooltip">
                        <p>Giảm
                            giá: {{number_format($product->discount->discount)}} {{$product->discount->type == 1 ? '$' : '%'}}</p>
                        <p>Áp dụng cho: {{$product->discount->type_by == 1 ? 'ĐH' : 'SP'}}</p>
                        <p>Thời gian: {{formatDate("d/m/",$product->discount->start,"Y-m-d H:i:s")}}
                            - {{formatDate("d/m",$product->discount->end,"Y-m-d H:i:s")}}</p>
                    </div>
                </td>
                <td>

                    <a class="col-md-4 customer-edit"
                       href="{{route('admin.product.edit',$product->id)}}"> <i
                                class="glyphicon glyphicon-pencil" title="Sửa"></i></a>
                    {{--<a class="col-md-offset-2 col-md-4 customer-remove"--}}
                    {{--href="{{route('admin.product.destroy',$product->id)}}"--}}
                    {{--onclick="return window.confirm('Bạn có chắc chắn muốn xóa?')" title="Xóa"> <i--}}
                    {{--class="glyphicon glyphicon-trash"></i></a>--}}
                </td>
            </tr>
            <tr class="display-none">
                <td colspan="12">

                    <div class="panel panel-default">
                        <div class="panel-heading">Chi Tiết</div>
                        <div class="panel-body">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <p>Mã KH: {{$product->code}}</p>
                                <p>Tên KH: {{$product->name}}</p>
                                <p>SĐT: {{$product->phone}}</p>
                                <p>Giới tính: {{$product->sex == 1 ? 'Nam' : 'Nữ' }}</p>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <p>Email: {{$product->email}}</p>
                                <p>Địa chỉ: {{$product->address}}</p>
                                <p>Tạo bởi: {{$product->name}}</p>
                            </div>
                        </div>

                        <div class="panel-footer">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Sản Phẩm Con</div>
                                <div class="panel-body">
                                    <table class="table table-responsive">
                                        @foreach ($product->productItem as $productItem)
                                            <tr>
                                                <td><input type="text" class="form-control" value="{{$productItem->sku_item}}"></td>
                                                <td><input type="text" class="form-control" value="{{$productItem->color}}"></td>
                                                <td><input type="text" class="form-control" value="{{$productItem->size}}"></td>
                                                <td><input type="text" class="form-control" value="{{$productItem->price}}"></td>
                                                <td><input type="text" class="form-control" value="{{$productItem->iprice}}"></td>
                                                <td><input type="text" class="form-control" value="{{$productItem->quantity}}"></td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center">{{ $products->links() }}</div>

@endsection

@section('script')

@endsection
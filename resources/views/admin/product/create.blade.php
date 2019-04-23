@extends('admin.layout')
@section('title','Sản Phẩm')
@section('module','Sản Phẩm')
@section('method','Thêm mới')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/product/create.css') }}">
@endsection
@section('content')
    <form action="{{route('products.store')}}" method="post" id="frm" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" id="id">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="name">Tên SP <span class="text-danger" title="Trường bắt buộc"> (*) </span></label>
                <input type="text" class="form-control" id="name" placeholder="Nhập tên sp" name="name" value="{{old('name')}}">
                @if($errors->has('name'))
                    <span class="text-danger">
                        {{$errors->first('name')}}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="category">Danh mục <span class="text-danger" title="Trường bắt buộc"> (*) </span></label>
                <select class="form-control" name="cat_id" id="category">
                    <option value="0">--VUI LÒNG CHỌN DANH MỤC--</option>
                    @if ($categories->count() > 0)
                        {!! showCategories($categories,0,'',old('cat_id',0)) !!}}
                    @endif
                </select>
                @if($errors->has('cat_id'))
                    <span class="text-danger">
                        {{$errors->first('cat_id')}}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="barcode">Barcode</label>
                <input type="text" class="form-control" id="barcode" placeholder="Nhập barcode để quet" name="barcode" value="{{old('barcode')}}">
            </div>

            <div class="form-group">
                <label for="brand">Thương Hiệu</label>
                <select class="form-control" id="brand" name="brand_id">
                    <option value="0">--VUI LÒNG CHỌN THƯƠNG HIỆU--</option>
                    @if ($brands->count() > 0)
                        @foreach ($brands as $brand)
                            <option value="{{$brand->id}}" {{$brand->id == old('brand_id') ? 'selected' : ''}}>{{$brand->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="short_description">Mô tả ngắn</label>
                <textarea rows="3" name="short_description" class="form-control" id="short_description"
                          placeholder="Mô tả ngắn">{{old('short_description')}}</textarea>
            </div>

            <div class="form-group">
                <div class="col-md-3">
                    <input class="form-control" placeholder="Chiều dài (cm)" name="length" id="length">
                </div>
                <div class="col-md-3">
                    <input class="form-control" placeholder="Chiều rộng (cm)" name="width" id="width">
                </div>
                <div class="col-md-3">
                    <input class="form-control" placeholder="Chiều cao (cm)" name="height" id="height">
                </div>
                <div class="col-md-3">
                    <input class="form-control" placeholder="Cân nặng (gam)" name="weight" id="weight">
                </div>
            </div>

        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <div class="form-group">
                <label for="iprice">Giá Nhập <span class="text-danger" title="Trường bắt buộc"> (*) </span></label>
                <input type="text" class="form-control" id="iprice" placeholder="Giá nhập" name="iprice" value="{{old('iprice')}}">
                @if($errors->has('iprice'))
                    <span class="text-danger">
                        {{$errors->first('iprice')}}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="price">Giá Niêm Yết <span class="text-danger" title="Trường bắt buộc"> (*) </span></label>
                <input type="text" class="form-control" id="price" placeholder="Giá niêm yết" name="price" value="{{old('price')}}">
                @if($errors->has('price'))
                    <span class="text-danger">
                        {{$errors->first('price')}}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="discount">Chương Trình khuyến mại</label>
                <select class="form-control" id="discount" name="discount_id">
                    <option value="0">--CHỌN KM--</option>
                    @if ($discounts->count() > 0)
                        @foreach ($discounts as $discount)
                            <option value="{{$discount->id}}" {{$discount->id == old('discount_id') ? 'selected' : ''}}>
                                {{$discount->name}}
                                ({{number_format($discount->discount,0,',','.')}}{{($discount->type == 1) ? '$' : '%'}})
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="img-link" class="label-upload">
                    <img src="{{ asset('svg/upload.svg') }}" width="100%"/>
                </label>

                <input id="img-link" type="file" style="display: none" name="img_link"/>
                @if($errors->has('img_link'))
                    <span class="text-danger">
                        {{$errors->first('img_link')}}
                    </span>
                @endif
            </div>

            <div class="row">
                <div class="col-md-3 form-group img-list-item" data-id="0">
                    <label for="img-list[0]" class="label-upload">
                        <img src="{{ asset('svg/upload.svg') }}" width="100%"/>
                    </label>

                    <input class="img-list" id="img-list[0]" type="file" style="display: none" name="img_list[0]"
                           data-id="0"/>
                    <i class="glyphicon glyphicon-remove-circle remove-img-item"></i>
                </div>

                <input type="hidden" id="img-list-last" value="0"/>
            </div>

        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Sản phẩm con</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-active table-responsive">
                        <thead>
                        <th>STT</th>
                        <th>Giá Nhập</th>
                        <th>Giá Niêm Yết</th>
                        <th>Khuyến Mại</th>
                        <th>Ram (GB)</th>
                        <th>Rom (GB)</th>
                        <th>Màu sắc</th>
                        <th>Kích cỡ</th>
                        <th>Số Lượng</th>
                        <th></th>
                        </thead>
                        <tbody id="product-item">

                        <tr data-id="1">
                            <td>1</td>
                            <td>
                                <input type="text" class="form-control item-iprice" name="items[1][iprice]"/>
                                @if($errors->has('items.*.iprice'))
                                    <span class="text-danger">
                                        {{$errors->first('items.*.iprice')}}
                                    </span>
                                @endif
                            </td>

                            <td>
                                <input type="text" class="form-control item-price" name="items[1][price]"/>
                                @if($errors->has('items.*.price'))
                                    <span class="text-danger">
                                        {{$errors->first('items.*.price')}}
                                    </span>
                                @endif
                            </td>

                            <td>
                                <select class="form-control discount" name="items[1][discount_id]">
                                    <option value="0">--CHỌN KM--</option>
                                    @if ($discounts->count() > 0)
                                        @foreach ($discounts as $discount)
                                            <option value="{{$discount->id}}">
                                                {{$discount->name}}
                                                ({{number_format($discount->discount,0,',','.')}}{{($discount->type == 1) ? '$' : '%'}}
                                                )
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </td>
                            <td><input type="text" class="form-control item-height" name="items[1][ram]"/></td>
                            <td><input type="text" class="form-control item-weight" name="items[1][rom]"/></td>
                            <td><input type="text" class="form-control item-color" name="items[1][color]"/></td>
                            <td><input type="text" class="form-control item-size" name="items[1][size]"/></td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-addon sub-quantity"> -</div>
                                    <input type="text" class="form-control item-quantity" name="items[1][quantity]"
                                           value="0"/>
                                    @if($errors->has('items.*.quantity'))
                                        <span class="text-danger">
                                            {{$errors->first('items.*.quantity')}}
                                        </span>
                                    @endif
                                    <div class="input-group-addon plus-quantity"> +</div>
                                </div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger remove-item"> -</button>
                                <button type="button" class="btn btn-success add-item"> +</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <textarea name="description">{{old('description')}}</textarea>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
            <a class="btn btn-primary" title="Danh sách" href="{{route('products.index')}}"><i
                        class="glyphicon glyphicon-share-alt"></i></a>
            <button type="submit" class="btn btn-success" id="submit-template">Lưu lại</button>
        </div>
    </form>

    <div class="hidden">
        <table>
            <tr data-id="idx" id="tr-hidden">
                <td>idx</td>
                <td>
                    <input type="text" class="form-control item-iprice" name="items[idx][iprice]"/>
                    @if($errors->has('items.*.iprice'))
                        <span class="text-danger">
                                        {{$errors->first('items.*.iprice')}}
                                    </span>
                    @endif
                </td>
                <td><input type="text" class="form-control item-price" name="items[idx][price]"/></td>
                <td>
                    <select class="form-control discount" name="items[idx][discount_id]">
                        <option value="0">--CHỌN KM--</option>
                        @if ($discounts->count() > 0)
                            @foreach ($discounts as $discount)
                                <option value="{{$discount->id}}">
                                    {{$discount->name}}
                                    ({{number_format($discount->discount,0,',','.')}}{{($discount->type == 1) ? '$' : '%'}}
                                    )
                                </option>
                            @endforeach
                        @endif
                    </select>
                </td>
                <td><input type="text" class="form-control item-height" name="items[idx][ram]"/></td>
                <td><input type="text" class="form-control item-weight" name="items[idx][rom]"/></td>
                <td><input type="text" class="form-control item-color" name="items[idx][color]"/></td>
                <td><input type="text" class="form-control item-size" name="items[idx][size]"/></td>
                <td>
                    <div class="input-group">
                        <div class="input-group-addon sub-quantity"> -</div>
                        <input type="text" class="form-control item-quantity" name="items[idx][quantity]" value="0"/>
                        <div class="input-group-addon plus-quantity"> +</div>
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-item"> -</button>
                    <button type="button" class="btn btn-success add-item"> +</button>
                </td>
            </tr>
        </table>
    </div>

@endsection

@section('script')
    <script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
    <script src="{{ asset('js/admin/product/create.js') }}"></script>
    <script>
        CKEDITOR.replace('description');

        $('#img-link').on('change', function (event) {
            $(this).prev().find('img').attr('src', URL.createObjectURL(event.target.files[0]));
        })

        //thêm img null vào list
        $(document).on('change', '.img-list', function (event) {
            let lastId = $('#img-list-last').val();
            $(this).prev().find('img').attr('src', URL.createObjectURL(event.target.files[0]));

            if ($(this).data('id') == lastId) {
                lastId = parseInt(lastId) + 1;
                let html = ' <div class="col-md-3 form-group img-list-item" data-id="' + lastId + '">';
                html += '<label for="img-list[' + lastId + ']" class="label-upload">';
                html += '<img src="{{ asset('svg/upload.svg') }}" width="100%"/></label>';
                html += '<input class="img-list" id="img-list[' + lastId + ']" type="file"  style="display: none" name="img_list[' + lastId + ']" data-id="' + lastId + '" />';
                html += '<i class="glyphicon glyphicon-remove-circle remove-img-item"></i></div>';
                $(this).parent().after(html);
                $('#img-list-last').val(lastId);
            }
        })

        //xoa img khoi list
        $(document).on('click', '.remove-img-item', function () {
            let lastId = $('#img-list-last').val();
            let parent = $(this).parent();
            if (lastId != parent.data('id')) {
                parent.remove();
            }
        })

        //them product item null
        $(document).on('click', '.add-item', function () {
            let element = $('#tr-hidden')[0].outerHTML;
            let lastId = $('#product-item').find('tr').last().data('id');
            lastId = parseInt(lastId) + 1;
            element = element.replace(/\idx/g, lastId);
            element = element.replace('id="tr-hidden"', '');
            $('tr').not('#tr-hidden').find('.add-item').remove();
            $('#product-item').append(element);
        })

        //xoa product item
        $(document).on('click', '.remove-item', function () {
            var lenTr = $('#product-item tr').length;
            if (lenTr > 1) {
                //nêu xoa phan tu cuoi cung thì them nut them vao phan tu ngay truoc do xong ms xoa
                let lastId = $('#product-item').find('tr').last().data('id');
                let parentTr = $(this).parent().parent();
                if (lastId == parentTr.data('id')) {
                    let prevTr = parentTr.prev();
                    prevTr.find('td').last().append('<button type="button" class="btn btn-success add-item"> + </button>');
                }
                parentTr.remove();
            }
        })

        $(document).on('keyup', '.item-price, .item-iprice', function (event) {
            _formatNumber(event);
        })

        $('#price').on('keyup', function (event) {
            _formatNumber(event);
            $("[name='items[idx][price]']").attr('value', $(this).val());
            $("[name='items[1][price]']").val($(this).val());

        })

        $('#iprice').on('keyup', function (event) {
            _formatNumber(event);
            $("[name='items[idx][iprice]']").attr('value', $(this).val());
            $("[name='items[1][iprice]']").val($(this).val());
        })

        $(document).on('change', '#discount', function () {
            let val = $(this).val();
            $('.discount option[value=' + val + ']').attr('selected', 'selected');
        })

        //giam so luong
        $(document).on('click', '.sub-quantity', function () {
            let inputQty = $(this).next();
            let value = parseInt(inputQty.val());
            if (value > 0) {
                inputQty.val(value - 1);
            }
        })

        //tang so luong
        $(document).on('click', '.plus-quantity', function () {
            let inputQty = $(this).prev();
            let value = parseInt(inputQty.val());
            inputQty.val(value + 1);
        })

        //chuyen so luong
        $(document).on('keyup', '.item-quantity', function () {
            let retValue = 0;
            let str = $(this).val();
            if (str !== null) {
                if (str.length > 0) {
                    if (!isNaN(str)) {
                        retValue = parseInt(str);
                    }
                }
            }
            $(this).val(retValue);
        })
    </script>

@endsection
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
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="name">Tên SP <span class="text-danger" title="Trường bắt buộc"> (*) </span></label>
                <input type="text" class="form-control" id="name" placeholder="Nhập tên sp" name="name">
            </div>

            <div class="form-group">
                <label for="category">Danh mục <span class="text-danger" title="Trường bắt buộc"> (*) </span></label>
                <select class="form-control" name="category" id="category">
                    <option value="0">--VUI LÒNG CHỌN DANH MỤC--</option>
                    @if ($categories->count() > 0)
                        {!! showCategories($categories,0,'',0) !!}}
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="barcode">Barcode</label>
                <input type="text" class="form-control" id="barcode" placeholder="Nhập barcode để quet" name="barcode">
            </div>

            <div class="form-group">
                <label for="brand">Thương Hiệu</label>
                <select class="form-control" id="brand" name="brand">
                    <option value="0">--VUI LÒNG CHỌN THƯƠNG HIỆU--</option>
                    @if ($brands->count() > 0)
                        @foreach ($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="short_description">Mô tả ngắn</label>
                <textarea rows="5" name="short_description" class="form-control" id="short_description"
                          placeholder="Mô tả ngắn"></textarea>
            </div>

        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <div class="form-group">
                <label for="iprice">Giá Nhập <span class="text-danger" title="Trường bắt buộc"> (*) </span></label>
                <input type="text" class="form-control" id="iprice" placeholder="Giá nhập" name="iprice">
            </div>

            <div class="form-group">
                <label for="price">Giá Niêm Yết <span class="text-danger" title="Trường bắt buộc"> (*) </span></label>
                <input type="text" class="form-control" id="price" placeholder="Giá niêm yết" name="price">
            </div>

            <div class="form-group">
                <label for="discount">Chương Trình khuyến mại</label>
                <select class="form-control" id="discount" name="discount_id">
                    @if ($discounts->count() > 0)
                        @foreach ($discounts as $discount)
                            <option value="{{$discount->id}}">
                                {{$discount->name}} ({{number_format($discount->discount,0,',','.')}}{{($discount->type == 1) ? '$' : '%'}})
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
                        <th>Chiều dài (cm)</th>
                        <th>Chiều rộng (cm)</th>
                        <th>Chiều cao (cm)</th>
                        <th>Cân nặng (g)</th>
                        <th>Màu sắc</th>
                        <th>Kích cỡ</th>
                        <th>Số Lượng</th>
                        <th></th>
                        </thead>
                        <tbody id="product-item">

                        <tr data-id="1">
                            <td>1</td>
                            <td><input type="text" class="form-control item-price" name="item[1][iprice]"/></td>
                            <td><input type="text" class="form-control item-iprice" name="item[1][price]"/></td>
                            <td><input type="text" class="form-control item-discount_id" name="item[1][discount_id]"/>
                            </td>
                            <td><input type="text" class="form-control item-length" name="item[1][length]"/></td>
                            <td><input type="text" class="form-control item-width" name="item[1][width]"/></td>
                            <td><input type="text" class="form-control item-height" name="item[1][height]"/></td>
                            <td><input type="text" class="form-control item-weight" name="item[1][weight]"/></td>
                            <td><input type="text" class="form-control item-color" name="item[1][color]"/></td>
                            <td><input type="text" class="form-control item-size" name="item[1][size]"/></td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-addon sub-quantity"> -</div>
                                    <input type="text" class="form-control item-quantity" name="item_quantity"
                                           value="0"/>
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
            <textarea name="description"></textarea>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
            <a class="btn btn-primary" title="Danh sách" href="{{route('products.index')}}"><i
                        class="glyphicon glyphicon-share-alt"></i></a>
            <button type="submit" class="btn btn-success">Lưu lại</button>
        </div>
    </form>

    <div class="hidden">
        <table>
            <tr data-id="idx" id="tr-hidden">
                <td>idx</td>
                <td><input type="text" class="form-control item-price" name="item[idx][iprice]"/></td>
                <td><input type="text" class="form-control item-iprice" name="item[idx][price]"/></td>
                <td><input type="text" class="form-control item-discount_id" name="item[idx][discount_id]"/></td>
                <td><input type="text" class="form-control item-length" name="item[idx][length]"/></td>
                <td><input type="text" class="form-control item-width" name="item[idx][width]"/></td>
                <td><input type="text" class="form-control item-height" name="item[idx][height]"/></td>
                <td><input type="text" class="form-control item-weight" name="item[idx][weight]"/></td>
                <td><input type="text" class="form-control item-color" name="item[idx][color]"/></td>
                <td><input type="text" class="form-control item-size" name="item[idx][size]"/></td>
                <td>
                    <div class="input-group">
                        <div class="input-group-addon sub-quantity"> -</div>
                        <input type="text" class="form-control item-quantity" name="item_quantity" value="0"/>
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
            if (lenTr > 2) {
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
            $("[name='item[idx][price]']").attr('value', $(this).val());
            $("[name='item[1][price]']").val($(this).val());

        })

        $('#iprice').on('keyup', function (event) {
            _formatNumber(event);
            $("[name='item[idx][iprice]']").attr('value', $(this).val());
            $("[name='item[1][iprice]']").val($(this).val());
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
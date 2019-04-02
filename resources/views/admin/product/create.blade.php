@extends('admin.layout')
@section('title','Sản Phẩm')
@section('module','Sản Phẩm')
@section('method','Thêm mới')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/product/create.css') }}">
@endsection
@section('content')
    <form id="form-create">
        @csrf
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="name">Tên SP <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" placeholder="Nhập tên sp" name="name">
            </div>

            <div class="form-group">
                <label for="category">Danh mục <span class="text-danger">*</span></label>
                <select class="form-control" name="category" id="category">
                    <option></option>
                </select>
            </div>

            <div class="form-group">
                <label for="barcode">Barcode</label>
                <input type="text" class="form-control" id="barcode" placeholder="Nhập barcode để quet" name="barcode">
            </div>

            <div class="form-group">
                <label for="iprice">Giá Nhập <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="iprice" placeholder="Giá nhập" name="iprice">
            </div>

            <div class="form-group">
                <label for="price">Giá Niêm Yết <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="price" placeholder="Giá niêm yết" name="price">
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="discount_id">Chương Trình khuyến mại</label>
                <input type="text" class="form-control" id="discount_id" placeholder="Nhập barcode để quet"
                       name="discount_id">
            </div>

            <div class="form-group">
                <label for="barcode">Thương Hiệu</label>
                <input type="text" class="form-control" id="barcode" placeholder="Nhập barcode để quet" name="barcode">
            </div>

            <div class="form-group">
                <label for="barcode">Mô tả ngắn</label>
                <input type="text" class="form-control" id="barcode" placeholder="Nhập barcode để quet" name="barcode">
            </div>

            <div class="form-group">
                <label for="img-link" class="label-upload">
                    <img src="{{ asset('svg/upload.svg') }}" width="100%"/>
                </label>

                <input id="img-link" type="file" style="display: none" name="img_link"/>
            </div>

            <div class="form-group">
                <label for="img-list[0]" class="label-upload">
                    <img src="{{ asset('svg/upload.svg') }}" width="100%"/>
                </label>

                <input class="img-list" id="img-list[0]" type="file" style="display: none" name="img_list[]"
                       data-id="0"/>
            </div>

            <input type="hidden" id="img-list-last" value="0"/>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  panel panel-primary">
            <div class="panel-heading">Sản phẩm con</div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-active">
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
                    <tr data-id="idx" id="tr-hidden">
                        <td>idx</td>
                        <td><input type="text" class="form-control item-price" name="item_price"/></td>
                        <td><input type="text" class="form-control item-iprice" name="item_iprice"/></td>
                        <td><input type="text" class="form-control item-discount_id" name="item_discount_id"/></td>
                        <td><input type="text" class="form-control item-length" name="item_length"/></td>
                        <td><input type="text" class="form-control item-width" name="item_width"/></td>
                        <td><input type="text" class="form-control item-height" name="item_height"/></td>
                        <td><input type="text" class="form-control item-weight" name="item_weight"/></td>
                        <td><input type="text" class="form-control item-color" name="item_color"/></td>
                        <td><input type="text" class="form-control item-size" name="item_size"/></td>
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
                    <tr data-id="1">
                        <td>1</td>
                        <td><input type="text" class="form-control item-price" name="item_price"/></td>
                        <td><input type="text" class="form-control item-iprice" name="item_iprice"/></td>
                        <td><input type="text" class="form-control item-discount_id" name="item_discount_id"/></td>
                        <td><input type="text" class="form-control item-length" name="item_length"/></td>
                        <td><input type="text" class="form-control item-width" name="item_width"/></td>
                        <td><input type="text" class="form-control item-height" name="item_height"/></td>
                        <td><input type="text" class="form-control item-weight" name="item_weight"/></td>
                        <td><input type="text" class="form-control item-color" name="item_color"/></td>
                        <td><input type="text" class="form-control item-size" name="item_size"/></td>
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
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Lưu</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </div>
    </form>
@endsection

@section('script')
    <script src="{{ asset('js/admin/product/create.js') }}"></script>
    <script>
        $('#img-link').on('change', function (event) {
            $(this).prev().find('img').attr('src', URL.createObjectURL(event.target.files[0]));
        })

        $(document).on('change', '.img-list', function (event) {
            let lastId = $('#img-list-last').val();
            $(this).prev().find('img').attr('src', URL.createObjectURL(event.target.files[0]));

            if ($(this).data('id') == lastId) {
                lastId = parseInt(lastId) + 1;
                let html = '<div class="form-group">';
                html += '<label for="img-list[' + lastId + ']" class="label-upload">';
                html += '<img src="{{ asset('svg/upload.svg') }}" width="100%"/></label>';
                html += '<input class="img-list" id="img-list[' + lastId + ']" type="file"  style="display: none" name="img_list[]" data-id="' + lastId + '" /></div>';
                $(this).parent().after(html);
                $('#img-list-last').val(lastId);
            }
        })

        $(document).on('click', '.add-item', function () {
            let element = $('#tr-hidden')[0].outerHTML;
            let lastId = $('#product-item').find('tr').last().data('id');
            lastId = parseInt(lastId) + 1;
            element = element.replace(/\idx/g, lastId);
            element = element.replace('id="tr-hidden"', '');
            $('tr').not('#tr-hidden').find('.add-item').remove();
            $('#product-item').append(element);
        })

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

        function _formatNumber(event) {
            let str = event.target.value;
            str = str.replace('.', '').trim();
            if (str == '0') {
                str = '1'
            }
            let value = str.replace(/ |\D/gi, '');
            let format = value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
            event.target.value = format;
        }

        $(document).on('keyup', '.item-price, .item-iprice', function (event) {
            _formatNumber(event);
        })

        $(document).on('click', '.sub-quantity', function () {
            let inputQty = $(this).next();
            let value = parseInt(inputQty.val());
            if (value > 0) {
                inputQty.val(value - 1);
            }
        })

        $(document).on('click', '.plus-quantity', function () {
            let inputQty = $(this).prev();
            let value = parseInt(inputQty.val());
            inputQty.val(value + 1);
        })

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
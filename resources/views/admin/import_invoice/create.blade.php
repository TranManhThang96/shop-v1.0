@extends('admin.layout')
@section('title','Hóa Đơn Nhập')
@section('module','Hóa Đơn Nhập')
@section('method','Thêm mới')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/product/create.css') }}">
@endsection
@section('content')
    <form action="{{route('import-invoice.store')}}" method="post" id="frm" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" id="id">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Nhập sản phẩm</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="sr-only" for="product">Nhập Hàng</label>
                        <div class="input-group">
                            <input type="text" class="typeahead form-control" id="suggest"
                                   placeholder="Quét barcode sản phẩm hoặc nhập gợi ý (tên sp, sku)">
                            <div class="input-group-addon">+</div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-condensed table-responsive">
                        <thead>
                        <tr class="success">
                            <td>SKU</td>
                            <td>Tên Sản Phẩm</td>
                            <td>Màu Sắc</td>
                            <td>Kích Cỡ</td>
                            <td>SL</td>
                            <td>Giá Nhập</td>
                            <td>Thành Tiền</td>
                            <td>Xóa</td>
                        </tr>
                        </thead>
                        <tbody id="product">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

            <div class="panel panel-primary">
                <div class="panel-heading">Thông tin hóa đơn</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="quantity_total">Số sản phẩm </label>
                        <input type="hidden" class="form-control" id="quantity_total" name="quantity_total"
                               value="{{old('quantity_total')}}">
                        @if($errors->has('quantity_total'))
                            <span class="text-danger">
                                {{$errors->first('quantity_total')}}
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="money_total">Tổng tiền </label>
                        <input type="hidden" class="form-control" id="money_total" name="money_total"
                               value="{{old('money_total')}}">
                        @if($errors->has('money_total'))
                            <span class="text-danger">
                                {{$errors->first('money_total')}}
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="created_by">Người tạo </label>
                        <input type="hidden" class="form-control" id="created_by" name="created_by">
                        @if($errors->has('created_by'))
                            <span class="text-danger">
                                {{$errors->first('created_by')}}
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="created_by">Nhà cung cấp </label>
                        <input type="hidden" class="form-control" id="created_by" name="created_by">
                        @if($errors->has('created_by'))
                            <span class="text-danger">
                                {{$errors->first('created_by')}}
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="created_by">Thời gian </label>
                        <input type="hidden" class="form-control" id="created_by" name="created_by">
                        @if($errors->has('created_by'))
                            <span class="text-danger">
                                {{$errors->first('created_by')}}
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="note">Ghi chú </label>
                        <textarea type="text" class="form-control" id="note" name="note" placeholder="Nhập ghi chú"
                                  rows="2"></textarea>
                        @if($errors->has('note'))
                            <span class="text-danger">
                                {{$errors->first('note')}}
                            </span>
                        @endif
                    </div>

                    <div class="text-center">
                        <a class="btn btn-primary" title="Danh sách" href="{{route('import-invoice.index')}}"><i
                                    class="glyphicon glyphicon-share-alt"></i></a>
                        <button type="submit" class="btn btn-success" id="submit-template">Lưu lại</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>

    <div class="hidden">
        <table>
            <tr data-id="idx" id="tr-hidden">
                <td><input type="hidden" class="form-control" name="items[idx][id]"/></td>
                <td><input type="text" class="form-control" name="items[idx][sku]"/></td>
                <td><input type="text" class="form-control item-price" name="items[idx][color]"/></td>
                <td><input type="text" class="form-control item-length" name="items[idx][size]"/></td>
                <td>
                    <div class="input-group">
                        <div class="input-group-addon sub-quantity"> -</div>
                        <input type="text" class="form-control item-quantity" name="items[idx][quantity]" value="0"/>
                        <div class="input-group-addon plus-quantity"> +</div>
                    </div>
                </td>
                <td><input type="text" class="form-control item-height" name="items[idx][iprice]"/></td>
                <td><input type="text" class="form-control item-weight" name="items[idx][money]"/></td>
                <td><input type="text" class="form-control item-color" name="items[idx][color]"/></td>
                <td><input type="text" class="form-control item-size" name="items[idx][size]"/></td>
                <td>
                    <button type="button" class="btn btn-danger remove-item"> -</button>
                    <button type="button" class="btn btn-success add-item"> +</button>
                </td>
            </tr>
        </table>
    </div>

@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script>

        var path = "{{ route('products.autocomplete') }}";
        $('input.typeahead').typeahead({
            source: function (query, process) {
                return $.get(path, {query: query}, function (data) {
                    return process(data);
                });
            },
            updater: function (product) {
                if (product.id != undefined) {
                    $.ajax({
                        url: "{{ route('products.getById') }}",
                        method: "GET",
                        data: {
                            id: product.id,
                        },
                        success: function (data) {
                            _generate(data);
                        }
                    })
                }
            }
        });

        function _generate(data) {
            let tr = '';
            if (data.product_item != undefined) {
                for (let item of data.product_item) {
                    console.log(item);
                    tr += '<tr data-id="' + item.id + '">';
                    tr += '<input type="hidden" class="form-control" name="items[' + item.id + '][id]" value="' + item.id + '"/>';
                    tr += '<td><input type="text" class="form-control" name="items[' + item.id + '][sku]" value="'+item.sku_item+'"/></td>';
                    tr += '<td><input type="text" class="form-control item-price" name="items[' + item.id +'][name]" value="'+ data.name +'"/></td>';
                    tr += '<td><input type="text" class="form-control item-price" name="items['+ item.id +'][color]" value="'+ item.color+'"/></td>';
                    tr += '<td><input type="text" class="form-control item-length" name="items['+ item.id +'][size]" value="'+ item.size+'"/></td>';
                    tr += '<td>';
                    tr += '<div class="input-group">';
                    tr += '<div class="input-group-addon sub-quantity"> - </div>';
                    tr += '<input type="text" class="form-control item-quantity" name="items['+ item.id +'][quantity]" value="0"/>';
                    tr += '<div class="input-group-addon plus-quantity"> + </div></div> </td>';
                    tr += '<td><input type="text" class="form-control item-height" name="items[' + item.id +'][iprice]" value="'+ item.iprice+'"/></td>';
                    tr += '<td><input type="text" class="form-control item-weight" name="items[' + item.id +'][money]" value="0"/></td>';
                    tr += '<td><button type="button" class="btn btn-danger remove-item"> -</button></td> </tr>';
                }
            }
            $('#product').append(tr);
        }

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
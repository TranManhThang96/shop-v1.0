@extends('admin.layout')
@section('title','Đơn Hàng')
@section('module','Đơn Hàng')
@section('method','Thêm mới')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/product/create.css') }}">
@endsection
@section('content')
    <form action="{{route('orders.store')}}" method="post" id="frm" enctype="multipart/form-data">
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
                            <td>Ram</td>
                            <td>Rom</td>
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
                        <span id="quantity_total">0</span>
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
                        <span id="money_total">0</span>
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
                        <label for="created_at">Thời gian </label>
                        <input type="text" class="form-control" data-provide="datepicker" id="created_at" name="created_at" data-date-format="dd/mm/yyyy 00:00:00" placeholder="Mặc định hiện tại ...">
                        @if($errors->has('created_at'))
                            <span class="text-danger">
                                {{$errors->first('created_at')}}
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
                        <a class="btn btn-primary" title="Danh sách" href="{{route('export-invoice.index')}}"><i
                                    class="glyphicon glyphicon-share-alt"></i></a>
                        <button type="submit" class="btn btn-success" id="submit-template">Lưu lại</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>

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
            let arrId = [];
            $('#product').find('tr').each(function (key,tr) {
                arrId.push($(this).data('id'));
            });

            if (data.product_item != undefined) {
                for (let item of data.product_item) {
                    if (!arrId.includes(data.id)) {
                        tr += '<tr data-id="' + item.id + '">';
                        tr += '<input type="hidden" class="form-control" name="items[' + item.id + '][id]" value="' + item.id + '"/>';
                        tr += '<input type="hidden" class="form-control" name="items[' + item.id + '][image]" value="' + data.img_link + '"/>';
                        tr += '<td><input type="text" class="form-control" name="items[' + item.id + '][sku]" value="' + item.sku_item + '" readonly/></td>';
                        tr += '<td><input type="text" class="form-control" name="items[' + item.id + '][name]" value="' + data.name + '" readonly/></td>';
                        tr += '<td><input type="text" class="form-control" name="items[' + item.id + '][color]" value="' + item.color + '" readonly/></td>';
                        tr += '<td><input type="text" class="form-control" name="items[' + item.id + '][size]" value="' + item.size + '" readonly/></td>';
                        tr += '<td><input type="text" class="form-control" name="items[' + item.id + '][ram]" value="' + item.ram + '" readonly/></td>';
                        tr += '<td><input type="text" class="form-control" name="items[' + item.id + '][rom]" value="' + item.rom + '" readonly/></td>';
                        tr += '<td>';
                        tr += '<div class="input-group">';
                        tr += '<div class="input-group-addon sub-quantity"> - </div>';
                        tr += '<input type="text" class="form-control item-quantity" name="items[' + item.id + '][quantity]" value="0"/>';
                        tr += '<div class="input-group-addon plus-quantity"> + </div>';
                        tr += '<input type="hidden" class="form-control limit" value="'+ item.quantity +'"/></div>';
                        tr += '<p>( Chỉ còn '+ item.quantity +' sản phẩm)</p></td>'
                        tr += '<input type="hidden" class="form-control item-iprice" name="items[' + item.id + '][iprice]" value="' + item.iprice + '"/>';
                        tr += '<input type="hidden" class="form-control item-price" name="items[' + item.id + '][price]" value="' + item.price + '"/>';
                        tr += '<td><input type="text" class="form-control item-price_temp" name="items[' + item.id + '][price_temp]" value="' + _formatNumberToMoney(item.price) + '"/></td>';
                        tr += '<td><input type="text" class="form-control item-money" name="items[' + item.id + '][money]" value="0" readonly/></td>';
                        tr += '<td><button type="button" class="btn btn-danger remove-item"> -</button></td> </tr>';
                    }
                }
            }
            $('#product').append(tr);
        }

        //xoa product item
        $(document).on('click', '.remove-item', function () {
            $(this).parent().parent().remove();
            _quantityTotal();
            _moneyTotal();
        })

        //thay doi gia
        $(document).on('keyup', '.item-price_temp', function (event) {
            let str = event.target.value;
            str = str.replace('.', '').trim();
            if (str == '0' || str == '') {
                str = '1'
            }
            let value = str.replace(/ |\D/gi, '');
            $(this).parent().prev().val(value);
            let format = value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
            event.target.value = format;
            _changePriceEvent($(this))
        })

        //giam so luong
        $(document).on('click', '.sub-quantity', function () {
            let inputQty = $(this).next();
            let value = parseInt(inputQty.val());
            if (value > 0) {
                inputQty.val(value - 1);
            }
            _changeQuantityEvent($(this));
        })

        //tang so luong
        $(document).on('click', '.plus-quantity', function () {
            let inputQty = $(this).prev();
            let limit = parseInt($(this).next().val());
            let value = parseInt(inputQty.val());
            if (value < limit) {
                inputQty.val(value + 1);
                _changeQuantityEvent($(this));
            }
        })

        //chuyen so luong
        $(document).on('keyup', '.item-quantity', function () {
            let retValue = 0;
            let limit = parseInt($(this).next().next().val());
            let str = $(this).val();
            if (str !== null) {
                if (str.length > 0) {
                    if (!isNaN(str)) {
                        retValue = parseInt(str);
                    }
                }
            }
            if (retValue > limit) {
                retValue = 0;
            }

            $(this).val(retValue);
            _changeQuantityEvent($(this));

        })

        //thay doi so luong
        function _changeQuantityEvent(_this) {
            let id = _this.parent().parent().parent().data('id');
            let qty = $('[name="items['+ id +'][quantity]"]').val();
            let price = $('[name="items['+ id +'][price]"]').val();
            $('[name="items['+ id +'][money]"]').val(_formatNumberToMoney(qty * price));
            _quantityTotal();
            _moneyTotal();
        }

        //thay doi gia nhap
        function _changePriceEvent(_this) {
            let id = _this.parent().parent().data('id');
            let qty = $('[name="items['+ id +'][quantity]"]').val();
            let price = $('[name="items['+ id +'][price]"]').val();
            $('[name="items['+ id +'][money]"]').val(_formatNumberToMoney(qty * price));
            _quantityTotal();
            _moneyTotal();
        }

        //tinh tong so phan tu
        function _quantityTotal() {
            let total = 0;
            $('#product').find('tr').each(function (key,tr) {
                let id = $(this).data('id');
                total+= parseInt($('[name="items['+ id +'][quantity]"]').val());
            })
            $('#quantity_total').text(total);
            $('[name="quantity_total"]').val(total);
            return total;
        }

        //tinh tong tien
        function _moneyTotal() {
            let total = 0;
            $('#product').find('tr').each(function (key,tr) {
                let id = $(this).data('id');
                let qty = $('[name="items['+ id +'][quantity]"]').val();
                let price = $('[name="items['+ id +'][price]"]').val();
                total += parseInt(qty * price)
            })
            $('#money_total').text(_formatNumberToMoney(total));
            $('[name="money_total"]').val(total);
            return total;
        }

    </script>

@endsection
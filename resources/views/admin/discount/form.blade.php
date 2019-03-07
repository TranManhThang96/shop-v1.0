@extends('admin.layout')
@section('title','Discount')
@section('module','Khuyến mại')
@section('method','Thêm mới')
@section('content')
    <form action="{{route('admin.discount.save')}}" method="post">
        <input type="hidden" name="id" value="{{$model->id}}">
        @csrf
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="name">Tên KM</label>
                <input class="form-control" name="name" id="name" value="{{old('name',$model->name)}}">
            </div>
            <div class="form-group">
                <label for="type_by">Loại KM</label><br/>
                <label class="radio-inline"><input type="radio" name="type_by"
                                                   value="1" {{old('type_by',$model->type_by) == 1 ? 'checked' : ''}}>Sản
                    phẩm</label>
                <label class="radio-inline"><input type="radio" name="type_by"
                                                   value="2" {{old('type_by',$model->type_by) == 2 ? 'checked' : ''}}>Đơn
                    hàng</label>
            </div>

            <div class="form-group">
                <label for="type">Đơn vị</label><br/>
                <label class="radio-inline"><input type="radio" name="type"
                                                   value="1" {{old('type_by',$model->type) == 1 ? 'checked' : ''}}>$</label>
                <label class="radio-inline"><input type="radio" name="type"
                                                   value="2" {{old('type_by',$model->type) == 2 ? 'checked' : ''}}>%</label>
            </div>

            <div class="form-group">
                <label for="discount">KM</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="discount" id="discount"
                           value="{{old('name',$model->discount)}}" placeholder="giảm giá ....">
                    <div class="input-group-addon"><span class="discount">$</span></div>
                </div>
            </div>

            <div class="form-group">
                <label for="limit">Giảm giá tối đa ($)</label>
                <input type="text" class="form-control" name="limit" id="limit" value="{{old('name',$model->limit)}}"
                       placeholder="giảm giá tối đa ($)">
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="start">Thời gian bắt đầu</label>
                <input type="text" data-provide="datepicker" class="form-control" name="start" id="start"
                       data-date-format="dd/mm/yyyy"
                       value="{{old('start',formatDate("d/m/Y",$model->start,"Y-m-d H:i:s"))}}"
                       data-date-autoclose="true">
            </div>

            <div class="form-group">
                <label for="end">Thời gian kết thúc</label>
                <input type="text" data-provide="datepicker" class="form-control" name="end" id="end"
                       data-date-format="dd/mm/yyyy"
                       value="{{old('end',formatDate("d/m/Y",$model->end,"Y-m-d H:i:s"))}}" data-date-autoclose="true">
            </div>

            <div class="form-group">
                <label for="description">Mô tả ngắn:</label>
                <textarea class="form-control" rows="8" id="description" name="description"
                          placeholder="Mô tả ngắn về chương trình khuyến mại">{{old('description',$model->description)}}</textarea>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
            <a href=""></a>
            <button type="submit">Lưu lại</button>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            //goi ham format gia tri limit,discount khi moi khoi tao
            formatLimit();
            formatDiscount();

            $("input[name=type]").on('click', function () {
                if ($(this).is(':checked')) {
                    if ($(this).val() == 1) {
                        $('.discount').text('$')
                    } else {
                        $('.discount').text('%')
                    }
                }
                $('#discount').val('');
            })

            function formatLimit() {
                let limit = $('#limit');
                let str = limit.val();
                if (str != '') {
                    let price = str.replace('.', '').trim();
                    if (price == '0') {
                        price = '1'
                    }
                    let price_value = price.replace(/ |\D/gi, '');
                    let price_format = price_value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
                    limit.val(price_format);
                }
            }

            function formatDiscount() {
                let discount = $('#discount');
                let str = discount.val();
                if (str != '') {
                    if ($("input[name=type]:checked").val() == 1) {
                        let price = str.replace('.', '').trim();
                        if (price == '0') {
                            price = '1'
                        }
                        let price_value = price.replace(/ |\D/gi, '');
                        let price_format = price_value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
                        discount.val(price_format);
                    } else {
                        let val = parseInt(str);
                        if (val == NaN) {
                            discount.val('');
                        } else {
                            if (val > 100 || val < 0)
                                discount.val('');
                        }
                    }
                }
            }

            $('#limit').on('keyup', function ($event) {
                let str = event.target.value;
                let price = str.replace('.', '').trim();
                if (price == '0') {
                    price = '1'
                }
                let price_value = price.replace(/ |\D/gi, '');
                let price_format = price_value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
                event.target.value = price_format;
            })

            $('#discount').on('keyup', function ($event) {
                let str = event.target.value;
                if ($("input[name=type]:checked").val() == 1) {
                    let price = str.replace('.', '').trim();
                    if (price == '0') {
                        price = '1'
                    }
                    let price_value = price.replace(/ |\D/gi, '');
                    let price_format = price_value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
                    event.target.value = price_format;
                } else {
                    let val = parseInt(str);
                    if (val == NaN) {
                        $('#discount').val('');
                    } else {
                        if (val > 100 || val < 0)
                            $('#discount').val('');
                    }
                }
            })
        })
    </script>
@endsection
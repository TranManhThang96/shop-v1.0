@extends('admin.layout')
@section('title','Discount')
@section('module','Khuyến mại')
@section('method','Sửa')
@section('content')
    <form action="{{route('discounts.update',['id' => $discount->id])}}" method="post" id="frm">
        @method('PUT')
        @csrf
        <input type="hidden" name="id" value="{{$discount->id}}">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="name">Tên KM <span class="text-danger"> (*) </span></label>
                <input class="form-control" name="name" id="name" value="{{old('name',$discount->name)}}">
                @if($errors->has('name'))
                    <span class="text-danger">
                        {{$errors->first('name')}}
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="type_by">Loại KM <span class="text-danger"> (*) </span></label><br/>
                <label class="radio-inline"><input type="radio" name="type_by"
                                                   value="1" {{old('type_by',$discount->type_by) == 1 ? 'checked' : ''}}>Sản
                    phẩm</label>
                <label class="radio-inline"><input type="radio" name="type_by"
                                                   value="2" {{old('type_by',$discount->type_by) == 2 ? 'checked' : ''}}>Đơn
                    hàng</label>
            </div>

            <div class="form-group">
                <label for="type">Đơn vị <span class="text-danger"> (*) </span></label><br/>
                <label class="radio-inline"><input type="radio" name="type"
                                                   value="1" {{old('type_by',$discount->type) == 1 ? 'checked' : ''}}>$</label>
                <label class="radio-inline"><input type="radio" name="type"
                                                   value="2" {{old('type_by',$discount->type) == 2 ? 'checked' : ''}}>%</label>
            </div>

            <div class="form-group">
                <label for="discount">Khuyến mại <span class="text-danger"> (*) </span></label>
                <div class="input-group">
                    <input type="text" class="form-control" name="discount" id="discount"
                           value="{{old('discount',$discount->discount)}}" placeholder="giảm giá ....">
                    <div class="input-group-addon"><span class="discount">$</span></div>
                    @if($errors->has('discount'))
                        <span class="text-danger">
                        {{$errors->first('discount')}}
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="limit">Giảm giá tối đa ($)</label>
                <input type="text" class="form-control" name="limit" id="limit" value="{{old('limit',$discount->limit)}}"
                       placeholder="giảm giá tối đa ($)">
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="start">Thời gian bắt đầu <span class="text-danger"> (*) </span></label>
                <input type="text" data-provide="datepicker" class="form-control" name="start" id="start"
                       data-date-format="dd/mm/yyyy"
                       value="{{old('start',formatDate($discount->start,"Y-m-d H:i:s", "d/m/Y"))}}"
                       data-date-autoclose="true">
                @if($errors->has('start'))
                    <span class="text-danger">
                        {{$errors->first('start')}}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="end">Thời gian kết thúc <span class="text-danger"> (*) </span></label>
                <input type="text" data-provide="datepicker" class="form-control" name="end" id="end"
                       data-date-format="dd/mm/yyyy"
                       value="{{old('end',formatDate($discount->end,"Y-m-d H:i:s","d/m/Y"))}}"
                       data-date-autoclose="true">
                @if($errors->has('end'))
                    <span class="text-danger">
                        {{$errors->first('end')}}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="description">Mô tả ngắn:</label>
                <textarea class="form-control" rows="8" id="description" name="description"
                          placeholder="Mô tả ngắn về chương trình khuyến mại">{{old('description',$discount->description)}}</textarea>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
            <a class="btn btn-primary" title="Danh sách" href="{{route('discounts.index')}}"><i
                        class="glyphicon glyphicon-share-alt"></i></a>
            <button type="submit" class="btn btn-success">Lưu lại</button>
        </div>
    </form>
@endsection

@section('script')
    <script src="{{ asset('js/admin/discount/form.js') }}"></script>
@endsection
@extends('admin.layout')
@section('title','Nhà Cung Cấp')
@section('module','Nhà Cung Cấp')
@section('method','Thêm mới')

@section('content')
    <form action="{{route('suppliers.store')}}" method="post" id="frm">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-md-offset-3">
            @csrf
            <div class="form-group">
                <label for="name">Tên NCC <span class="text text-danger"
                                                title="Trường này bắt buộc phải điền"> (*) </span></label>
                <input class="form-control" id="name" name="name" value="{{old('name')}}"
                       placeholder="Vui lòng nhập tên NCC...">

                @if($errors->has('name'))
                    <span class="text-danger">
                        {{$errors->first('name')}}
                    </span>
                @endif

            </div>

            <div class="form-group">
                <label for="phone">SĐT <span class="text text-danger" title="Trường này bắt buộc phải điền"> (*) </span></label>
                <input class="form-control" id="phone" name="phone" value="{{old('phone')}}"
                       placeholder="Vui lòng nhập số điện thoại NCC...">
                @if($errors->has('phone'))
                    <span class="text-danger">
                        {{$errors->first('phone')}}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" id="email" name="email" value="{{old('email')}}"
                       placeholder="Vui lòng nhập email NCC...">
                @if($errors->has('email'))
                    <span class="text-danger">
                        {{$errors->first('email')}}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="address">Địa Chỉ <span class="text text-danger"
                                                   title="Trường này bắt buộc phải điền"> (*) </span></label>
                <textarea class="form-control" rows="5" id="address" name="address"
                          placeholder="Vui lòng nhập địa chỉ NCC ...">{{old('address')}}</textarea>
                @if($errors->has('address'))
                    <span class="text-danger">
                        {{$errors->first('address')}}
                    </span>
                @endif
            </div>

        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
            <a class="btn btn-primary" title="Danh sách" href="{{route('suppliers.index')}}"><i
                        class="glyphicon glyphicon-share-alt"></i></a>
            <button type="submit" class="btn btn-success">Lưu lại</button>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $('#frm').validate({
            rules: {
                name: {
                    required:true,
                    maxlength: 255,
                    remote: {
                        url: "{{route('suppliers.checkExist')}}",
                        type: "post",
                        data: {
                            type: function () {
                                return 'name'
                            },
                            value: function(){
                                return $('#name').val()
                            },
                            _token: function () {
                                return "{{csrf_token()}}"
                            }
                        }
                    }
                },
                phone: {
                    required:true,
                    remote: {
                        url: "{{route('suppliers.checkExist')}}",
                        type: "post",
                        data: {
                            type: function () {
                                return 'phone'
                            },
                            value: function(){
                                return $('#phone').val()
                            },
                            _token: function () {
                                return "{{csrf_token()}}"
                            }
                        }
                    }
                },
                email: {
                    required:false,
                    email:true,
                },
                address: {
                    required:true,
                    maxlength:255
                }
            },
            messages: {
                name: {
                    required: 'Vui lòng nhập tên nhà cung cấp',
                    maxlength: 'Vui lòng nhập không quá 255 ký tự',
                    remote: 'Nhà cung cấp đã tồn tại'
                },
                phone: {
                    required: 'Vui lòng nhập số điện thoại',
                    remote: 'Số điện thoại nhà cung cấp đã tồn tại'
                },
                email: {
                    required: 'Vui lòng nhập email',
                    email: 'Email chưa đúng định dạng'
                },
                address: {
                    required: 'Vui lòng nhập địa chỉ nhà cung cấp',
                    maxlength: 'Vui lòng nhập không quá 255 ký tự'
                }
            }
        });
    </script>
@endsection



@extends('admin.layout')
@section('title','Khách Hàng')
@section('module','Khách hàng')
@section('method','Thêm mới')

@section('content')
    <form action="{{route('customers.store')}}" method="post" id="frm">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            @csrf
            <div class="form-group">
                <label for="name">Tên KH <span class="text-danger"> (*) </span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên KH"
                       value="{{old('name')}}">
                @if($errors->has('name'))
                    <span class="text-danger">{{$errors->first('name')}}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="phone">SĐT <span class="text-danger"> (*) </span></label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập SĐT"
                       value="{{old('phone')}}">
                @if($errors->has('phone'))
                    <span class="text-danger">{{$errors->first('phone')}}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                       value="{{old('email')}}">
                @if($errors->has('email'))
                    <span class="text-danger">{{$errors->first('email')}}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="age">Tuổi</label>
                <input type="text" class="form-control" id="age" name="age" placeholder="Nhập tuổi"
                       value="{{old('age')}}">
                @if($errors->has('age'))
                    <span class="text-danger">{{$errors->first('age')}}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="sex">Giới tính</label>
                <input type="radio" name="sex" value="1" checked>Nam
                <input type="radio" name="sex" value="2">Nữ
            </div>

        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for="province">Tỉnh/Thành Phố <span class="text-danger"> (*) </span></label>
                <select name="province_id" id="province" class="form-control">
                    <option value="0">-Chọn tỉnh/thành phố-</option>
                    @foreach($allProvinces as $province)
                        <option value="{{$province->id}}">{{$province->name}}</option>
                    @endforeach
                </select>
                @if($errors->has('province_id'))
                    <span class="text-danger">{{$errors->first('province_id')}}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="district">Quận/Huyện <span class="text-danger"> (*) </span></label>
                <select name="district_id" id="district" class="form-control">
                    <option value="0">-Chọn quận/huyện-</option>
                </select>
                @if($errors->has('district_id'))
                    <span class="text-danger">{{$errors->first('district_id')}}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="ward">Xã/Phường <span class="text-danger"> (*) </span></label>
                <select name="ward_id" id="ward" class="form-control">
                    <option value="0">-Chọn xã/phường-</option>
                </select>
                @if($errors->has('ward_id'))
                    <span class="text-danger">{{$errors->first('ward_id')}}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="street">Số nhà/thôn xóm <span class="text-danger"> (*) </span></label>
                <input type="text" class="form-control" id="street" name="street" placeholder="Nhập số nhà/thôn xóm"
                       value="{{old('street')}}">
                @if($errors->has('street'))
                    <span class="text-danger">{{$errors->first('street')}}</span>
                @endif
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
            <a class="btn btn-primary" title="Danh sách" href="{{route('customers.index')}}"><i
                        class="glyphicon glyphicon-share-alt"></i></a>
            <button type="submit" class="btn btn-success">Lưu lại</button>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#frm').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 255
                    },
                    phone: {
                        required: true,
                        digits: true,
                        remote: {
                            url: "{{route('customers.checkPhoneExist')}}",
                            type: "post",
                            data: {
                                phone: function () {
                                    return $('#phone').val()
                                },
                                _token: function () {
                                    return "{{csrf_token()}}"
                                }
                            }
                        }
                    },
                    email: {
                        email: true,
                        remote: {
                            url: "{{route('customers.checkEmailExist')}}",
                            type: "post",
                            data: {
                                email: function () {
                                    return $('#email').val()
                                },
                                _token: function () {
                                    return "{{csrf_token()}}"
                                }
                            }
                        }
                    },
                    age: {
                        digits: true
                    },
                    province_id: {
                        min: 1
                    },
                    district_id: {
                        min: 1
                    },
                    ward_id: {
                        min: 1
                    },
                    street: {
                        required: true
                    }

                },
                messages: {
                    name: {
                        required: 'Bắt buộc phải nhập tên',
                        maxlength: 'Tên chỉ chứa 255 ký tự'
                    },
                    phone: {
                        required: 'Bắt buộc nhập số điện thoại',
                        digits: 'Chỉ bao gồm ký tự số',
                        remote: 'SĐT này đã được đăng ký'
                    },
                    email: {
                        email: 'Email chưa đúng định dạng',
                        remote: 'Email này đã được đăng ký'
                    },
                    age: {
                        digits: 'Chỉ bao gồm ký tự số'
                    },
                    province_id: {
                        min: 'Vui lòng chọn tỉnh/thành phố'
                    },
                    district_id: {
                        min: 'Vui lòng chọn quận/huyện'
                    },
                    ward_id: {
                        min: 'Vui lòng chọn xã/phường'
                    },
                    street: {
                        required: 'Bắt buộc nhập số nhà/thôn xóm'
                    }
                }
            })
        })
    </script>
@endsection
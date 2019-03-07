@extends('admin.layout')
@section('title','Khách Hàng')
@section('module','Khách hàng')
@section('method','Thêm mới')

@section('content')
    <form action="{{route('admin.customer.save')}}" method="post" id="frm">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <input type="hidden" name="id" value="{{$model->id}}" id="id">
            @csrf
            <div class="form-group">
                <label for="name">Tên KH</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên KH"
                       value="{{old('name',$model->name)}}">
                @if($errors->has('name'))
                    <span class="text-danger">{{$errors->first('name')}}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="phone">SĐT</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập SĐT"
                       value="{{old('phone',$model->phone)}}">
                @if($errors->has('phone'))
                    <span class="text-danger">{{$errors->first('phone')}}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                       value="{{old('email',$model->email)}}">
                @if($errors->has('email'))
                    <span class="text-danger">{{$errors->first('email')}}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="age">Tuổi</label>
                <input type="text" class="form-control" id="age" name="age" placeholder="Nhập tuổi"
                       value="{{old('age',$model->age)}}">
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
                <label for="province">Tỉnh/Thành Phố</label>
                <select name="province_id" id="province" class="form-control">
                    <option value="0">-Chọn tỉnh/thành phố-</option>
                    @foreach($dataAddress['allProvince'] as $province)
                        <option value="{{$province->id}}" {{(isset($dataAddress['province_id']) && $province->id == $dataAddress['province_id']) ? 'selected':''}}>{{$province->name}}</option>
                    @endforeach
                </select>
                @if($errors->has('province_id'))
                    <span class="text-danger">{{$errors->first('province_id')}}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="district">Quận/Huyện</label>
                <select name="district_id" id="district" class="form-control">
                    <option value="0">-Chọn quận/huyện-</option>
                    @isset($dataAddress['listDistrict'])
                        @foreach($dataAddress['listDistrict'] as $district)
                            <option value="{{$district->id}}" {{$district->id == $dataAddress['district_id'] ? 'selected':''}}>{{$district->name}}</option>
                        @endforeach
                    @endisset
                </select>
                @if($errors->has('district_id'))
                    <span class="text-danger">{{$errors->first('district_id')}}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="ward">Xã/Phường</label>
                <select name="ward_id" id="ward" class="form-control">
                    <option value="0">-Chọn xã/phường-</option>
                    @isset($dataAddress['listWard'])
                        @foreach($dataAddress['listWard'] as $ward)
                            <option value="{{$ward->id}}" {{$ward->id == $dataAddress['ward_id'] ? 'selected':''}}>{{$ward->name}}</option>
                        @endforeach
                    @endisset
                </select>
                @if($errors->has('ward_id'))
                    <span class="text-danger">{{$errors->first('ward_id')}}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="street">Số nhà/thôn xóm</label>
                <input type="text" class="form-control" id="street" name="street" placeholder="Nhập số nhà/thôn xóm"
                       value="{{$model->street}}">
                @if($errors->has('street'))
                    <span class="text-danger">{{$errors->first('street')}}</span>
                @endif
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
            <a class="btn btn-primary" title="Danh sách" href="{{route('admin.customer.list')}}"><i
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
                            url: "{{route('admin.customer.checkPhoneExist')}}",
                            type: "post",
                            data: {
                                phone: function () {
                                    return $('#phone').val()
                                },
                                id: function () {
                                    return $('#id').val()
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
                            url: "{{route('admin.customer.checkEmailExist')}}",
                            type: "post",
                            data: {
                                email: function () {
                                    return $('#email').val()
                                },
                                id: function () {
                                    return $('#id').val()
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
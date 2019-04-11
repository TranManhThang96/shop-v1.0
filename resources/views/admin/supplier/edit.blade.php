@extends('admin.layout')
@section('title','Nhà Cung Cấp')
@section('module','Nhà Cung Cấp')
@section('method','Sửa')

@section('content')
    <form action="{{route('suppliers.update',['id' => $supplier->id])}}" method="post" id="frm">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-md-offset-3">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Tên NCC <span class="text text-danger"
                                                title="Trường này bắt buộc phải điền"> (*) </span></label>
                <input class="form-control" id="name" name="name" value="{{old('name', $supplier->name)}}"
                       placeholder="Vui lòng nhập tên NCC...">

                @if($errors->has('name'))
                    <span class="text-danger">
                        {{$errors->first('name')}}
                    </span>
                @endif

            </div>

            <div class="form-group">
                <label for="phone">SĐT <span class="text text-danger" title="Trường này bắt buộc phải điền"> (*) </span></label>
                <input class="form-control" id="phone" name="phone" value="{{old('phone', $supplier->phone)}}"
                       placeholder="Vui lòng nhập số điện thoại NCC...">
                @if($errors->has('phone'))
                    <span class="text-danger">
                        {{$errors->first('phone')}}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" id="email" name="email" value="{{old('email', $supplier->email)}}"
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
                          placeholder="Vui lòng nhập địa chỉ NCC ...">{{old('address', $supplier->address)}}</textarea>
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
@extends('admin.layout')
@section('title','Thương Hiệu')
@section('module','Thương Hiệu')
@section('method', 'Sửa')

@section('content')
    <form action="{{route('brands.update',['id' => $brand->id])}}" method="post" id="frm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" id="id" value="{{$brand->id}}">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-md-offset-3">
            <div class="form-group">
                <label for="name">Tên thương hiệu</label>
                <input class="form-control" id="name" name="name" value="{{old('name',$brand->name)}}">
            </div>

            <div class="form-group" style="width: 100px; height: 100px">
                <label for="image" class="label-upload">
                    @if ($brand->image)
                        <img src="{{ asset('storage/'.$brand->image) }}" width="100%"/>
                    @else
                        <img src="{{ asset('svg/upload.svg') }}" width="100%"/>
                    @endif
                </label>

                <input id="image" type="file" style="display: none" name="image" value="{{$brand->image}}"/>
            </div>

            <div class="form-group">
                <label for="content">Bài viết</label>
                <textarea name="content">{{old('content',$brand->content)}}</textarea>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
            <a class="btn btn-primary" title="Danh sách" href="{{route('brands.index')}}"><i
                        class="glyphicon glyphicon-share-alt"></i></a>
            <button type="submit" class="btn btn-success">Lưu lại</button>
        </div>
    </form>
@endsection

@section('script')
    <script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
        $('#image').on('change', function (event) {
            $(this).prev().find('img').attr('src', URL.createObjectURL(event.target.files[0]));
        })
        $('#frm').validate({
            rules: {
                name: {
                    required: true,
                    remote: {
                        url: "{{route('brands.checkExist')}}",
                        type: "post",
                        data: {
                            name: function () {
                                return $('#name').val()
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
            },
            messages: {
                name: {
                    required: 'Vui lòng nhập tên thương hiệu',
                    remote: 'Thương hiệu đã tồn tại'
                },

            }
        });
    </script>
@endsection
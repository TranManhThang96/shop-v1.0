@extends('admin.layout')
@section('title','Danh mục')
@section('module','Danh mục')
@section('method','Thêm mới')

@section('content')
    <form action="{{route('categories.store')}}" method="post" id="frm">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-md-offset-3">
            @csrf
            <div class="form-group">
                <label for="category-name">Tên danh mục</label>
                <input type="text" class="form-control" name="name" id="category-name"
                       value="">
                @if($errors)
                    <span class="text-danger">{{$errors->first('name')}}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="category-parent">Danh mục cha</label>
                <select class="form-control category-parent" name="parent_id" id="category-parent">
                    <option value="0">--Không có danh mục cha--</option>
                    {!!showCategories($allCategories,0,'',0)!!}
                </select>

            </div>

            <div class="form-group">
                <label for="category-active">Kích hoạt</label>
                <input type="checkbox" value="1" name="active">
            </div>

            <div class="form-group">
                <label for="category-order">Thứ tự</label>
                <input type="text" class="form-control" name="order" id="category-order" value="0">
                @if($errors)
                    <span class="text-danger">{{$errors->first('order')}}</span>
                @endif
            </div>

        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
            <a class="btn btn-primary" title="Danh sách" href="{{route('categories.index')}}"><i
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
                    required: true,
                    remote: {
                        url: "{{route('categories.checkExist')}}",
                        type: "post",
                        data: {
                            name: function () {
                                return $('#category-name').val()
                            },
                            _token: function () {
                                return "{{csrf_token()}}"
                            }
                        }
                    }
                },
                order: {
                    required: false,
                    number: true,
                    min: 0
                }
            },
            messages: {
                name: {
                    required: 'danh mục không được để trống',
                    remote: 'danh mục đã tồn tại'
                },
                order: {
                    number: 'Yêu cầu điền số',
                    min: 'Giá trị nhỏ nhất là 0'
                }

            }
        })
    </script>
@endsection



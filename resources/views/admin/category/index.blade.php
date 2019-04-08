@extends('admin.layout')
@section('title','Category')
@section('module','Danh Mục')
@section('content')

    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-category"> Thêm mới</button>

    <form class="form-inline" method="get" action="{{route('admin.category.list')}}" id="form-search">
        <div class="col-md-3 pro-col3">
            <div class="form-group">
                <label for="per-page">Show:</label>
                <select class="form-control" name="per" id="per-page">
                    <option value="10" {{app('request')->get('per') == 10 ? 'selected' : ''}}>10</option>
                    <option value="25" {{app('request')->get('per') == 25 ? 'selected' : ''}}>25</option>
                    <option value="50" {{app('request')->get('per') == 50 ? 'selected' : ''}}>50</option>
                    <option value="100" {{app('request')->get('per') == 100 ? 'selected' : ''}}>100</option>
                    <option value="200" {{app('request')->get('per') == 200 ? 'selected' : ''}}>200</option>
                </select>
            </div>
        </div>

        <div class="col-md-9 text-right pro-col9">
            <div class="form-group">
                <label></label>
                <input type="text" class="form-control" id="search" placeholder="Tìm kiếm...."
                       name="search" value="{{ app('request')->get('search') }}">
            </div>
            <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
        </div>

    </form>

    {{--form add category--}}
    <div class="modal fade" id="modal-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Thêm mới</h4>
                </div>
                <form method="post" action="{{route('admin.category.save')}}" id="frm-category">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="id" value="{{$model->id}}">
                        </div>

                        <div class="form-group">
                            <label for="category-name">Tên danh mục</label>
                            <input type="text" class="form-control" name="name" id="category-name"
                                   value="{{$model->name}}">
                            @if($errors)
                                <span class="text-danger">{{$errors->first('name')}}</span>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="category-parent">Danh mục cha</label>
                            <select class="form-control category-parent" name="parent_id" id="category-parent">
                                <option value="0">--Không có danh mục cha--</option>
                                @if(isset($model->parent_id))
                                    {!!showCategories($allCategories,0,'',$model->parent_id)!!}
                                @else
                                    {!!showCategories($allCategories,0,'',0)!!}
                                @endif
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="category-active">Kích hoạt</label>
                            <input type="checkbox" value="1" name="active" {{$model->active == 1 ? 'checked' : ''}}>
                        </div>

                        <div class="form-group">
                            <label for="category-order">Thứ tự</label>
                            <input type="text" class="form-control" placeholder="Mặc định" name="order"
                                   id="category-order" value="{{$model->order}}">
                            @if($errors)
                                <span class="text-danger">{{$errors->first('order')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>STT</th>
            <th>Tên Danh Mục</th>
            <th>Alias</th>
            <th>Danh mục cha</th>
            <th>Trạng Thái</th>
            <th>Thứ tự</th>
            <th>Hành động</th>
        </tr>
        </thead>

        <tbody>
        @foreach($listCategories as $category)
            <tr>
                <td>{{($page - 1) * $limit + $loop->iteration}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->alias}}</td>
                <td>{{getParent('',$category->id,'')}}</td>
                <td class="status-category" data-id="{{$category->id}}">
                    <input type="checkbox" value="{{$category->active}}" {{$category->active == 1 ? 'checked' : ''}}>
                </td>
                <td>
                    {{$category->order}}
                </td>
                <td>
                    <span class="col-md-4 cursor category-edit" data-toggle="modal" data-target="#frm-category"><i
                                class="glyphicon glyphicon-pencil"></i></span>
                    <a class="col-md-offset-2 col-md-4 cursor category-remove"
                       href="{{route('admin.category.remove',$category->id)}}"
                       onclick="return window.confirm('Bạn có chắc chắn muốn xóa?')"> <i
                                class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    <div class="col-md-2">
        <span>Show</span>
        <select class="form-control" class="col-md-1" id="show-record">
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
    </div>
    <div class="text-center">{{ $listCategories->onEachSide(5)->links() }}</div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('.status-category').on('click', function () {
                let id = $(this).data('id');
                let active = 0;
                if ($(this).find('input').is(':checked')) {
                    active = 1;
                } else {
                    active = 0;
                }
                $.ajax({
                    url: "{{route('admin.category.changeStatus')}}",
                    method: 'post',
                    dataType: 'json',
                    data: {
                        id: id,
                        active: active,
                        _token: "{{csrf_token()}}"
                    },
                    success(res) {
                        console.log('danh mục chuyển trạng thái sang ', active)
                    }

                })
            })
            $('#frm-category').validate({
                rules: {
                    name: {
                        required: true,
                        remote: {
                            url: "{{route('admin.category.checkExist')}}",
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
        })
    </script>
@endsection
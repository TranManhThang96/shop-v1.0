@extends('admin.layout')
@section('title','Product')
@section('module','Sản Phẩm')
@section('content')
    <form class="form-inline" method="post" action="{{route('admin.product.list')}}">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" id="keyword-search" placeholder="Tìm kiếm...."
                   name="keyword" value="{{$keyword}}">
        </div>
        <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
        <a href="{{route('admin.product.add')}}" class="btn btn-success">Thêm mới</a>
        </button>
    </form>

@endsection

@section('script')

@endsection
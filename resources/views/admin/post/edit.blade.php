@extends('admin.layout')
@section('title','Bài Viết')
@section('module','Bài Viết')
@section('method','Sửa')

@section('content')
    <form action="{{route('posts.update',['id' => $post->id])}}" method="post" id="frm">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-md-offset-3">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Tiêu đề <span class="text text-danger"
                                                 title="Trường này bắt buộc phải điền"> (*) </span></label>
                <input class="form-control" id="title" name="title" value="{{$post->title}}"
                       placeholder="Vui lòng nhập tiêu đề bài viết">

                @if($errors->has('title'))
                    <span class="text-danger">
                        {{$errors->first('title')}}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="short_description">Mô tả ngắn <span class="text text-danger" title="Trường này bắt buộc phải điền"> (*) </span></label>
                <textarea class="form-control" rows="5" id="short_description" name="short_description"
                          placeholder="Vui lòng nhập mô tả ngắn (dưới 255 ký tự)">{{$post->short_description}}</textarea>
                @if($errors->has('short_description'))
                    <span class="text-danger">
                        {{$errors->first('short_description')}}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="content">Nội dung <span class="text text-danger"
                                                    title="Trường này bắt buộc phải điền"> (*) </span></label>
                <textarea class="form-control" rows="5" id="content" name="content"
                          placeholder="Nội dung bài viết">{!! $post->content!!}</textarea>
                @if($errors->has('content'))
                    <span class="text-danger">
                        {{$errors->first('content')}}
                    </span>
                @endif
            </div>

        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
            <a class="btn btn-primary" title="Danh sách" href="{{route('posts.index')}}"><i
                        class="glyphicon glyphicon-share-alt"></i></a>
            <button type="submit" class="btn btn-success">Lưu lại</button>
        </div>
    </form>
@endsection

@section('script')
    <script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection

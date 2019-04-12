<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\Post\PostRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Nexmo\Response;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = $this->postRepository->getPosts($request->all());
        return view('admin.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        if ($this->postRepository->store($request)) {
            return redirect()->route('posts.index')->with('alert-success', 'Thêm bài viết thành công');
        } else {
            return redirect()->route('posts.index')->with('alert-danger', 'Không thể thêm bài viết');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->postRepository->getPostById($id);
        return view('admin.post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        if ($this->postRepository->update($request,$id)) {
            return redirect()->route('posts.index')->with('alert-success', 'Sửa bài viết thành công');
        } else {
            return redirect()->route('posts.index')->with('alert-danger', 'Không thể sửa bài viết');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->postRepository->destroy($id)) {
            return redirect()->route('posts.index')->with('alert-success', 'Xóa bài viết thành công');
        } else {
            return redirect()->route('posts.index')->with('alert-danger', 'Không thể xóa bài viết');
        }
    }

    /**
     * Check post exist.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkExist(Request $request)
    {
        if ($this->postRepository->checkExist($request->title, $request->postId)) {
            return Response()->json(true);
        } else {
            return Response()->json(false);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Http\Requests\CategoryRequest;
use Nexmo\Response;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = $this->categoryRepository->getCategories($request->all());
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allCategories = $this->categoryRepository->getAllCategories();
        return view('admin.category.create',compact('allCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        if ($this->categoryRepository->store($request)) {
            return Redirect()->route('categories.index')->with('alert-success','Thêm danh mục thành công');
        }

        return Redirect()->route('categories.index')->with('alert-alert','Thêm danh mục không thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $allCategories = $this->categoryRepository->getAllCategories();

        return view('admin.category.edit',compact('allCategories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $allCategories = $this->categoryRepository->getAllCategories($id);
        $category = $this->categoryRepository->getCategoryById($id);
        return view('admin.category.edit',compact('allCategories','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        if ($this->categoryRepository->update($request,$id)) {
            return Redirect()->route('categories.index')->with('alert-success','Cập nhật danh mục thành công');
        }

        return Redirect()->route('categories.index')->with('alert-alert','Cập nhật danh mục không thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->categoryRepository->destroy($id)) {
            return Redirect()->route('categories.index')->with('alert-success','Xóa danh mục thành công');
        }

        return Redirect()->route('categories.index')->with('alert-danger','Không thể xóa danh mục');
    }

    public function checkExist(Request $request)
    {
        if ($this->categoryRepository->checkExist($request->name,$request->categoryId)) {
            return Response()->json(true);
        }
        return Response()->json(false);
    }

    public function changeStatus(Request $request)
    {
        if ($this->categoryRepository->changeStatus($request->id, $request->status)) {
            return Response()->json(true);
        }
        return Response()->json(false);
    }
}

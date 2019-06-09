<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product as ProductResource;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Discount\DiscountRepositoryInterface;
use App\Repositories\ProductItem\ProductItemRepositoryInterface;

class ProductController extends Controller
{

    protected $productRepository;
    protected $categoryRepository;
    protected $brandRepository;
    protected $discountRepository;
    protected $productItemRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        BrandRepositoryInterface $brandRepository,
        DiscountRepositoryInterface $discountRepository,
        ProductItemRepositoryInterface $productItemRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->brandRepository = $brandRepository;
        $this->discountRepository = $discountRepository;
        $this->productItemRepository = $productItemRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $this->productRepository->getProductByRequest($request->all());
        $discounts = $this->discountRepository->getDiscountsAvailable(Discount::TYPE_BY_PRODUCT);
        return view('admin.product.index', compact('products','discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->getAllCategories();
        $brands = $this->brandRepository->getAllBrands();
        $discounts = $this->discountRepository->getDiscountsAvailable(Discount::TYPE_BY_PRODUCT);
        return view('admin.product.create', compact('categories', 'brands', 'discounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->store($request);
            if (!empty($product)) {
                if ($this->productItemRepository->addItem($request->items,$product->id, $product->sku)) {
                    DB::commit();
                    return redirect()->route('products.index')->with('alert-success','Thêm sản phẩm thành công');
                } else {
                    return redirect()->route('products.index')->with('alert-danger','Thêm sản phẩm thất bại');
                }

            } else {
                throw new \Exception('Không thể thêm');
            }

        } catch (Exception $e) {
            return redirect()->route('products.index')->with('alert-danger',$e->getMessage());
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        ProductResource::withoutWrapping();
        return ProductResource::collection($this->productRepository->getAll());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->categoryRepository->getAllCategories();
        $brands = $this->brandRepository->getAllBrands();
        $discounts = $this->discountRepository->getDiscountsAvailable(Discount::TYPE_BY_PRODUCT,$id);
        $product = $this->productRepository->getProductById($id);
        return view('admin.product.edit', compact('product','categories', 'brands', 'discounts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->update($request,$id);
            if (!empty($product)) {
                if ($this->productItemRepository->updateItem($request->items,$product->id, $product->sku)) {
                    DB::commit();
                    return redirect()->route('products.index')->with('alert-success','Cập nhật sản phẩm thành công');
                } else {
                    return redirect()->route('products.index')->with('alert-danger','Cập nhật sản phẩm thất bại');
                }

            } else {
                throw new \Exception('Không thể cập nhật');
            }

        } catch (Exception $e) {
            return redirect()->route('products.index')->with('alert-danger',$e->getMessage());
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->productRepository->destroy($id)) {
            return redirect()->route('products.index')->with('alert-success','Xóa sản phẩm thành công');
        } else {
            return redirect()->route('products.index')->with('alert-danger','Xóa sản phẩm thất bại');
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
        if ($this->productRepository->checkExist($request->name, $request->productId)) {
            return Response()->json(true);
        } else {
            return Response()->json(false);
        }
    }

    public function autocomplete(Request $request)
    {
        $data = $this->productRepository->getProductByQuery($request);
        return response()->json($data);
    }

    public function getProductById(Request $request)
    {
        $data = $this->productRepository->getProductById($request->id);
        return response()->json($data);
    }

    public function getProductItemBySku(Request $request)
    {
        $data = $this->productRepository->getProductItemBySku($request->sku);
        return response()->json($data);
    }
}

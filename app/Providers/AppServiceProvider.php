<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Observers\CategoryObserver;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        if(!app()->runningInConsole() ){
            $shareData = [
                'countCate' => \App\Models\Category::count() ?? 0,
                'countPro' => \App\Models\Product::count() ?? 0,
                'countCustomer' => \App\Models\Customer::count() ?? 0,
                'countDiscount' => \App\Models\Discount::count() ?? 0,
                'countBrand' => \App\Models\Brand::count() ?? 0,
                'countSupplier' => \App\Models\Supplier::count() ?? 0
            ];
            View::share('shareData',$shareData);
        }

        DB::listen(function ($query){
            Log::info('thực thi câu lệnh '.$query->sql. ' mất '.$query->time);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Product\ProductRepositoryInterface::class,
            \App\Repositories\Product\ProductRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Brand\BrandRepositoryInterface::class,
            \App\Repositories\Brand\BrandRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Supplier\SupplierRepositoryInterface::class,
            \App\Repositories\Supplier\SupplierRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Post\PostRepositoryInterface::class,
            \App\Repositories\Post\PostRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Category\CategoryRepositoryInterface::class,
            \App\Repositories\Category\CategoryRepository::class
        );

    }

}

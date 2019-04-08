<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Discount;
use App\Models\Brand;
use App\Observers\CategoryObserver;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        if(!app()->runningInConsole() ){
//            $setting = Cache::rememberForever('website_name', function() {
//                return Setting::where('name', 'website_name')->first();
//            });
//
//            $pages = Cache::rememberForever('pages', function() {
//                return Page::active()->get();
//            });
//            View::share('pages', $pages);
            $countCate = Category::count() ?? 0;
            $countPro  = Product::count() ?? 0;
            $countCustomer = Customer::count() ?? 0;
            $countDiscount = Discount::count() ?? 0;
            $countBrand = Brand::count() ?? 0;
            $shareData = [
                'countCate' => $countCate,
                'countPro' => $countPro,
                'countCustomer' => $countCustomer,
                'countDiscount' => $countDiscount,
                'countBrand' => $countBrand
            ];
            View::share('shareData',$shareData);
        }

        //đăng ký observe trong AppServiceProvider
        Category::observe(CategoryObserver::class);
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
        //
    }

}

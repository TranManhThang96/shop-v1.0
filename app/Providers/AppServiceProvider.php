<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Discount;
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
        $countCate = Category::count();
        $countPro  = Product::count();
        $countCustomer = Customer::count();
        $countDiscount = Discount::count();
        $shareData = [
            'countCate' => $countCate,
            'countPro' => $countPro,
            'countCustomer' => $countCustomer,
            'countDiscount' => $countDiscount
        ];
        View::share('shareData',$shareData);
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

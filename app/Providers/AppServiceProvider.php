<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Composer cho shop header (menu danh mục)
        View::composer([
            'layout.shop.layout',
            'layout.shop.header',
        ], function ($view) {
            // Lấy danh mục cha để hiển thị menu (chỉ danh mục đang bật)
            $shopCategories = Category::where('status', 1)
                                    ->orderBy('category_name')
                                    ->get();
            $view->with('categories', $shopCategories);
        });

        // Nếu có paginate trong shop cũng có thể gọi
        Paginator::useBootstrapFive();
    }
}

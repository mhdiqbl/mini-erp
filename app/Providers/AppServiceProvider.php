<?php

namespace App\Providers;

use App\Repository\Category\CategoryRepository;
use App\Repository\Category\ICategoryRepository;
use App\Repository\Product\IProductRepository;
use App\Repository\Product\ProductRepository;
use App\Services\Category\CategoryService;
use App\Services\Category\ICategoryService;
use App\Services\Product\IProductService;
use App\Services\Product\ProductService;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ICategoryService::class, CategoryService::class);
        $this->app->singleton(ICategoryRepository::class, CategoryRepository::class);
        $this->app->singleton(IProductService::class, ProductService::class);
        $this->app->singleton(IProductRepository::class, ProductRepository::class);
    }

    public function provides()
    {
        return [
            ICategoryService::class,
            ICategoryRepository::class,
            IProductService::class,
            IProductRepository::class,
        ];
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        config(['app.local' => 'id']);
        Carbon::setLocale('id');
    }
}

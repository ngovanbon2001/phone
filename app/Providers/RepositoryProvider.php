<?php

namespace App\Providers;

use App\Repositories\AdminRepository;
use App\Repositories\BannerRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryReponsitory;
use App\Repositories\Contract\TestRepository;
use App\Repositories\Contracts\AdminRepositoryInterface;
use App\Repositories\Contracts\BannerRepositoryInterface;
use App\Repositories\Contracts\BrandRepositoryInterface;
use App\Repositories\Contracts\CategoryReponsitoryInterface;
use App\Repositories\Contracts\ImageRepositoryInterface;
use App\Repositories\Contracts\OrderItemsRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductReponsitoryInterface;
use App\Repositories\Contracts\ReportRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\UserTempRepositoryInterface;
use App\Repositories\ImageRepository;
use App\Repositories\OrderItemsRespository;
use App\Repositories\OrderRespository;
use App\Repositories\ProductReponsitory;
use App\Repositories\ReportRepository;
use App\Repositories\TestRepositoryEloquent;
use App\Repositories\UserRepository;
use App\Repositories\UserTempRepository;
use App\Service\Contract\IExample;
use App\Service\ExampleService;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IExample::class, ExampleService::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BannerRepositoryInterface::class, BannerRepository::class);
        $this->app->bind(BrandRepositoryInterface::class, BrandRepository::class);
        $this->app->bind(ProductReponsitoryInterface::class, ProductReponsitory::class);
        $this->app->bind(CategoryReponsitoryInterface::class, CategoryReponsitory::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRespository::class);
        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);
        $this->app->bind(ReportRepositoryInterface::class, ReportRepository::class);
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(OrderItemsRepositoryInterface::class, OrderItemsRespository::class);
        $this->app->bind(UserTempRepositoryInterface::class, UserTempRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(TestRepository::class, TestRepositoryEloquent::class);
    }
}

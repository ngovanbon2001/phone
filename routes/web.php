<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\Product_imageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Auth\UserTempController;
use App\Http\Controllers\HomeController as HomeControllerFE;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\OrderController as WebOrderController;
use App\Http\Controllers\Web\ProductController as WebProductController;
use App\Models\Province;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('admin/login', [LoginController::class, 'index'])->name('admin.login');
Route::post('admin/login/submit', [LoginController::class, 'login'])->name('admin.login.submit');

Route::prefix('admin')->middleware('isAdmin')->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('homeAdmin');

    //Category
    Route::get('/category', [CategoryController::class, 'index'])->name('showCate');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('addCate');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('addCategory');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('editCate');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('updateCate');
    Route::get('/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('destroyCate');
    Route::get('/category/active', [CategoryController::class, 'active'])->name('activeCategory');

    //product
    Route::get('/product', [ProductController::class, 'index'])->name('indexProduct');
    Route::get('/product/create', [ProductController::class, 'create'])->name('createProduct');
    Route::post('/product/store', [ProductController::class, 'store'])->name('storeProduct');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('editProducts');
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('updateProducts');
    Route::get('/product/destroy/{id}', [ProductController::class, 'destroy'])->name('destroyProducts');
    Route::get('/product/active', [ProductController::class, 'active'])->name('active');
    Route::get('/product/show-by-brand/{id}', [ProductController::class, 'showbyBrand'])->name('showbyBrand');
    Route::get('/product/show-by-category/{id}', [ProductController::class, 'showbyCate'])->name('showbyCate');

    //brands
    Route::get('/brand', [BrandController::class, 'index'])->name('showBrand');
    Route::get('/brand/create', [BrandController::class, 'create'])->name('createBrand');
    Route::post('/brand/store', [BrandController::class, 'store'])->name('storeBrand');
    Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('editBrand');
    Route::post('/brand/update/{id}', [BrandController::class, 'update'])->name('updateBrand');
    Route::get('/brand/destroy/{id}', [BrandController::class, 'destroy'])->name('destroyBrand');
    Route::get('/brand/active', [BrandController::class, 'active'])->name('activeBrand');

    //banners
    Route::get('/banner', [BannerController::class, 'index'])->name('indexBanners');
    Route::get('/banner/create', [BannerController::class, 'create'])->name('createBanners');
    Route::post('/banner/store', [BannerController::class, 'store'])->name('storeBanners');
    Route::get('/banner/edit/{id}', [BannerController::class, 'edit'])->name('editBanners');
    Route::post('/banner/update/{id}', [BannerController::class, 'update'])->name('updateBanners');
    Route::get('/banner/destroy/{id}', [BannerController::class, 'destroy'])->name('destroyBanners');
    Route::get('/banner/active', [BannerController::class, 'active'])->name('activeBanner');

    //image
    Route::get('/image/show/{id}', [Product_imageController::class, 'show'])->name('showImage');
    Route::get('/image/create/{id}', [Product_imageController::class, 'create'])->name('createImage');
    Route::post('/image/store', [Product_imageController::class, 'store'])->name('storeImage');
    Route::get('/image/destroy/{id}/{idp}', [Product_imageController::class, 'destroy'])->name('destroyImage');

    //order
    Route::get('/order', [OrderController::class, 'index'])->name('indexOrder');
    Route::get('/order/show-by-id/{id}', [OrderController::class, 'showbyId'])->name('showbyId');
    Route::post('/order/update/{id}', [OrderController::class, 'update'])->name('updateOrder');
    Route::post('/order/cancel-order/{id}', [OrderController::class, 'cancel'])->name('cancel-order');
    Route::get('/order/export', [OrderController::class, 'export'])->name('exportOrder');

    //user
    Route::get('/user', [UserController::class, 'index'])->name('indexUser');
    Route::get('/user/create', [UserController::class, 'create'])->name('createUser');
    Route::post('/user/store', [UserController::class, 'store'])->name('storeUser');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('editUser');
    Route::post('/user/update/{id}', [UserController::class, 'update'])->name('updateUser');
    Route::get('/user/destroy/{id}', [UserController::class, 'destroy'])->name('destroyUser');
    Route::get('/user/show/{id}', [UserController::class, 'show'])->name('showUser');
    Route::post('/user/update-profile/{id}', [UserController::class, 'updateProfile'])->name('updateProfile');

    Route::get('/report', [ReportController::class, 'index'])->name('indexReport');

    Route::get('/contact', [HomeController::class, 'contact'])->name("contact");
});

Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');

Route::prefix('/')->group(function () {
    Route::get('/', [HomeControllerFE::class, 'index'])->name('web.home');

    Route::get('/product', [WebProductController::class, 'index'])->name('web.product');

    Route::get('/product/detail/{id}', [WebProductController::class, 'show'])->name('web.product.detail');

    Route::post('cart/create', [CartController::class, 'store'])->name('cart.create');

    Route::get('cart/{id}', [CartController::class, 'index'])->name('cart');

    Route::post('cart/update', [CartController::class, 'update'])->name('cart.update');

    Route::post('order/store', [WebOrderController::class, 'store'])->name('order.store');

    Route::get('logout', [AuthLoginController::class, 'logout'])->name('user.logout');

    Route::post('select-delivery', [CartController::class, 'delivery'])->name('select-delivery');

    Route::get('cart/destroy', function () {
        Cart::destroy();
    })->name('cart.destroy');

    Route::post('save-user', [UserTempController::class, 'create'])->name('save-user');

    Route::get('save-user/{id}', [UserTempController::class, 'show'])->name('user.register');
});


Route::get('/test', function () {
    return response()->json(['message' => 'loi'], 404);
});

Route::get('/test2', function () {
    return Province::where('id', '<', 10)->with('districts.wards')->get();
});

Route::get('/test3', function () {
    dd(Redis::get('request_count'));
});

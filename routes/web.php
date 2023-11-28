<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\Product_imageController;
use App\Http\Controllers\Admin\ProductColorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Auth\UserTempController;
use App\Http\Controllers\HomeController as HomeControllerFE;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\OrderController as WebOrderController;
use App\Http\Controllers\Web\ProductController as WebProductController;
use App\Http\Controllers\Web\SocialController;
use App\Http\Controllers\Web\UserController as WebUserController;
use App\Models\Province;
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
    Route::post('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

    //Category
    Route::get('/category', [CategoryController::class, 'index'])->name('showCate');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('addCate');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('addCategory');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('editCate');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('updateCate');
    Route::delete('/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('destroyCate');
    Route::get('/category/active', [CategoryController::class, 'active'])->name('activeCategory');

    //product
    Route::get('/product', [ProductController::class, 'index'])->name('indexProduct');
    Route::get('/product/create', [ProductController::class, 'create'])->name('createProduct');
    Route::post('/product/store', [ProductController::class, 'store'])->name('storeProduct');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('editProducts');
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('updateProducts');
    Route::delete('/product/destroy/{id}', [ProductController::class, 'destroy'])->name('destroyProducts');
    Route::get('/product/active', [ProductController::class, 'active'])->name('active');
    Route::get('/product/show-by-brand/{id}', [ProductController::class, 'showbyBrand'])->name('showbyBrand');
    Route::get('/product/show-by-category/{id}', [ProductController::class, 'showbyCate'])->name('showbyCate');

    //brands
    Route::get('/brand', [BrandController::class, 'index'])->name('showBrand');
    Route::get('/brand/create', [BrandController::class, 'create'])->name('createBrand');
    Route::post('/brand/store', [BrandController::class, 'store'])->name('storeBrand');
    Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('editBrand');
    Route::post('/brand/update/{id}', [BrandController::class, 'update'])->name('updateBrand');
    Route::delete('/brand/destroy/{id}', [BrandController::class, 'destroy'])->name('destroyBrand');
    Route::get('/brand/active', [BrandController::class, 'active'])->name('activeBrand');

    //banners
    Route::get('/banner', [BannerController::class, 'index'])->name('indexBanners');
    Route::get('/banner/create', [BannerController::class, 'create'])->name('createBanners');
    Route::post('/banner/store', [BannerController::class, 'store'])->name('storeBanners');
    Route::get('/banner/edit/{id}', [BannerController::class, 'edit'])->name('editBanners');
    Route::post('/banner/update/{id}', [BannerController::class, 'update'])->name('updateBanners');
    Route::delete('/banner/destroy/{id}', [BannerController::class, 'destroy'])->name('destroyBanners');
    Route::get('/banner/active', [BannerController::class, 'active'])->name('activeBanner');

    //image
    Route::get('/image/show/{id}', [Product_imageController::class, 'show'])->name('showImage');
    Route::get('/image/create/{id}', [Product_imageController::class, 'create'])->name('createImage');
    Route::post('/image/store', [Product_imageController::class, 'store'])->name('storeImage');
    Route::get('/image/destroy/{id}/{idp}', [Product_imageController::class, 'destroy'])->name('destroyImage');

    //color
    Route::post('/version/store', [ProductColorController::class, 'store'])->name('version.store');
    Route::post('/version/update/{id}', [ProductColorController::class, 'update'])->name('version.update');
    Route::get('/version/destroy/{id}', [ProductColorController::class, 'destroy'])->name('version.destroy');

    //order
    Route::get('/order', [OrderController::class, 'index'])->name('indexOrder');
    Route::get('/order/show-by-id/{id}', [OrderController::class, 'showbyId'])->name('showbyId');
    Route::post('/order/update/{id}', [OrderController::class, 'update'])->name('updateOrder');
    Route::post('/order/cancel-order/{id}', [OrderController::class, 'cancel'])->name('cancel-order');
    Route::get('/order/export', [OrderController::class, 'export'])->name('exportOrder');
    Route::delete('order/delete/{id}', [OrderController::class, 'delete'])->name('order.delete');
    Route::get('order/pdf/{id}', [WebOrderController::class, 'exportPdf'])->name('export.pdf');

    //user
    Route::get('/user', [UserController::class, 'index'])->name('indexUser');
    Route::prefix('/user')->middleware('check.admin')->group(function () {
        Route::get('/create', [UserController::class, 'create'])->name('createUser');
        Route::post('/store', [UserController::class, 'store'])->name('storeUser');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('editUser');
        Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('destroyUser');
    });
    Route::post('/user/update/{id}', [UserController::class, 'update'])->name('updateUser');
    Route::get('/user/show/{id}', [UserController::class, 'show'])->name('showUser');
    Route::post('/user/update-profile/{id}', [UserController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/user/change-password/{id}', [UserController::class, 'changePassword'])->name('user.change-password');

    //customer
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.list');
    Route::delete('/customer/destroy/{id}', [CustomerController::class, 'destroy'])->name('customer.delete');

    Route::get('/report', [ReportController::class, 'index'])->name('indexReport');

    Route::get('/contact', [HomeController::class, 'contact'])->name("contact");
});

Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');

Route::prefix('/')->group(function () {
    Route::get('/', [HomeControllerFE::class, 'index'])->name('web.home');

    Route::get('/auth/google',  [SocialController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('/auth/google/callback',  [SocialController::class, 'handleGoogleCallback']);

    // product
    Route::prefix('/product')->middleware('product')->group(function () {
        Route::get('/', [WebProductController::class, 'index'])->name('web.product');

        Route::get('/detail/{id}', [WebProductController::class, 'show'])->name('web.product.detail');
    });

    // cart
    Route::post('cart/create', [CartController::class, 'store'])->name('cart.create');
    Route::get('cart/{id}', [CartController::class, 'index'])->name('cart')->middleware('cart.check_id');
    Route::post('cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('cart/destroy/{id}/{colorId}', [CartController::class, 'delete'])->name('cart.destroy');

    // order
    Route::get('order/create/{id}', [WebOrderController::class, 'create'])->name('order.create')->middleware('cart.check_id');
    Route::post('order/store', [WebOrderController::class, 'store'])->name('order.store');
    Route::get('order/show/{id}', [WebOrderController::class, 'show'])->name('order.show')->middleware('cart.check_id');
    Route::get('order/detail/{id}', [WebOrderController::class, 'detail'])->name('order.detail');
    Route::get('order/pdf/{id}', [WebOrderController::class, 'exportPdf'])->name('order.pdf');
    Route::post('order/cancel/{id}', [WebOrderController::class, 'cancel'])->name('web.order.cancel');
    Route::post('order/hide/{id}', [WebOrderController::class, 'hide'])->name('web.order.delete');
    Route::get('order/build-now/{id}', [WebOrderController::class, 'buildNow'])->name('web.order.build-now');
    Route::post('order/build-now', [WebOrderController::class, 'build'])->name('web.order.build');
    Route::post('select-delivery', [CartController::class, 'delivery'])->name('select-delivery');

    // user
    Route::post('logout', [AuthLoginController::class, 'logout'])->name('user.logout');
    Route::post('save-user', [UserTempController::class, 'create'])->name('save-user');
    Route::get('save-user/{id}', [UserTempController::class, 'show'])->name('user.register');
    Route::get('user/show/{id}', [WebUserController::class, 'edit'])->name('web.user.edit');
    Route::post('user/update/{id}', [WebUserController::class, 'update'])->name('web.user.update');

    // change password
    Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

    // user
    Route::post('save-user', [UserTempController::class, 'create'])->name('save-user');
    Route::get('save-user/{id}', [UserTempController::class, 'show'])->name('user.register');
    Route::get('user/show/{id}', [WebUserController::class, 'edit'])->name('web.user.edit');
    Route::post('user/update/{id}', [WebUserController::class, 'update'])->name('web.user.update');
    Route::post('logout', [AuthLoginController::class, 'logout'])->name('user.logout');
});

Route::get('change-language/{locale}', [LanguageController::class, 'changeLanguage'])->name('change.language');

Route::get('/test', function () {
    return response()->json(['message' => 'loi'], 404);
});

Route::get('/test2', function () {
    return Province::where('id', '<', 10)->with('districts.wards')->get();
});

Route::get('/test3', function () {
    dd(Redis::get('request_count'));
});

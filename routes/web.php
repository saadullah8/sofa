<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ReviewController;
use App\Http\Controllers\admin\SizeController;
use App\Http\Controllers\admin\StuffController;
use App\Http\Controllers\admin\SubCategoryController;
;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\user\CartShowController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\user\LoginController;
use App\Http\Controllers\user\ProductDetailsController;
use App\Http\Controllers\user\ShopController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin_role'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

// sizes
Route::get('admin/size/index', [SizeController::class, 'index'])->name('size.index');
Route::get('admin/size/create', [SizeController::class, 'create'])->name('size.create');
Route::post('admin/size/store', [SizeController::class, 'store'])->name('size.store');
Route::get('admin/size/edit/{id}', [SizeController::class, 'edit'])->name('size.edit');
Route::post('admin/size/update', [SizeController::class, 'update'])->name('size.update');
Route::get('admin/size/destroy/{id}', [SizeController::class, 'destroy'])->name('size.destroy');

// color
Route::get('admin/color/index', [ColorController::class, 'index'])->name('color.index');
Route::get('admin/color/create', [ColorController::class, 'create'])->name('color.create');
Route::post('admin/color/store', [ColorController::class, 'store'])->name('color.store');
Route::get('admin/color/edit/{id}', [ColorController::class, 'edit'])->name('color.edit');
Route::post('admin/color/update', [ColorController::class, 'update'])->name('color.update');
Route::get('admin/color/destroy/{id}', [ColorController::class, 'destroy'])->name('color.destroy');

// stuff
Route::get('admin/stuff/index', [StuffController::class, 'index'])->name('stuff.index');
Route::get('admin/stuff/create', [StuffController::class, 'create'])->name('stuff.create');
Route::post('admin/stuff/store', [StuffController::class, 'store'])->name('stuff.store');
Route::get('admin/stuff/edit/{id}', [StuffController::class, 'edit'])->name('stuff.edit');
Route::post('admin/stuff/update', [StuffController::class, 'update'])->name('stuff.update');
Route::get('admin/stuff/destroy/{id}', [StuffController::class, 'destroy'])->name('stuff.destroy');

// category
Route::get('admin/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::get('admin/category/index', [CategoryController::class, 'index'])->name('category.index');
Route::post('admin/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('admin/category/update', [CategoryController::class, 'update'])->name('category.update');
Route::get('admin/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::get('admin/category/show/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::get('admin/category/subcategory/{id}', [CategoryController::class, 'subcategory'])->name('category.subcategory');

// subcategory
Route::get('admin/subcategory/create', [SubCategoryController::class, 'create'])->name('subcategory.create');
Route::get('admin/subcategory/index', [SubCategoryController::class, 'index'])->name('subcategory.index');
Route::post('admin/subcategory/store', [SubCategoryController::class, 'store'])->name('subcategory.store');
Route::get('admin/subcategory/edit/{id}', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
Route::post('admin/subcategory/update', [SubCategoryController::class, 'update'])->name('subcategory.update');
Route::get('admin/subcategory/destroy/{id}', [SubCategoryController::class, 'destroy'])->name('subcategory.destroy');

// product
Route::get('admin/product/create', [ProductController::class, 'create'])->name('product.create');
Route::get('admin/product/index', [ProductController::class, 'index'])->name('product.index');
Route::post('admin/product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('admin/product/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
Route::get('admin/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('admin/product/update', [ProductController::class, 'update'])->name('product.update');
Route::get('admin/product/detail/{id}', [ProductController::class, 'show'])->name('product.detail');
Route::get('admin/product/imagedelete/{id}', [ProductController::class, 'deleteimage'])->name('product.imagedelete');

// home
Route::get('/', [HomeController::class, 'index'])->name('home');

// shop
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

// contact
Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::get('admin/contact/index', [ContactController::class, 'index'])->name('contact.index');
Route::post('admin/contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::get('admin/contact/destroy/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');
Route::get('admin/contact/details/{id}', [ContactController::class, 'show'])->name('contact.show');

Auth::routes();

Route::get('/productdetails/{id}', [ProductDetailsController::class, 'index'])->name('productdetails');

// review
Route::get('admin/review/index', [ReviewController::class, 'index'])->name('review.index');
Route::get('admin/review/detail/{id}', [ReviewController::class, 'show'])->name('review.show');
Route::post('admin/review/store', [ReviewController::class, 'store'])->name('review.store');
Route::get('admin/review/destroy/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');

// cart
Route::get('cart/add/{product_id}/{qty}', [CartController::class, 'add'])->name('cart.add');
Route::get('cart/quantity/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
Route::get('cart/product/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
Route::get('cart/product/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');

Route::get('user/login', [LoginController::class, 'index'])->name('user.login');

Route::controller(StripePaymentController::class)->group(function () {
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

Route::get('user/cart', [CartShowController::class, 'index'])->name('user.cart');

/*
|--------------------------------------------------------------------------
| Mail Test Routes
|--------------------------------------------------------------------------
*/

Route::get('/preview-email', function () {
    return new WelcomeMail('Saad');
});

Route::get('/send-test-email', function () {
    Mail::to('your_email@example.com')->send(new WelcomeMail('Saad'));
    return 'Email sent successfully';
});

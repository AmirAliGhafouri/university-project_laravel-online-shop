<?php

use App\Http\Controllers\admin\AdminCategoryController;
use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\admin\AdminDeliveryController;
use App\Http\Controllers\admin\AdminProductController;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\productController;
use App\Http\Controllers\userController;
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

Route::get('/',[productController::class,'index'])->name('home');

Route::get('/products/{category}',[productController::class,'products'])->name('products');
Route::get('/groupby/{column}',[productController::class,'group_by'])->name('most');

Route::get('/details/{id}',[productController::class,'details'])->name('product.details');
Route::get('/search-live',[productController::class,'live_search']);
Route::post('/search',[productController::class,'search'])->name('search');

//_______________________________ Only users who are not logged in
Route::group(['middleware'=>'user.error'],function (){
    Route::get('/login',function(){return view('login');})->name('login.view');
    Route::post('/login',[userController::class,'login'])->name('login');
    Route::get('/signin',function(){return view('signin');})->name('register.view');
    Route::post('/signin',[userController::class,'signin'])->name('register');
});

//_______________________________ Logged users
Route::group(['middleware'=>'user.auth'],function (){
    Route::controller(userController::class)->group(function(){
        Route::get('/logout','logout')->name('logout');
        Route::post('/user-edit','edit_user_info')->name('edit.userInfo');
        Route::post('/password-edit','edit_password')->name('edit.password');      
    });
    Route::controller(productController::class)->group(function(){
        Route::get('/addcart/{id}','add_cart')->name('add.cart');
        Route::get('/cartlist','cart_list')->name('cartList');
        Route::get('/cart-remove/{id}','cart_remove')->name('cart.remove');
        Route::get('/order-place','order_place')->name('order.view');
        Route::get('/order-post-cost','order_post_cost');
        Route::post('/order','order')->name('order');
        Route::get('/order-list/{orderCode}','order_list')->name('order.list');
        Route::get('/user-panel','user_panel')->name('user.panel');
        Route::get('/product-rate','rate_products')->name('rate.product');
    });
});

//_______________________________ Admin
Route::group(['prefix'=>'admin','middleware'=>'admin.auth'],function (){
    Route::controller(adminController::class)->group(function(){
        Route::get('/admin-panel','admin_panel')->name('admin.panel');
        Route::post('/add-admin','add_admin')->name('addAdmin');
    });

    Route::controller(AdminCategoryController::class)->group(function(){
        Route::get('/category','category_view')->name('addCategory.view');
        Route::post('/add-category','add_category')->name('addCategory');
        Route::post('/remove-category','remove_category')->name('removeCategory');
    });

    Route::controller(AdminProductController::class)->group(function(){
        Route::get('/product-management','product_management')->name('product.management');
        Route::get('/product-control','product_control');
        Route::get('/edit-product/{id}','edit_product_view')->name('edit.view');
        Route::post('/edit-product/{id}','edit_product')->name('editProduct');
        Route::get('/remove-product/{id}','remove_product')->name('remove.product');
        Route::get('/product-search','search_product');

        Route::get('/add-product','add_product_view')->name('addProduct.view');
        Route::post('/add-product','add_product')->name('addProduct');
    });

    Route::controller(AdminUserController::class)->group(function(){
        Route::get('/users','users')->name('userController.view');
        Route::get('/users-info/{id}','users_info')->name('userInfo.view');
        Route::get('/users-remove/{id}','users_remove')->name('user.remove');
        Route::get('/orders','order_view')->name('orders.view');
    });

    Route::controller(AdminDeliveryController::class)->group(function(){
        Route::get('/delivery','delivery')->name('delivery');
        Route::post('/delivery-update','delivery_update')->name('delivery.cost');
        Route::post('/delivery-add','delivery_add')->name('delivery.add');
        Route::post('/delivery-remove','delivery_remove')->name('delivery.remove');
    });

    // Route::get('/category',function(){return view('admin/add-category');})->name('addCategory.view');
    Route::get('/add-admin',function(){return view('admin/add-admin');})->name('addAdmin.view');

});



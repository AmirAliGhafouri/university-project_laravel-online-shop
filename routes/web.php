<?php

use App\Http\Controllers\productController;
use App\Http\Controllers\userController;
use App\Http\Controllers\adminController;
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
// Route::get('/test',[productController::class,'test'])->name('test');

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
    Route::get('/logout',[userController::class,'logout'])->name('logout');
    Route::get('/addcart/{id}',[productController::class,'add_cart'])->name('add.cart');
    Route::get('/cartlist',[productController::class,'cart_list'])->name('cartList');
    Route::get('/cart-remove/{id}',[productController::class,'cart_remove'])->name('cart.remove');
    Route::get('/order-place',[productController::class,'order_place'])->name('order.view');
    Route::get('/order-post-cost',[productController::class,'order_post_cost']);
    Route::post('/order',[productController::class,'order'])->name('order');
    Route::get('/order-list/{orderCode}',[productController::class,'order_list'])->name('order.list');
    Route::get('/user-panel',[productController::class,'user_panel'])->name('user.panel');
    Route::post('/user-edit',[userController::class,'edit_user_info'])->name('edit.userInfo');
    Route::post('/password-edit',[userController::class,'edit_password'])->name('edit.password');
    Route::get('/product-rate',[productController::class,'rate_products'])->name('rate.product');
});

//_______________________________ Admin
Route::group(['prefix'=>'admin','middleware'=>'admin.auth'],function (){
    Route::get('/admin-panel',[adminController::class,'admin_panel'])->name('admin.panel');
    Route::get('/product-control',[adminController::class,'product_control']);

    Route::get('/add-product',[adminController::class,'add_product_view'])->name('addProduct.view');
    Route::post('/add-product',[adminController::class,'add_product'])->name('addProduct');

    Route::get('/category',function(){return view('admin/add-category');})->name('addCategory.view');
    Route::post('/add-category',[adminController::class,'add_category'])->name('addCategory');

    Route::get('/add-admin',function(){return view('admin/add-admin');})->name('addAdmin.view');
    Route::post('/add-admin',[adminController::class,'add_admin'])->name('addAdmin');// ?????

    Route::get('/delivery',[adminController::class,'delivery'])->name('delivery');
    Route::post('/delivery-cost',[adminController::class,'delivery_cost'])->name('delivery.cost');

    Route::get('/users',[adminController::class,'users'])->name('userController.view');

    Route::get('/product-management',[adminController::class,'product_management'])->name('product.management');

});



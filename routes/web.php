<?php

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
Route::get('/welcome', function () {return view('welcome');});


Route::get('/admin', function () {return view('login');})->name('login')->middleware('checkLogout');

Route::post('/login','App\Http\Controllers\usersController@login');
Route::get('/logout','App\Http\Controllers\usersController@logout');

// Quên mật khẩu
Route::post('/reset-password','App\Http\Controllers\usersController@resetPass');
Route::get('/reset-password/{id}/{token}','App\Http\Controllers\usersController@getViewReset');
Route::post('/forget-password','App\Http\Controllers\usersController@reset_password');

Route::group(['middleware' => 'checkLogin'], function (){
    Route::group(['middleware' => 'checkRole'], function () {

        Route::group(['middleware' => 'checkAdmin'], function () {
//    Users
            Route::get('/admin/users', 'App\Http\Controllers\usersController@getView');
            Route::get('/admin/users/getData', 'App\Http\Controllers\usersController@getData');
            Route::put('/admin/users', 'App\Http\Controllers\usersController@insert');
            Route::delete('/admin/users', 'App\Http\Controllers\usersController@delete');
            Route::post('/admin/users', 'App\Http\Controllers\usersController@update');

//    Check user
            Route::post('/admin/users/check-username', 'App\Http\Controllers\usersController@checkUsername');
            Route::post('/admin/users/check-username-update', 'App\Http\Controllers\usersController@checkUsername_update');
        });

//        Thông tin user
        Route::get('/admin/users/{id}/profile', 'App\Http\Controllers\profileController@getView');
        Route::post('/admin/users/{id}/profile','App\Http\Controllers\profileController@update');


//        Thông tin tất cả user
        Route::get('/admin/users/details', function (){

            $count = \App\Models\User::all()->count();

            $users = \App\Models\User::all();

            return view('admin.details',['count'=>$count,'users'=>$users]);
        })->name('details');


//        Thực đơn
        Route::get('/admin/products', 'App\Http\Controllers\productController@getView');
        Route::post('/admin/products/insert', 'App\Http\Controllers\productController@insert');
        Route::delete('/admin/products/delete', 'App\Http\Controllers\productController@delete');
        Route::get('/admin/products/get-all', 'App\Http\Controllers\productController@getProductAll');
        Route::get('/admin/products/get-of-category', 'App\Http\Controllers\productController@getProductOfCategory');
        Route::get('/admin/products/get-of-category-page', 'App\Http\Controllers\productController@getProductOfCategoryPage');
        Route::get('/admin/products/get-of-category-filter-all', 'App\Http\Controllers\productController@getProductFilterAll');
        Route::get('/admin/products/get-of-category-filter-category', 'App\Http\Controllers\productController@getProductFilterCategory');

//        Thông tin sản phẩm
        Route::get('/admin/products/{id_product}', 'App\Http\Controllers\productController@getViewDetail');
        Route::post('/admin/products/{id_product}/update', 'App\Http\Controllers\productController@update');
        Route::post('/admin/products/{id_product}/update-image','App\Http\Controllers\productController@updateImage');
        Route::post('/admin/products/update-image-subs','App\Http\Controllers\imagesController@update');
        Route::post('/admin/products/{id_product}/insert-image-sub', 'App\Http\Controllers\imagesController@insert');
        Route::delete('/admin/products/delete-image-sub', 'App\Http\Controllers\imagesController@delete');
        Route::get('/admin/products/{id_product}/list-image', 'App\Http\Controllers\productController@getListImage');





//        Danh mục
        Route::get('/admin/categorys', 'App\Http\Controllers\categoryParentController@getView');
//        Danh mục cha
        Route::get('/admin/categorys/data-parent', 'App\Http\Controllers\categoryParentController@getData');
        Route::get('/admin/categorys/data-parent-insert', 'App\Http\Controllers\categoryParentController@getSelectInsert');
        Route::put('/admin/categorys/insert-parent', 'App\Http\Controllers\categoryParentController@insert');
        Route::delete('/admin/categorys/delete-parent', 'App\Http\Controllers\categoryParentController@delete');
        Route::post('/admin/categorys/update-parent', 'App\Http\Controllers\categoryParentController@update');
//        Danh mục con
        Route::get('/admin/categorys/data', 'App\Http\Controllers\categoryController@getData');
        Route::get('/admin/categorys/product-image', 'App\Http\Controllers\categoryController@getImageProduct');
        Route::get('/admin/categorys/data-filter', 'App\Http\Controllers\categoryController@getDataFilter');
        Route::put('/admin/categorys/insert', 'App\Http\Controllers\categoryController@insert');
        Route::delete('/admin/categorys/delete', 'App\Http\Controllers\categoryController@delete');
        Route::post('/admin/categorys/update', 'App\Http\Controllers\categoryController@update');



//        Thanh toán
        Route::get('/admin/transaction', 'App\Http\Controllers\transactionController@getView');
        Route::get('/admin/transaction/get-data', 'App\Http\Controllers\transactionController@getData');
        Route::get('/admin/transaction/get-modal', 'App\Http\Controllers\transactionController@getModal');
        Route::post('/admin/transaction/cancel', 'App\Http\Controllers\transactionController@cancel');
        Route::delete('/admin/transaction/delete', 'App\Http\Controllers\transactionController@delete');


    });

    Route::get('/admin/transaction/{id_user}/get-history-filter', 'App\Http\Controllers\transactionController@getHistoryFilter');
    Route::get('/admin/transaction/{id_user}/get-history', 'App\Http\Controllers\transactionController@getHistory');



    //User
    Route::get('/profile/{id}','App\Http\Controllers\pageController@getViewProfile');
    Route::get('/get-cart-user','App\Http\Controllers\pageController@getQuantityCart');
    Route::post('/changepass-user','App\Http\Controllers\usersController@changePassWord');
    Route::post('/get-pass-user','App\Http\Controllers\usersController@getPassWord');


    //Giỏ hàng
    Route::get('/giohang/{id_user}','App\Http\Controllers\pageController@getViewCart');
    Route::post('/add-cart-user','App\Http\Controllers\orderController@insert');
    Route::post('/update-cart-user','App\Http\Controllers\orderController@updateQuantity');
    Route::delete('/delete-cart-user','App\Http\Controllers\orderController@delete');
    Route::get('/get-amount/{id_user}','App\Http\Controllers\orderController@getAmount');

    //Đơn hàng
    Route::post('/transaction/{id_user}','App\Http\Controllers\transactionController@insert');


    //Booktable
    Route::post('/book-table','App\Http\Controllers\bookTableController@insert');


//    Verify
    Route::post('/verify-email/{id_user}','App\Http\Controllers\usersController@verify');
    Route::get('/verify-email/{id}/{token}','App\Http\Controllers\usersController@active');


});

Route::get('/', 'App\Http\Controllers\pageController@getView')->name('home');

//Contact
Route::put('/send-contact','App\Http\Controllers\contactController@insert');

//Đăng nhập đăng ký user
Route::post('/regis-user','App\Http\Controllers\usersController@regis');
Route::post('/login-user','App\Http\Controllers\usersController@userLogin');

//Thông tin sản phẩm
Route::get('/thongtinsanpham/{id_product}', 'App\Http\Controllers\pageController@getViewProduct');
Route::get('/thongtinsanpham/get-comment/{id_product}', 'App\Http\Controllers\pageController@getBoxComment');
Route::post('/comment/{id_product}/insert', 'App\Http\Controllers\commentController@insert');

//Menu
Route::get('/thucdon', 'App\Http\Controllers\pageController@getViewMenuProduct');
Route::get('/thucdon/all', 'App\Http\Controllers\pageController@getDataMenuAll');
Route::get('/thucdon/filter', 'App\Http\Controllers\pageController@getDataMenuFilter');

//Tuyển dụng
Route::get('/tuyendung', function (){ return view('user.recruitment');})->name('recruitment');




Route::get('/test-nhan', function (){ return view('emails.verify_email');});


Route::get('test', function () {
    event(new App\Events\myEvent('12scas'));
    return "Event has been sent!";
});




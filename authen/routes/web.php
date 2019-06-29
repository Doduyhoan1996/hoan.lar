<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Route cho administrator
 */
Route::prefix('admin')->group(function (){
    //gom nhóm các route cho phần admin

    //URL authen.com/admin/
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    /*
     * URL: authen.com/admin/dashboard
     * Route đăng nhập thành công
     */
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');

    /*
     * URL: authen.com/admin/register
     * Route trả về form đăng ký
     */
    Route::get('register', 'AdminController@create')->name('admin.register');
    /*
     * URL: authen.com/admin/register
     * Phương thức POST
     * Route dùng để đăng ký 1 admin từ form POST
     */
    Route::post('register', 'AdminController@store')->name('admin.register.store');

    /**
     * Route trả về khi  đăng nhâp Admin
     */

    Route::get('login', 'Auth\Admin\LoginController@login')->name('admin.auth.login');

    /**
     * Route xử lý quá trình  đăng nhâp Admin
     */
    Route::post('login', 'Auth\Admin\LoginController@loginAdmin')->name('admin.auth.loginAdmin');

    /**
     * Route xử lý quá trình  đăng xuất Admin
     */
    Route::post('logout', 'Auth\Admin\LoginController@logout')->name('admin.auth.logout');

    Route::get('shop/category', function (){
        return view('admin.content');
    });

});

/**
 * Route cho các nhà cung cấp sản phẩm (seller)
 */
Route::prefix('seller')->group(function (){
    //gom nhóm các route cho phần seller

    //URL authen.com/seller/
    Route::get('/', 'SellerController@index')->name('seller.dashboard');
    /*
     * URL: authen.com/seller/dashboard
     * Route đăng nhập thành công
     */
    Route::get('/dashboard', 'SellerController@index')->name('seller.dashboard');


    /*
    * URL: authen.com/seller/register
    * Route trả về form đăng ký
    */
    Route::get('register', 'SellerController@create')->name('seller.register');
    /*
     * URL: authen.com/seller/register
     * Phương thức POST
     * Route dùng để đăng ký 1 admin từ form POST
     */
    Route::post('register', 'SellerController@store')->name('seller.register.store');

    /**
     * Route trả về khi  đăng nhâp seller
     */

    Route::get('login', 'Auth\seller\LoginController@login')->name('seller.auth.login');

    /**
     * Route xử lý quá trình  đăng nhâp seller
     */
    Route::post('login', 'Auth\seller\LoginController@loginSeller')->name('seller.auth.loginAdmin');

    /**
     * Route xử lý quá trình  đăng xuất seller
     */
    Route::post('logout', 'Auth\seller\LoginController@logout')->name('seller.auth.logout');

});

/**
 * Route cho các nhà vận chuyển (shipper)
 */
Route::prefix('shipper')->group(function (){
    //gom nhóm các route cho phần seller

    //URL authen.com/seller/
    Route::get('/', 'ShipperController@index')->name('shipper.dashboard');
    /*
     * URL: authen.com/seller/dashboard
     * Route đăng nhập thành công
     */
    Route::get('/dashboard', 'ShipperController@index')->name('shipper.dashboard');


    /*
    * URL: authen.com/seller/register
    * Route trả về form đăng ký
    */
    Route::get('register', 'ShipperController@create')->name('shipper.register');
    /*
     * URL: authen.com/seller/register
     * Phương thức POST
     * Route dùng để đăng ký 1 admin từ form POST
     */
    Route::post('register', 'ShipperController@store')->name('shipper.register.store');

    /**
     * Route trả về khi  đăng nhâp shipper
     */

    Route::get('login', 'Auth\shipper\LoginController@login')->name('shipper.auth.login');

    /**
     * Route xử lý quá trình  đăng nhâp shipper
     */
    Route::post('login', 'Auth\shipper\LoginController@loginShipper')->name('shipper.auth.loginAdmin');

    /**
     * Route xử lý quá trình  đăng xuất shipper
     */
    Route::post('logout', 'Auth\shipper\LoginController@logout')->name('shipper.auth.logout');

});

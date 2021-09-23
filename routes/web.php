<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

// ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//
// Xac Thuc Email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
// Xac Thuc Email

Route::get('/login', [
    'as' => 'login',
    'uses' => 'App\Http\Controllers\Auth\AuthenticatedSessionController@create',
]);
// QUAN LY SHOP
Route::prefix('/')->group(function () {
    Route::get('/firstpage', [
        'as' => 'firstpage',
        'uses' => 'App\Http\Controllers\admin\shop\firstpageController@thongtinshop',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/capnhatthongtinshop', [
        'as' => 'capnhatthongtinshop',
        'uses' => 'App\Http\Controllers\admin\shop\firstpageController@capnhatthongtinshop',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/suathongtinshop', [
        'as' => 'suathongtinshop',
        'uses' => 'App\Http\Controllers\admin\shop\firstpageController@suathongtinshop',
        'middleware' => (['auth', 'verified'])
    ]);
});
// QUAN LY SHOP

// QUAN LY DANH MUC
Route::prefix('/')->group(function () {
    Route::get('/quanlydanhmuc', [
        'as' => 'quanlydanhmuc',
        'uses' => 'App\Http\Controllers\admin\danhmuc\quanlydanhmucController@quanlydanhmuc',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/adddanhmuc', [
        'as' => 'adddanhmuc',
        'uses' => 'App\Http\Controllers\admin\danhmuc\quanlydanhmucController@adddanhmuc',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/editdanhmuc', [
        'as' => 'editdanhmuc',
        'uses' => 'App\Http\Controllers\admin\danhmuc\quanlydanhmucController@editdanhmuc',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/hiddendanhmuc', [
        'as' => 'hiddendanhmuc',
        'uses' => 'App\Http\Controllers\admin\danhmuc\quanlydanhmucController@hiddendanhmuc',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/showdanhmuc', [
        'as' => 'showdanhmuc',
        'uses' => 'App\Http\Controllers\admin\danhmuc\quanlydanhmucController@showdanhmuc',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/deletedanhmuc', [
        'as' => 'deletedanhmuc',
        'uses' => 'App\Http\Controllers\admin\danhmuc\quanlydanhmucController@deletedanhmuc',
        'middleware' => (['auth', 'verified'])
    ]);
});
// QUAN LY DANH MUC

//QUAN LY SAN PHAM
Route::prefix('/')->group(function () {
    Route::get('/quanlysanpham', [
        'as' => 'quanlysanpham',
        'uses' => 'App\Http\Controllers\admin\sanpham\quanlysanphamController@quanlysanpham',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/addsanpham', [
        'as' => 'addsanpham',
        'uses' => 'App\Http\Controllers\admin\sanpham\quanlysanphamController@addsanpham',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::get('/editsanpham', [
        'as' => 'editsanpham',
        'uses' => 'App\Http\Controllers\admin\sanpham\quanlysanphamController@editsanpham',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::get('/deletedulieuvideo/{idvideo}', [
        'as' => 'deletedulieuvideo',
        'uses' => 'App\Http\Controllers\admin\sanpham\quanlysanphamController@deletedulieuvideo',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::get('/deletedulieuhinhanh/{idhinhanh}', [
        'as' => 'deletedulieuhinhanh',
        'uses' => 'App\Http\Controllers\admin\sanpham\quanlysanphamController@deletedulieuhinhanh',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/doeditsanpham', [
        'as' => 'doeditsanpham',
        'uses' => 'App\Http\Controllers\admin\sanpham\quanlysanphamController@doeditsanpham',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/deletesanpham', [
        'as' => 'deletesanpham',
        'uses' => 'App\Http\Controllers\admin\sanpham\quanlysanphamController@deletesanpham',
        'middleware' => (['auth', 'verified'])
    ]);
});
//QUAN LY SAN PHAM

// QUAN LY NHAP HANG
Route::prefix('/')->group(function () {
    Route::get('/quanlynhaphang', [
        'as' => 'quanlynhaphang',
        'uses' => 'App\Http\Controllers\admin\nhaphang\quanlynhaphangController@quanlynhaphang',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/addhang', [
        'as' => 'addhang',
        'uses' => 'App\Http\Controllers\admin\nhaphang\quanlynhaphangController@addhang',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/deletehang', [
        'as' => 'deletehang',
        'uses' => 'App\Http\Controllers\admin\nhaphang\quanlynhaphangController@deletehang',
        'middleware' => (['auth', 'verified'])
    ]);
});
// QUAN LY NHAPHANG

// QUAN LY KHO HANG
Route::prefix('/')->group(function () {
    Route::get('/quanlykhohang', [
        'as' => 'quanlykhohang',
        'uses' => 'App\Http\Controllers\admin\khohang\quanlykhohangController@quanlykhohang',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/addkhohang', [
        'as' => 'addkhohang',
        'uses' => 'App\Http\Controllers\admin\khohang\quanlykhohangController@addkhohang',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/deletekhohang', [
        'as' => 'deletekhohang',
        'uses' => 'App\Http\Controllers\admin\khohang\quanlykhohangController@deletekhohang',
        'middleware' => (['auth', 'verified'])
    ]);
});
// QUAN LY KHO HANG

// QUAN LY DON HANG
Route::prefix('/')->group(function () {
    Route::get('/quanlydonhang', [
        'as' => 'quanlydonhang',
        'uses' => 'App\Http\Controllers\admin\donhang\quanlydonhangController@quanlydonhang',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/checkdonggoi', [
        'as' => 'checkdonggoi',
        'uses' => 'App\Http\Controllers\admin\donhang\quanlydonhangController@checkdonggoi',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/checkgiaohang', [
        'as' => 'checkgiaohang',
        'uses' => 'App\Http\Controllers\admin\donhang\quanlydonhangController@checkgiaohang',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/checkhoanthanh', [
        'as' => 'checkhoanthanh',
        'uses' => 'App\Http\Controllers\admin\donhang\quanlydonhangController@checkhoanthanh',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/checkhuydon', [
        'as' => 'checkhuydon',
        'uses' => 'App\Http\Controllers\admin\donhang\quanlydonhangController@checkhuydon',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/donhangloi', [
        'as' => 'donhangloi',
        'uses' => 'App\Http\Controllers\admin\donhang\quanlydonhangController@donhangloi',
        'middleware' => (['auth', 'verified'])
    ]);
});
// QUAN LY DON HANG
// ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//



Route::get('/', [
    'as' => 'index',
    'uses' => 'App\Http\Controllers\frontend\indexController@index',
]);
// FRONTEND//FRONTEND//FRONTEND//FRONTEND//FRONTEND//FRONTEND//FRONTEND//FRONTEND//FRONTEND//FRONTEND//FRONTEND//FRONTEND//FRONTEND//
Route::prefix('/')->group(function () {
    Route::get('/loginkhachhang', [
        'as' => 'loginkhachhang',
        'uses' => 'App\Http\Controllers\frontend\indexController@loginkhachhang',
    ]);
    Route::get('/registerkhachhang', [
        'as' => 'registerkhachhang',
        'uses' => 'App\Http\Controllers\frontend\indexController@registerkhachhang',
    ]);
    Route::get('/editkhachhang/{idkhachhang}', [
        'as' => 'editkhachhang',
        'uses' => 'App\Http\Controllers\frontend\indexController@editkhachhang',
    ]);
    Route::get('/dangxuatkhachhang', [
        'as' => 'dangxuatkhachhang',
        'uses' => 'App\Http\Controllers\frontend\indexController@dangxuatkhachhang',
    ]);
    Route::post('/dologinkhachhang', [
        'as' => 'dologinkhachhang',
        'uses' => 'App\Http\Controllers\frontend\indexController@dologinkhachhang',
    ]);
    Route::post('/doregisterkhachhang', [
        'as' => 'doregisterkhachhang',
        'uses' => 'App\Http\Controllers\frontend\indexController@doregisterkhachhang',
    ]);
    Route::post('/doeditkhachhang', [
        'as' => 'doeditkhachhang',
        'uses' => 'App\Http\Controllers\frontend\indexController@doeditkhachhang',
    ]);
    //////////////////////////////////////////////////////////////////////////////////
    Route::get('/sanphamdanhmuc/{iddanhmuc}', [
        'as' => 'sanphamdanhmuc',
        'uses' => 'App\Http\Controllers\frontend\indexController@sanphamdanhmuc',
    ]);
    Route::get('/chitietsanpham/{idsanpham}', [
        'as' => 'chitietsanpham',
        'uses' => 'App\Http\Controllers\frontend\indexController@chitietsanpham',
    ]);
    ///////////////////////////////////////////////////////////////////////////////////
    Route::get('/giohang', [
        'as' => 'giohang',
        'uses' => 'App\Http\Controllers\frontend\indexController@giohang',
    ]);
    Route::post('/muangay', [
        'as' => 'muangay',
        'uses' => 'App\Http\Controllers\frontend\indexController@muangay',
    ]);
    Route::post('/domuangay', [
        'as' => 'domuangay',
        'uses' => 'App\Http\Controllers\frontend\indexController@domuangay',
    ]);
    Route::post('/themvaogiohang', [
        'as' => 'themvaogiohang',
        'uses' => 'App\Http\Controllers\frontend\indexController@themvaogiohang',
    ]);
    Route::post('/capnhatgiohang', [
        'as' => 'capnhatgiohang',
        'uses' => 'App\Http\Controllers\frontend\indexController@capnhatgiohang',
    ]);
    Route::post('/deletegiohang', [
        'as' => 'deletegiohang',
        'uses' => 'App\Http\Controllers\frontend\indexController@deletegiohang',
    ]);
    Route::post('/dathang', [
        'as' => 'dathang',
        'uses' => 'App\Http\Controllers\frontend\indexController@dathang',
    ]);
    Route::post('/huydonhang', [
        'as' => 'huydonhang',
        'uses' => 'App\Http\Controllers\frontend\indexController@huydonhang',
    ]);
});
// FRONTEND//FRONTEND//FRONTEND//FRONTEND//FRONTEND//FRONTEND//FRONTEND//FRONTEND//FRONTEND//FRONTEND//FRONTEND//FRONTEND//FRONTEND//
require __DIR__ . '/auth.php';

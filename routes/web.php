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

Route::get('/', [
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

// QUAN LY LINH VUC
Route::prefix('/')->group(function () {
    Route::get('/quanlylinhvuc', [
        'as' => 'quanlylinhvuc',
        'uses' => 'App\Http\Controllers\admin\linhvuc\quanlylinhvucController@quanlylinhvuc',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/addlinhvuc', [
        'as' => 'addlinhvuc',
        'uses' => 'App\Http\Controllers\admin\linhvuc\quanlylinhvucController@addlinhvuc',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/editlinhvuc', [
        'as' => 'editlinhvuc',
        'uses' => 'App\Http\Controllers\admin\linhvuc\quanlylinhvucController@editlinhvuc',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::get('/hiddenlinhvuc/{idlinhvuc}', [
        'as' => 'hiddenlinhvuc',
        'uses' => 'App\Http\Controllers\admin\linhvuc\quanlylinhvucController@hiddenlinhvuc',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::get('/showlinhvuc/{idlinhvuc}', [
        'as' => 'showlinhvuc',
        'uses' => 'App\Http\Controllers\admin\linhvuc\quanlylinhvucController@showlinhvuc',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::get('/deletelinhvuc/{idlinhvuc}', [
        'as' => 'deletelinhvuc',
        'uses' => 'App\Http\Controllers\admin\linhvuc\quanlylinhvucController@deletelinhvuc',
        'middleware' => (['auth', 'verified'])
    ]);
});
// QUAN LY LINH VUC

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
});
//QUAN LY SAN PHAM
require __DIR__ . '/auth.php';

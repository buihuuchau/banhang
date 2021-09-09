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
    Route::get('/capnhatthongtinshop', [
        'as' => 'capnhatthongtinshop',
        'uses' => 'App\Http\Controllers\admin\shop\firstpageController@capnhatthongtinshop',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/capnhat2thongtinshop', [
        'as' => 'capnhat2thongtinshop',
        'uses' => 'App\Http\Controllers\admin\shop\firstpageController@capnhat2thongtinshop',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::get('/suathongtinshop', [
        'as' => 'suathongtinshop',
        'uses' => 'App\Http\Controllers\admin\shop\firstpageController@suathongtinshop',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::get('/sua2thongtinshop', [
        'as' => 'sua2thongtinshop',
        'uses' => 'App\Http\Controllers\admin\shop\firstpageController@sua2thongtinshop',
        'middleware' => (['auth', 'verified'])
    ]);
});
// QUAN LY SHOP
require __DIR__ . '/auth.php';

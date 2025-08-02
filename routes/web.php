<?php


use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Laravel\Telescope\Telescope;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//test
Route::get('/test', function () {
    return view('test');
});
Route::group(
    ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localize']], // يمكن أن يكون middleware مختلف حسب إعداداتك
    function () {
        Route::get('/', function () {
            if (!Auth::guard('admin')->check()) {
                return redirect()->route('admin.login');
            }  elseif (Auth::guard('admin')->check()) {
                return redirect()->route('admin.dashboard');
            }
        });

    }
);



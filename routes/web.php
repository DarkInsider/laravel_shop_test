<?php

use App\Http\Controllers\BasketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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
Route::get('/', [MainController::class,'index'])->name('index');

Auth::routes(
    [
        'reset' => false,
        'confirm' => false,
        'verify' => false
    ]
);

Route::group([
    'middleware'=>'is_admin'
],function (){
    Route::get('/orders', [App\Http\Controllers\Admin\OrdersController::class, 'index'])->name('orders');
});




Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('get-logout');


Route::get('/categories', [MainController::class,'categories'])->name('categories');
Route::group([
    'middleware'=>'basket_not_empty',
    'prefix'=>'basket'
],function (){
    Route::get('/', [BasketController::class,'basket'])->name('basket');
    Route::get('/place', [BasketController::class,'basketPlace'])->name('basket-place');
    Route::post('/place', [BasketController::class,'basketConfirm'])->name('basket-confirm');
    Route::post('/remove/{id}', [BasketController::class,'basketRemove'])->name('basket-remove');
});

Route::post('basket/add/{id}', [BasketController::class,'basketAdd'])->name('basket-add');
Route::get('/{category}', [MainController::class,'category'])->name('category');
Route::get('/{category}/{product?}', [MainController::class,'product'])->name('product');






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

    use App\Http\Controllers\Front\HomeController;
    use App\Http\Controllers\Front\ProdukController;
    use App\Http\Controllers\Front\AboutController;
    use App\Http\Controllers\Front\ContactController;
    use App\Http\Controllers\Front\CartController;

    Route::get('/clear', function() {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('config:cache');
        Artisan::call('view:clear');
        return "Cleared!";
    });

    Route::get('',[HomeController::class,'index'])->name('front.home');
    Route::get('produk/{id}',[ProdukController::class,'detail'])->name('front.home');
    Route::get('about',[AboutController::class,'index'])->name('front.about');
    Route::get('contact',[ContactController::class,'index'])->name('front.contact');

    
    Route::post('cart/post-data',[CartController::class,'postData'])->name('front.cart.postData');
    Route::get('cart/get-province',[CartController::class,'getProvince'])->name('front.cart.getProvince');
    Route::get('cart/get-city',[CartController::class,'getCity'])->name('front.cart.getCity');
    Route::get('cart/get-subdistrict-name',[CartController::class,'getSubdistrictName'])->name('front.cart.getSubdistrictName');
    Route::get('cart/jenis-pengiriman',[CartController::class,'getJenisPengiriman'])->name('front.cart.getJenisPengiriman');
    Route::get('cart/data',[CartController::class,'data'])->name('front.cart.data');
    Route::put('cart/update-jumlah',[CartController::class,'updateJumlah'])->name('front.cart.updateJumlah');
    Route::delete('cart/delete',[CartController::class,'delete'])->name('front.cart.delete');



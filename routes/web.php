<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdSenseController;

Route::get('/', function () {
    return view('welcome');
});




Route::get('/adsense', [AdSenseController::class, 'index'])->name('adsense.index');
Route::get('/adsense/callback', [AdSenseController::class, 'callback'])->name('adsense.callback');


Route::get('/clear-cache', function () {
    // Cache temizleme komutları
    Artisan::call('cache:clear');
    Artisan::call('config:clear');

    return 'Cache, config ve optimize işlemleri başarıyla temizlendi!';
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdSenseController;

Route::get('/', function () {
    return view('welcome');
});




Route::get('/adsense', [AdSenseController::class, 'index'])->name('adsense.index');
Route::get('/adsense/callback', [AdSenseController::class, 'callback'])->name('adsense.callback');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoryController as HI;
use App\Http\Controllers\MoneyController as MO;
use App\Http\Controllers\LikeController as LK;
use App\Http\Controllers\FrontController as FR;


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

// Route::get('/', function () {
//     return view('front\index');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/ai-route', 'App\Http\Controllers\AiController@sendRequest');

Route::prefix('history')->name('history-')->group(function() {
    Route::get('/', [HI::class, 'index'])->name('index');
    Route::get('/edit/{history}', [HI::class, 'edit'])->name('edit');
    Route::delete('/delete/{history}', [HI::class, 'destroy'])->name('delete');
    // Route::post('/create', [HI::class, 'store'])->name('store');    
    // Route::put('/edit/{client}', [HI::class, 'update'])->name('update');
});

Route::prefix('money')->name('money-')->group(function() {
    Route::post('/create/{history}', [MO::class, 'create'])->name('create');
    // Route::get('/create', [HI::class, 'create'])->name('create');
    // Route::post('/create', [HI::class, 'store'])->name('store');    
    // Route::get('/edit/{client}', [HI::class, 'edit'])->name('edit');
    // Route::put('/edit/{client}', [HI::class, 'update'])->name('update');
    // Route::delete('/delete/{client}', [HI::class, 'destroy'])->name('delete');
});

Route::prefix('like')->name('like-')->group(function() {
    Route::post('/create', [LK::class, 'create'])->name('create');
    // Route::get('/create', [HI::class, 'create'])->name('create');
    // Route::post('/create', [HI::class, 'store'])->name('store');    
    // Route::get('/edit/{client}', [HI::class, 'edit'])->name('edit');
    // Route::put('/edit/{client}', [HI::class, 'update'])->name('update');
    // Route::delete('/delete/{client}', [HI::class, 'destroy'])->name('delete');
});

Route::prefix('front')->name('front-')->group(function() {
    Route::get('/', [FR::class, 'index'])->name('index');
    Route::get('/create', [FR::class, 'create'])->name('create');
    Route::get('/edit/{history}', [FR::class, 'edit'])->name('edit');
    Route::put('/update/{history}', [FR::class, 'update'])->name('update');
    Route::get('/delete-photo', [FR::class, 'destroyPhoto'])->name('delete-photo');
    // Route::get('/create', [HI::class, 'create'])->name('create');
    // Route::post('/create', [HI::class, 'store'])->name('store');    
    // Route::get('/edit/{client}', [HI::class, 'edit'])->name('edit');
    // Route::put('/edit/{client}', [HI::class, 'update'])->name('update');
    // Route::delete('/delete/{client}', [HI::class, 'destroy'])->name('delete');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoryController as HI;
use App\Http\Controllers\MoneyController as MO;


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

Route::get('/', function () {
    // return view('back.history.index');
    return redirect()->route('history-index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/ai-route', 'App\Http\Controllers\AiController@sendRequest');

Route::prefix('history')->name('history-')->group(function() {
    Route::get('/', [HI::class, 'index'])->name('index');
    // Route::get('/create', [HI::class, 'create'])->name('create');
    // Route::post('/create', [HI::class, 'store'])->name('store');    
    // Route::get('/edit/{client}', [HI::class, 'edit'])->name('edit');
    // Route::put('/edit/{client}', [HI::class, 'update'])->name('update');
    // Route::delete('/delete/{client}', [HI::class, 'destroy'])->name('delete');
});

Route::prefix('money')->name('money-')->group(function() {
    Route::put('/create/{history}', [MO::class, 'create'])->name('create');
    // Route::get('/create', [HI::class, 'create'])->name('create');
    // Route::post('/create', [HI::class, 'store'])->name('store');    
    // Route::get('/edit/{client}', [HI::class, 'edit'])->name('edit');
    // Route::put('/edit/{client}', [HI::class, 'update'])->name('update');
    // Route::delete('/delete/{client}', [HI::class, 'destroy'])->name('delete');
});

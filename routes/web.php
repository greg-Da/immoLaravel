<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('login', [AuthController::class, 'login'])->middleware('guest')->name('login');
Route::post('login', [AuthController::class, 'doLogin']);
Route::delete('login', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::prefix('biens')->name('property.')->group(function () {
    Route::get('/', [PropertyController::class, 'index'])->name('index');
    Route::get('/{slug}-{property}', [PropertyController::class, 'show'])->name('show')->where([
        'property' => '[0-9]+',
        'slug' => '[0-9a-z\-]+'
    ]);
    Route::post('/{property}/contact', [PropertyController::class, 'contact'])->name('contact');
});


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::redirect('/', '/admin/property');
    Route::get('/property', [PropertyController::class, 'indexAdmin'])->name('property.index');
    Route::resource('property', PropertyController::class)->except(['index']);
    Route::resource('option', OptionController::class)->except(['show']);
    Route::resource('city', CityController::class)->except(['show']);

    Route::delete('picture/{picture}', [PictureController::class, 'destroy'])->name('picture.destroy')->where([
        'picture' => '[0-9]+'
    ]);
});

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AdminController;

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

Route::get('/', [NewsController::class, "index"]);

Route::group(['prefix' => 'administration', 'as' => 'administration.'], function() {

    Route::get('/change', [AdminController::class, "newsForChange"])
        ->name("change");
    Route::get('/upload', [AdminController::class, "upload"])
       ->name("upload");
    Route::get('/login', [AdminController::class, "login"])
        ->name("login");
    Route::get('/delete/{id}', [AdminController::class, "destroy"])
        ->name("delete");
    Route::resource('/', AdminController::class, ['parameters' => [
        '' => 'id'
    ]]);
});


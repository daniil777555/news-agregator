<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAuthenticate;
use App\Http\Middleware\CheckStatus;
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

Route::middleware([IsAuthenticate::class])->group(function () { //Unforchunetly, but this only one case when it works

    Route::get('/login', [AdminController::class, "loginPage"])
        ->middleware('guest')
        ->withoutMiddleware([IsAuthenticate::class])
        ->name("administration.login");
    
    Route::post('/login', [AdminController::class, "login"])
        ->name("administration.login")
        ->withoutMiddleware([IsAuthenticate::class]); 

    Route::group(['prefix' => 'administration', 'as' => 'administration.'], function() {

        Route::get('/change', [AdminController::class, "newsForChange"])
            ->name("change");
    
        Route::get('/addURL', [AdminController::class, "addLinkForParserPage"])
           ->name("addURL");

        Route::get('/logs', [AdminController::class, "showLogs"])
            ->name("logs");
    
        Route::get("/logout", [AdminController::class, "logout"])
            ->name("logout");
    
        Route::get('/delImg/{elId}/{imgId}', [AdminController::class, "deleteImg"])
            ->name("del-img");

        Route::post('/addingLink', [AdminController::class, "storeLinkForParser"])
            ->name("addingLink");

        Route::get('/parse', [AdminController::class, "startParse"])
            ->name("startParsing");
    
        Route::resource('/', AdminController::class, ['parameters' => [
            '' => 'id'
        ]])->middleware(CheckStatus::class);
    });

});



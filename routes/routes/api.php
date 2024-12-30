<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
/*Route::post('project/hello', [\App\Http\Controllers\AdminController::class,'SayHello']);
Route::post('admin/store', [\App\Http\Controllers\AdminController::class,'store']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::get('article/{article:id}/show',[\App\Http\Controllers\ArticleController::class,'show']);
Route::get('article/list',[\App\Http\Controllers\ArticleController::class,'showlist']);
Route::post('article/store',[\App\Http\Controllers\ArticleController::class,'StoreArticle']);
Route::put('article/{article}/update' , [\App\Http\Controllers\ArticleController::class,'update']);
Route::delete('article/{article}/delete', [\App\Http\Controllers\ArticleController::class,'delete']);
Route::post('transportation/store',[\App\Http\Controllers\TransportationController::class,'StoreTransportation']);
Route::get('transportation/{transportation}/show',[\App\Http\Controllers\TransportationController::class,'show']);
Route::middleware('auth:sanctum')->group( function () {


});

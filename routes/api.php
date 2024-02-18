<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sig_LogController;
use App\Http\Controllers\productController;
use App\Http\Controllers\user_getsion;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//routes for api admin
Route::post('/signup', [Sig_LogController::class, 'Signup']);
Route::post('/login', [Sig_LogController::class, 'Login']);
Route::post('/add', [productController::class, 'add']);
Route::get('/products', [productController::class, 'get_products']);
Route::get('/show/{product_id?}', [productController::class, 'show']);
Route::post('/edit', [productController::class, 'edit']);
Route::get('/search/{serach_val?}', [productController::class, 'search']);
Route::delete('/delete/{product_id?}', [productController::class, 'delete']);
Route::put('/uupdat/{id?}', [productController::class,'uupdat']);
//routes for api user
Route::get('/u_products',[user_getsion::class, 'products']);
Route::get('/show_product/{id?}',[user_getsion::class, 'show_product']);
Route::get('/serach_val/{s_val?}', [user_getsion::class, 'u_search']);
Route::post('/addCard', [user_getsion::class,'add_card']);
Route::get('/get_user_card/{id?}',[user_getsion::class,'getUsercrad']);
Route::delete('/delete_card/{id?}',[user_getsion::class,'deleteCard']);
Route::post('/update_card_qtt',[user_getsion::class,'updateInCard']);
Route::get('/cards', [user_getsion::class,'cards']);
Route::get('/orders',[user_getsion::class,'orders']);
Route::post('/add_orders',[user_getsion::class,'addOrders']);

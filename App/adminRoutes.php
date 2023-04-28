<?php

use Core\Router as Route;

use App\Controller\SliderController;

use App\Controller\BlogController;
use App\Controller\ContactController;

Route::get('admin/slider', [SliderController::class,'index']);
Route::post('admin/slider', [SliderController::class,'store']);


Route::get('admin/blog', [BlogController::class,'index']);
Route::get('admin/blog/create', [BlogController::class,'create']);
Route::get('admin/blog/{id}', [BlogController::class,'edit']);
Route::get('admin/contact',[ContactController::class,'tableContact']);
Route::post('admin/contact-delete/{id}',[ContactController::class,'delete']);


Route::post('admin/blog', [BlogController::class,'store']);
Route::post('admin/blog/{id}', [BlogController::class,'update']);
Route::post('admin/blog-delete/{id}', [BlogController::class,'delete']);
Route::get('/blog',[BlogController::class,'getBlog']);



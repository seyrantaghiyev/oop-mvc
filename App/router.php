<?php

use App\Controller\HomeController;
use Core\Router as Route;
use App\Controller\ContactController;
use Core\FileService;

Route::get('/', [HomeController::class,'index']);
Route::get('/blog/{slug}', [HomeController::class,'blogDetail']);
Route::get('/contact', [ContactController::class,'getContact']);
Route::post('/contact', [ContactController::class,'postContact']);

//Route::get('/contact', [HomeController::class,'getContact']);
//Route::post('/contact', [HomeController::class,'postContact']);


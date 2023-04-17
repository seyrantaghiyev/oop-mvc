<?php

use Core\Router as Route;
use App\Controller\SliderController;
use App\Controller\CategoryController;

Route::get('category/{name}',[CategoryController::class,'detail']);


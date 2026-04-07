<?php

use App\Http\Controllers\RobotsController;
use Illuminate\Support\Facades\Route;

Route::get('/robots.txt', RobotsController::class);

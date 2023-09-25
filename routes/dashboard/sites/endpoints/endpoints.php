<?php

use App\Http\Controllers\Endpoint\EndpointController;
use Illuminate\Support\Facades\Route;

Route::resource('endpoints', EndpointController::class);

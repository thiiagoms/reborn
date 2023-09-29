<?php

use App\Http\Controllers\Endpoint\EndpointController;
use Illuminate\Support\Facades\Route;

// Route::prefix('{site:uuid}')->name('endpoints')->group(function () {
//     // Route::get('', [EndpointController::class, 'index'])->name('index');
// });

Route::resource('endpoints', EndpointController::class);

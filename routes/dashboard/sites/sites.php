<?php

use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Route;

Route::resource('sites' , SiteController::class)->except(['index' , 'show']);

Route::prefix('{site:uuid')->group(function () {

    include __DIR__ . '/endpoints/endpoints.php';
});

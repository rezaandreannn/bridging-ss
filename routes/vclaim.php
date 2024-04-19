<?php

use App\Http\Controllers\Vclaim\TestController;
use Illuminate\Support\Facades\Route;

Route::get('diag/', [TestController::class, 'getDiagnosa']);

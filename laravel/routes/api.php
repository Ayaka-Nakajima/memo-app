<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MemoController;

Route::post('/memos', [MemoController::class, 'store']);
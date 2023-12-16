<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

$options = [
    'only' => [
        'show',
        'index',
        'store',
        'update',
        'destroy'
    ]
];

Route::get("/");

Route::resource('users', \App\Http\Controllers\api\v1\UserController::class, $options);
Route::resource('records', \App\Http\Controllers\api\v1\RecordController::class, $options);
Route::resource('users.options', \App\Http\Controllers\api\v1\OptionController::class, $options);

Route::post("/login", [\App\Http\Controllers\api\v1\AuthController::class, 'login']);
Route::get('/refresh', [\App\Http\Controllers\api\v1\AuthController::class, 'refresh_token']);
Route::middleware('jwt_auth')->get('/me', [\App\Http\Controllers\api\v1\AuthController::class, 'me']);

Route::middleware('jwt_auth')->get("/secure", function () {
    return "Success!";
});

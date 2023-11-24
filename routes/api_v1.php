<?php

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

Route::resources([
    'users' => \App\Http\Controllers\api\v1\UserController::class,
    'roles' => ''
], $options);

Route::post("/login", [\App\Http\Controllers\api\v1\AuthController::class, 'login']);
Route::get('/refresh', [\App\Http\Controllers\api\v1\AuthController::class, 'refresh_token']);

Route::middleware('jwt_auth')->get("/secure", function () {
    return "Success!";
});

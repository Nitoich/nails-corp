<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\Auth\LoginRequest;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $fields = $request->validated();
        $user = User::query()
            ->where('phone', $fields['phone'])
            ->first();

        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'error' => [
                    'code' => 401,
                    'message' => 'Incorrect phone or password!'
                ]
            ])->setStatusCode(401);
        }

        $session = Session::query()->create([
            'user_id' => $user->id,
            'token' => Str::random(128),
            'expire_date' => new \DateTime('now +1month')
        ]);

        if(!$session) {
            return response()->json([
                'error' => [
                    'code' => 500,
                    'message' => 'Session dont create. Server ERROR 500'
                ]
            ])->setStatusCode(500);
        }

        return response()->json([
            'data' => [
                'access_token' => $session->access_token(),
                'refresh_token' => $session->token
            ]
        ])->setStatusCode(201);
    }

    public function refresh_token(Request $request): JsonResponse
    {
        $token = $request->refresh_token ?? $request->cookie('refresh_token');
        if(!$token) {
            return response()->json([
                'error' => [
                    'code' => 401,
                    'message' => "Field 'refresh_token' is required!"
                ]
            ])->setStatusCode(401);
        }

        $session = Session::query()->where('token', $token)->first();
        if(!$session) {
            return response()->json([
                'error' => [
                    'code' => 404,
                    'message' => "Session not found!"
                ]
            ])->setStatusCode(404);
        }

        $session->update([
            'token' => Str::random(128),
            'expire_date' => new \DateTime("now +1month")
        ]);

        return response()->json([
            'data' => [
                'access_token' => $session->access_token(),
                'refresh_token' => $session->token
            ]
        ])->setStatusCode(200);
    }
}

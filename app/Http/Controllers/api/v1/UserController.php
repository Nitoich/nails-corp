<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\User\CreateUserRequest;
use App\Http\Requests\api\v1\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return User::pagResponse(UserResource::class);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json([
            'data' => $user
        ])->setStatusCode(200);
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        $user = User::query()->create($request->validated());
        return response()->json([
            'data' => $user
        ])->setStatusCode(201);
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $user->update($request->validated());
        return response()->json([
            'data' => $user
        ])->setStatusCode(200);
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->json([
            'data' => $user
        ])->setStatusCode(200);
    }
}

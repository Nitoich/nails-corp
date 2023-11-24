<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\User\CreateUserRequest;
use App\Http\Requests\api\v1\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $page = $request->page ?? 1;
        $page_size = $request->page_size ?? 10;

        $builder = User::query();

        $total_users = $builder->count();
        return response()->json([
            'page' => $page,
            'page_size' => $page_size,
            'total_pages' => ceil($total_users / $page_size),
            'total_items' => $total_users,
            'data' => $builder->get()
        ])->setStatusCode(200);
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

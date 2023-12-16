<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\Option\CreateOptionRequest;
use App\Http\Requests\api\v1\Option\UpdateOptionRequest;
use App\Models\Option;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt_auth');
    }

    public function store(CreateOptionRequest $request): JsonResponse
    {
        $user = Auth::user();
        $option = Option::query()->create(array_merge($request->validated(), ["user_id" => $user->id]));
        return response()->json([
            'data' => $option
        ])->setStatusCode(201);
    }

    public function show(Option $option): JsonResponse
    {
        if($option->user_id !== Auth::user()->id) {
            return response()->json([
                'error' => [
                    'code' => 403,
                    'message' => 'Forbidden!'
                ]
            ])->setStatusCode(403);
        }
        return response()->json([
            'data' => $option
        ])->setStatusCode(200);
    }

    public function index(Request $request): JsonResponse
    {
        $options = Option::query()->where('user_id', Auth::user()->id)->get();
        return response()->json([
            'data' => $options
        ])->setStatusCode(200);
    }

    public function update(UpdateOptionRequest $request, Option $option): JsonResponse
    {
        $option->update($request->validated());
        return response()->json([
            'data' => $option
        ])->setStatusCode(200);
    }

    public function destroy(Option $option): JsonResponse
    {
        $option->delete();
        return response()->json([
            'data' => $option
        ])->setStatusCode(200);
    }
}

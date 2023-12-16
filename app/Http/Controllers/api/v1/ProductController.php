<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\Product\CreateProductRequest;
use App\Http\Requests\api\v1\Product\UpdateProductRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $page = $request->page ?? 1;
        $page_size = $request->page_size ?? 10;
        $builder = Product::query();
        $total_count = $builder->count();
        $products = $builder->skip(($page - 1) * $page_size)->take($page_size);
        return response()->json([
            'page' => $page,
            'page_size' => $page_size,
            'total_pages' => ceil($total_count / $page_size),
            'total_items' => $total_count,
            'data' => $products
        ])->setStatusCode(200);
    }

    public function store(CreateProductRequest $request): JsonResponse
    {
        return response()->json([
            'data' => Product::query()->create($request->validated())
        ])->setStatusCode(201);
    }

    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        return response()->json([
            'data' => $product->update($request->validated())
        ])->setStatusCode(200);
    }

    public function show(Product $product): JsonResponse
    {
        return response()->json([
            'data' => $product
        ])->setStatusCode(200);
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return response()->json([
            'data' => $product
        ])->setStatusCode(200);
    }
}

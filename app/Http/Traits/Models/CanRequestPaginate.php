<?php

namespace App\Http\Traits\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

trait CanRequestPaginate
{
    public function scopePagResponse(Builder $builder, ?string $resource = null): JsonResponse {
        return response()->json($this->scopePagJson($builder, $resource))->setStatusCode(200);
    }

    public function scopePagJson(Builder $builder, ?string $resource = null): array
    {
        $request = app()->make(Request::class);
        $page = $request->page ?? 1;
        $page_size = $request->page_size ?? 10;
        $total_count = $builder->count();
        $builder = $builder->skip(($page - 1) * $page_size)->take($page_size);
        return [
            'page' => $page,
            'page_size' => $page_size,
            'total_page' => ceil($total_count / $page_size),
            'total_items' => $total_count,
            'data' => !empty($resource) ? $resource::collection($builder->get()) : $builder->get()
        ];
    }
}

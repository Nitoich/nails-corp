<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Record;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index(): JsonResponse
    {
        return Record::pagResponse();
    }

    public function show(Record $record): JsonResponse
    {
        return response()->json([
            'data' => $record
        ])->setStatusCode(200);
    }

    public function store(): JsonResponse
    {
        return response()->json();
    }
}

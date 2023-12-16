<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\Record\CreateRecordRequest;
use App\Http\Requests\api\v1\Record\UpdateRecordRequest;
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

    public function store(CreateRecordRequest $request): JsonResponse
    {
        $fields = $request->validated();
        $record = Record::query()->create($fields);
        return response()->json([
            'data' => $record
        ])->setStatusCode(201);
    }

    public function update(UpdateRecordRequest $request, Record $record): JsonResponse
    {
        $fields = $request->validated();
        $record->update($fields);
        return response()->json([
            'data' => $record
        ])->setStatusCode(200);
    }

    public function destroy(Record $record): JsonResponse
    {
        $record->delete();
        return response()->json([
            'data' => $record
        ])->setStatusCode(200);
    }
}

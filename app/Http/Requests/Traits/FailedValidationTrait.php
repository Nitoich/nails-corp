<?php

namespace App\Http\Requests\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait FailedValidationTrait
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => [
                'code' => 419,
                'message' => "Failed Validation",
                'errors' => $validator->errors()
            ]
        ])->setStatusCode(419));
    }
}

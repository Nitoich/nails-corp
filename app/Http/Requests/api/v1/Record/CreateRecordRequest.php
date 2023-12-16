<?php

namespace App\Http\Requests\api\v1\Record;

use App\Http\Requests\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class CreateRecordRequest extends FormRequest
{
    use FailedValidationTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => 'required|integer',
            'product_id' => 'required|integer',
            'date'
        ];
    }
}

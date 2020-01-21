<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssigneeUpdateRequest extends FormRequest
{
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
     * @return array
     */
    public function rules()
    {
        return [
            'due'            => 'sometimes|nullable|date_format:Y-m-d H:i:s',
            'defer'          => 'sometimes|nullable|date_format:Y-m-d H:i:s',
            'difficulty'     => 'sometimes|nullable|between:-10,10',
            'estimated_time' => 'sometimes|nullable|integer',
            'blocker'        => 'sometimes|nullable|boolean',
        ];
    }
}

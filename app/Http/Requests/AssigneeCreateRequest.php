<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssigneeCreateRequest extends FormRequest
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
            'user_id'        => 'required|uuid|exists:App\Models\User,id|assigned:user_id,task_id',
            'task_id'        => 'required|uuid|exists:App\Models\Task,id',
            'due'            => 'sometimes|nullable|date_format:Y-m-d H:i:s',
            'defer'          => 'sometimes|nullable|date_format:Y-m-d H:i:s',
            'difficulty'     => 'sometimes|nullable|between:-10,10',
            'estimated_time' => 'sometimes|nullable|integer',
            'blocker'        => 'boolean',
        ];
    }
}

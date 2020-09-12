<?php

namespace App\Http\Requests;

use App\Interfaces\TaskServiceInterface;
use App\Models\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskStatusRequest extends FormRequest
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
     * @param TaskServiceInterface $service
     * @return array
     */
    public function rules(TaskServiceInterface $service)
    {
        $task_id = $this->route('task');
        $task = $service->show($task_id);
        $completed = Status::COMPLETED;
        $allowed = implode(',', $task->availableStatuses());

        return [
            'status'     => "required|in:{$allowed}",
            'reason'     => [
                Rule::requiredIf($task->status()->name === $completed),
                'max:100',
            ],
            'assignee'   => "required_if:status,{$completed}|exists:App\Models\Assignee,id,task_id,{$task_id}",
        ];
    }
}

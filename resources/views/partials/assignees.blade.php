<div class="list-group">
    @foreach($assignees as $assignee)
        <a class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">
                    @component('components.avatar', ['user' => $assignee->user])
                    @endcomponent
                    {{ $assignee->user->full_name }}
                    @if(!is_null($assignee->completed_at))
                        <span
                            @component('components.tooltip', ['message' => __('task.Completed On', ['date' => $assignee->completed_at])])
                            @endcomponent
                        >
                            <i class="fa fa-check text-success"></i>
                        </span>
                    @endif
                </h5>
                <small class="text-danger"><i class="fa fa-times"></i> @lang('partials.assignees.Delete')</small>
            </div>
            @if(true === $assignee->blocker)
                <small class="text-danger"><i class="fa fa-ban"></i> @lang('partials.assignees.Blocker')</small>
                <br>
            @endif
            @if(!is_null($assignee->defer))
                <small>
                    <i class="fa fa-calendar-o"></i> @lang('partials.assignees.Deferred', ['date' => $assignee->user->defer])
                </small>
                <br>
            @endif
            @if(!is_null($assignee->user->due))
                <small>
                    <i class="fa fa-clock-o"></i> @lang('partials.assignees.Due', ['date' => $assignee->user->due])
                </small>
            @endif
        </a>
    @endforeach
</div>

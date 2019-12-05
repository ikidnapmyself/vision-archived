@php
    $config= config('model-status');
@endphp
<status-component :model="{{ $model->toJson() }}" :current="{{ $model->status()->toJson() }}" :statuses="{{ json_encode($model->availableStatuses()) }}"></status-component>

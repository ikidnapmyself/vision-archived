@php
    $type = $type ?? 'dropdown';
@endphp
@component("components.statuses.{$type}", ['type' => $type, 'model' => $model])
@endcomponent

@php
    /**
     * @var \Carbon\Carbon $date
     */
    $formatted = date("j F Y, H:i", $date->timestamp);
@endphp
<task-date-component ago="{{ $date->diffForHumans() }}" date="{{ $date->toDateTimeString() }}" formatted="{{ $formatted }}"></task-date-component>

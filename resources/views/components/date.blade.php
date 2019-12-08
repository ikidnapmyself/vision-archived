@php
    /**
     * @var \Carbon\Carbon $date
     */
    $formatted = date("j F Y, H:i", $date->timestamp);
@endphp
<date-component ago="{{ $date->diffForHumans() }}" date="{{ $date->toDateTimeString() }}" formatted="{{ $formatted }}"></date-component>

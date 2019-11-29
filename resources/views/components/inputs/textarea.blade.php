<textarea
    id="{{ $code }}"
    class="form-control {{ $class ?? '' }} @error($code) is-invalid @enderror"
    name="{{ $code }}"
    placeholder="{{ $lang ?? $code }}"
    @if(isset($required)) required @endif
    @if(isset($autofocus)) autofocus @endif
>{{ old($code, $value ?? '') }}</textarea>

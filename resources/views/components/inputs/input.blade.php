<input id="{{ $code }}" type="{{ $type ?? 'text' }}" class="form-control {{ $class ?? '' }} @error($code) is-invalid @enderror"
       name="{{ $code }}"
       value="{{ old($code, $value ?? '') }}"
       placeholder="{{ $lang ?? $code }}"
       @if(isset($required)) required @endif
       @if(isset($autofocus)) autofocus @endif
>

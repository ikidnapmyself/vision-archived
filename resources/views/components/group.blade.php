@php
    $base = [
        'code'  => $code,
        'lang'  => $lang,
        'value' => $value ?? '',
    ];
    $merge  = array_merge($base, $config ?? []);
@endphp
<div class="form-group row">
    <label for="{{ $code }}" class="col-md-4 col-form-label text-md-right">{{ $lang ?? $code }}</label>
    <div class="col-md-6">
        @if(!isset($input) || $input === 'input')
            @component('components.inputs.input', $merge)
            @endcomponent
        @elseif($input === 'textarea')
            @component('components.inputs.textarea', $merge)
            @endcomponent
        @endif
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

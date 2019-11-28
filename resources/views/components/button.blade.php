<button type="{{ $type ?? 'button' }}"
        @if(isset($id))
        id="{{ $id }}"
        @endif
        class="btn btn-{{ $color ?? 'default' }} {{ $class ?? '' }}"
        @if(isset($tooltip) && is_array($tooltip))
            @component('components.tooltip', $tooltip)
            @endcomponent
        @endif
    @component('components.html-attributes', ['attributes' => $attributes ?? []])
    @endcomponent>
    @if(isset($icon))
        <i class="{{ $icon }}"></i>
    @endif
    {{ $button ?? 'button' }}
</button>

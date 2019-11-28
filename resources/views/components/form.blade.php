<form
    class="{{ $class ?? '' }}"
    method="{{ $method ?? 'post' }}"
    @if(isset($id)) id="{{ $id }}" @endif
    action="{{ $action }}"
    @component('components.html-attributes', ['attributes' => $attributes ?? []])
    @endcomponent>
    {{ $form }}
</form>

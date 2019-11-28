@if(isset($attributes) && is_array($attributes))
    @foreach($attributes as $key => $attribute)
        {{ $key }}="{{ $attribute }}"
    @endforeach
@endif

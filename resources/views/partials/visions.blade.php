@foreach($visions as $vision)
    @component('components.inputs.button', [
        'class' => 'd-block w-100 p-3 my-1',
        'color' => config('ui.mode') === 'dark' ? 'dark' : 'secondary',
        'value' => $vision->name
    ])
    @endcomponent
@endforeach

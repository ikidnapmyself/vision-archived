<div class="card {{ config('ui.shadow') ? 'shadow-sm' : '' }}">
    @if(isset($title))
    <div class="card-header">
        <h4 class="my-0 font-weight-normal">{{ $title }}</h4>
    </div>
    @endif
    <div class="card-body">
        <p>{!! $body  ?? '' !!}</p>
        @if(isset($list) && is_array($list))
        <ul class="list-unstyled mt-3 mb-4">
            @foreach($list as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
        @endif
        @if(isset($button))
            <a class="btn btn-lg btn-block btn-outline-primary">{{ $button }}</a>
        @endif
    </div>
</div>

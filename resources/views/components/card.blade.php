<div class="card {{ config('ui.shadow') ? 'shadow-sm' : '' }}">
    @if(isset($title))
    <div class="card-header">
        <h4 class="my-0 font-weight-normal">{{ $title }}</h4>
    </div>
    @endif
    <div class="card-body">
        <p>{{ $body  ?? ''}}</p>
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
<div class="card mb-4 shadow-sm">
    <div class="card-header">
        <h4 class="my-0 font-weight-normal">Free</h4>
    </div>
    <div class="card-body">
        <h1 class="card-title pricing-card-title">$0 <small class="text-muted">/ mo</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
            <li>10 users included</li>
            <li>2 GB of storage</li>
            <li>Email support</li>
            <li>Help center access</li>
        </ul>
        <button type="button" class="btn btn-lg btn-block btn-outline-primary">Sign up for free</button>
    </div>
</div>

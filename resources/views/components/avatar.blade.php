@php($user = $user ?? auth()->user() )
<img src="{{ $user->getUrlfriendlyAvatar() }}"
     alt="{{ $user->full_name }}"
     title="{{ $user->full_name }}"
     class="rounded-sm" style="max-height: 20px;">

@props(['options' => null])

@php
    $anchorId = $options?->raw('anchor_id');
@endphp

<div
    @if ($anchorId) id="{{ $anchorId }}" @endif
    {{ $attributes->twMerge('component') }}
>
    {{ $slot }}
</div>

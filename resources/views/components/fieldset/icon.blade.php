{{--
This fieldset can be used in a component to display an icon. For example it is used in the fieldset
button to make it possible to add an icon inside any button.

Examples:
```
<x-fieldset.icon :icon="$icon?->value()"/>
```

```
<x-fieldset.icon :icon="$icon?->value()" class="size-20 text-red-700"/>
```
--}}
@props(['icon' => false])

@if ($icon)
    <span {{ $attributes->twMerge('h-8 inline-flex items-center justify-center *:w-auto *:h-full shrink-0' . (!$icon['preserve_icon_color'] ? ' [&_[fill]:not([fill=none])]:fill-current [&_[stroke]:not([stroke=none])]:stroke-current' : '')) }}>
        {!! $icon['icon'] !!}
    </span>
@endif
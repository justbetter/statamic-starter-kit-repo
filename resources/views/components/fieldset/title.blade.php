{{--
This is the title fieldset, it can be used for components where you need a title.
If you want to have different variants add them like this:
```
$component = match($title->title_options['variant']?->value()) {
    default => 'title.default',
    '4xl' => 'title.4xl'
};
```

Examples:
```
<x-fieldset.title :title="$title?->value()" />
```

```
<x-fieldset.title :title="$title?->value()" class="text-primary"/>
```
--}}
@props(['title' => false])

@if($title && $title['title_text'])
    @php
        $component = match($title->title_options['variant']?->value()) {
            default => 'title.default'
        };
    @endphp

    <x-dynamic-component
        :tag="$title->title_options['heading_type']->value() ?? 'div'"
        :$attributes
        :$component
    >
        {{ $title['title_text'] }}
    </x-dynamic-component>
@endif

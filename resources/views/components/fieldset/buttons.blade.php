{{--
This fieldset can be used if you need multiple buttons inside your component.
If you only need one button in your component you can use the fieldset button.

Example:
```
<x-fieldset.buttons :buttons="$buttons?->value()" />
```

If you need to change or add classes for the single buttons use the
`<x-slot:button></x-slot:button>`
```
<x-fieldset.buttons :buttons="$buttons?->value()">
    <x-slot:button class="inline-flex"></x-slot:button>
</x-fieldset.buttons>
```
--}}
@props(['buttons' => []])
@slots(['button'])

@if(is_iterable($buttons) && count($buttons['buttons']))
    <x-button.wrapper {{ $attributes }}>
        @foreach($buttons['buttons'] as $item)
            <x-fieldset.button :button="$item['button']" :attributes="$button->attributes" />
        @endforeach
    </x-button.wrapper>
@endif
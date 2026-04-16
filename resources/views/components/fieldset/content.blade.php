{{--
This fieldset can be used for components where you need content for example the text-image component.
The fieldset has two basic content types, text and buttons. If you want to add more types you can do it like this:
```
    ...
    @elseif($data['type'] === 'accordion')
        <x-fieldset.accordion :accordion="$accordion->value()" />
    @endif
```

Examples:
```
<x-fieldset.content :content="$content?->value()" />
```

```
<x-fieldset.content :content="$content?->value()">
    <x-slot:buttons class="mt-4"></x-slot:buttons>
    <x-slot:button class="mt-4"></x-slot:button>
    <x-slot:prose class="mt-4"></x-slot:prose>
</x-fieldset.content>
```
--}}
@props(['content' => []])
@slots(['prose', 'buttons', 'button'])

@if(is_iterable($content) && count($content['content']))
    <div {{ $attributes }}>
        @foreach($content['content'] as $data)
            @if($data['type'] === 'text')
                <x-prose :attributes="$prose->attributes->twMerge('fieldset-content data-text')">
                    {!! $data['text'] !!}
                </x-prose>
            @elseif($data['type'] === 'buttons')
                <x-fieldset.buttons :buttons="$data->buttons" :attributes="$buttons->attributes->twMerge('fieldset-content data-buttons')">
                    <x-slot:button :attributes="$button->attributes"></x-slot:button>
                </x-fieldset.buttons>
            @endif
        @endforeach
    </div>
@endif

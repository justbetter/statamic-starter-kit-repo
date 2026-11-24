{{--
Everything that has to do with images or videos.

Examples:
```
<x-fieldset.media :media="$media?->value()" />
```

```
<x-fieldset.media :media="$media?->value()" class="size-96" />
```
--}}
@props(['media' => false])

@if($media && $media['media'])
    @php
        $objectCover = optionalDeep($media)->media_options['object_fit']->value()->get() === 'cover';

        $classes = $attributes->twMerge(
            $objectCover ? '**:object-cover **:size-full' : 'w-auto! h-auto!'
        );
        $loading = $media->media_options['loading']?->value() ?? 'lazy';
        $lazy = $loading === 'lazy';
    @endphp

    <div {{ $classes }}>
        @if ($media['media']->isVideo())
            @php
                $videoOptions = collect($media->media_options['video'] ?? [])
                    ->flatMap(fn ($option) => explode(' ', $option['value']))
                    ->filter();
                $autoplay = $videoOptions->contains('autoplay');
            @endphp
            <video
                @foreach($videoOptions->reject(fn ($option) => $option === 'autoplay') as $option)
                    {{ $option }}
                @endforeach
                preload="{{ $lazy ? 'none' : ($autoplay ? 'auto' : 'metadata') }}"
                x-data="video(@js($autoplay))"
                x-load="{{ $lazy ? 'visible' : 'eager' }}"
            >
                <source {{ $lazy ? 'data-src' : 'src' }}="{{ $media['media'] }}" type="video/mp4">
            </video>
        @else
            @responsive($media['media'], ['loading' => $loading])
        @endif
    </div>
@endif

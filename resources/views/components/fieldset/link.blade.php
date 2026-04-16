{{--
The fieldset link should be used for every clickable element. For example this fieldset is used
inside the button fieldset.

Examples:
```
<x-fieldset.link :link="$link->value()">
    This is a link
</x-fieldset.link>
```

Sometimes it can happen that you want to have a parent item to be a link but still use the button component inside the parent.
But an anchor tag within another anchor tag won't work and will break the HTML. That is why we have the prop link to add this to the
child element that shouldn't be an anchor tag.
```
    <x-fieldset.link :link="$link->value()">
        <x-fieldset.media :media="$media?->value()" />
        <x-fieldset.button :button="$button->value()" :link="false" />
    </x-fieldset.link>
```
--}}
@props(['link' => false, 'disable' => false])

@if($link)
    <x-rapidez::tag
        :is="!$disable && $link['link']->url() ? 'a' : 'div'"
        :href="!$disable && $link['link']->url() ? $link['link']->url() : null"
        :rel="!$disable && $link['link']->url() && $link['link_options'] && $link->link_options['rel'] ? collect($link->link_options['rel'])->pluck('value')->implode(' ') : null"
        :target="!$disable && $link['link']->url() && $link['link_options'] && $link->link_options['blank'] ? '_blank' : null"
        :aria-label="!$disable && $link['link']->url() && $link['link_options'] ? $link->link_options['aria_label'] : null"
        :download="!$disable && $link['link']->url() && $link['link_options'] && $link->link_options['download_attribute'] ? '' : false"
        {{ $attributes }}
    >
        {{ $slot }}
    </x-rapidez::tag>
@endif
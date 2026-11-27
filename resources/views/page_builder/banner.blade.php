<x-component :options="($component_options ?? null)?->value()" class="banner">
    <div @class([
        'container' => $display['value'] === 'container',
        'xl:container' => $display['value'] === 'desktop_container',
        'w-full' => $display['value'] === 'full_width'
    ])>
        <x-fieldset.link :link="$link?->value()">
            <x-fieldset.media :media="$media?->value()"
                @class([
                    'h-80' => $size['value'] === 'compact',
                    'h-160' => $size['value'] === 'normal'
                ])
            />
        </x-fieldset.link>
    </div>
</x-component>

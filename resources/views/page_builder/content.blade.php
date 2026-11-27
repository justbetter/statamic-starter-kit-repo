@if($content->value() ?? false)
    <x-component :options="($component_options ?? null)?->value()" class="content">
        <div class="container">
            <x-fieldset.content :content="$content?->value()" />
        </div>
    </x-component>
@endif

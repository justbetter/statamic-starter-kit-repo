<div class="container">
    <x-fieldset.title :title="$title?->value()" class="text-primary"/>
    <x-fieldset.button :button="$button->value()" class="my-4"/>
    <x-fieldset.buttons :buttons="$buttons?->value()" />
    <x-fieldset.buttons :buttons="$buttons?->value()" class="mt-10">
        <x-slot:button class="inline-flex"></x-slot:button>
    </x-fieldset.buttons>
    <x-fieldset.icon :icon="$icon?->value()" class="h-20 text-red-500"/>
</div>

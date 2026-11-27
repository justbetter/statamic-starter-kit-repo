@if($form->handle ?? false)
    <x-component :options="($component_options ?? null)?->value()" class="container form">
        <div class="flex flex-col gap-y-4">
            <x-fieldset.title :title="$title?->value()" />

            <x-form
                :form="$form?->value()"
                :formHandle="$form->handle"
                :buttonText="$button_text?->value() ?? __('Send')"
                :submissionText="$submission_text?->value() ?? ''"
                :formRedirectUrl="$redirect_url?->value()->url() ?? ''"
                :id="$form->handle"
            />
        </div>
    </x-component>
@endif

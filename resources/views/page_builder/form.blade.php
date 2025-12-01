@if($form->handle ?? false)
    <div class="container component form">
        <div class="flex flex-col gap-y-4">
            <x-fieldset.title :title="$title?->value()" />

            <x-form
                :form="$form?->value()"
                :formHandle="$form->handle"
                :title="$title?->value() ?? ''"
                :buttonText="$button_text?->value() ?? __('Send')"
                :submissionText="$succes_text?->value() ?? ''"
                :formRedirectUrl="$redirect_url?->value()->url() ?? ''"
                :id="$form->handle"
            />
        </div>
    </div>
@endif

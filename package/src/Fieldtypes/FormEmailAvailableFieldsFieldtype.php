<?php

namespace JustBetter\StatamicStarterKit\Fieldtypes;

use Illuminate\Support\Collection;
use Statamic\Facades\Form;
use Statamic\Fields\Fieldtype;

class FormEmailAvailableFieldsFieldtype extends Fieldtype
{
    protected $selectable = false;

    protected $localizable = false;

    protected $validatable = false;

    public function preload(): array
    {
        $formHandle = $this->config('form');
        $fields = is_string($formHandle) ? $this->getAvailableFormFields($formHandle) : collect();

        return [
            'available_fields' => $fields->values()->all(),
        ];
    }

    public function preProcess($data)
    {
        return $data;
    }

    protected function configFieldItems(): array
    {
        return [
            'form' => [
                'display' => __('Form'),
                'type' => 'text',
            ],
        ];
    }

    private function getAvailableFormFields(string $formHandle): Collection
    {
        $form = Form::find($formHandle);

        if (! $form) {
            return collect();
        }

        return $form->blueprint()
            ?->fields()
            ?->items()
            ?->map(function (array $data): array {
                $handle = (string) ($data['handle'] ?? '');
                $label = (string) ($data['field']['display'] ?? $handle);

                return [
                    'handle' => $handle,
                    'label' => $label,
                    'token' => "{{ {$handle} }}",
                ];
            })
            ?? collect();
    }
}

<?php

namespace JustBetter\StatamicStarterKit\Http\Controllers\CP;

use Statamic\Fields\Blueprint;
use Statamic\Http\Controllers\CP\Forms\FormsController as BaseFormsController;

class StarterKitFormsController extends BaseFormsController
{
    protected function editFormBlueprint($form): Blueprint
    {
        $blueprint = parent::editFormBlueprint($form);
        $blueprintContents = $blueprint->contents();

        $emailContentField = [
            'handle' => 'email_content',
            'field' => [
                'type' => 'textarea',
                'display' => __('Email content'),
                'instructions' => '',
            ],
        ];

        if (isset($blueprintContents['tabs']['email']['fields']['email']['field']['fields']) && is_array($blueprintContents['tabs']['email']['fields']['email']['field']['fields'])) {
            $fields = $blueprintContents['tabs']['email']['fields']['email']['field']['fields'];
            $exists = collect($fields)->contains(fn (array $field): bool => ($field['handle'] ?? null) === 'email_content');
            if (! $exists) {
                $fields[] = $emailContentField;
                $blueprintContents['tabs']['email']['fields']['email']['field']['fields'] = $fields;
            }
        }

        if (isset($blueprintContents['tabs']['main']['sections']) && is_array($blueprintContents['tabs']['main']['sections'])) {
            foreach ($blueprintContents['tabs']['main']['sections'] as $sectionIndex => $section) {
                if (($section['display'] ?? null) !== 'Email') {
                    continue;
                }

                $sectionFields = $section['fields'] ?? [];
                if (! is_array($sectionFields)) {
                    continue;
                }

                foreach ($sectionFields as $fieldIndex => $fieldConfig) {
                    if (($fieldConfig['handle'] ?? null) !== 'email') {
                        continue;
                    }

                    $gridFields = $fieldConfig['field']['fields'] ?? [];
                    if (! is_array($gridFields)) {
                        continue;
                    }

                    $exists = collect($gridFields)->contains(fn (array $field): bool => ($field['handle'] ?? null) === 'email_content');
                    if (! $exists) {
                        $gridFields[] = $emailContentField;
                        $blueprintContents['tabs']['main']['sections'][$sectionIndex]['fields'][$fieldIndex]['field']['fields'] = $gridFields;
                    }
                }
            }
        }

        $blueprint->setContents($blueprintContents);

        return $blueprint;
    }
}

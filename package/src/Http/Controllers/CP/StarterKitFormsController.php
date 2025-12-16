<?php

namespace JustBetter\StatamicStarterKit\Http\Controllers\CP;

use Statamic\Http\Controllers\CP\Forms\FormsController as BaseFormsController;

class StarterKitFormsController extends BaseFormsController
{
    protected function editFormBlueprint($form)
    {
        $blueprint = parent::editFormBlueprint($form);

        $blueprintContents = $blueprint->contents();

        $emailFields = $blueprintContents['tabs']['email']['fields']?->toArray() ?? [];

        $emailFields['email']['field']['fields'][] = [
            'handle' => 'email_content',
            'field' => [
                'type' => 'textarea',
                'display' => __('Email content'),
                'instructions' => '',
            ],
        ];

        $blueprintContents['tabs']['email']['fields'] = collect($emailFields);
        $blueprint->setContents($blueprintContents);

        return $blueprint;
    }
}

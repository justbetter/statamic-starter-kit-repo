<?php

namespace App\Http\Controllers\Cp;

use App\Http\Requests\Cp\StoreGlobalComponentRequest;
use Illuminate\Support\Str;
use Statamic\Contracts\Entries\Entry as EntryContract;
use Statamic\Facades\Collection;
use Statamic\Facades\Entry;
use Statamic\Facades\Site;
use Statamic\Http\Controllers\CP\CpController;

class GlobalComponentController extends CpController
{
    public function __invoke(StoreGlobalComponentRequest $request): array
    {
        $collection = Collection::findByHandle('global_components');

        abort_if($collection === null, 404);

        $this->authorize('store', [EntryContract::class, $collection]);

        $validated = $request->validated();
        $title = $validated['title'];

        /** @var array<string, mixed> $component */
        $component = $request->input('component');

        $entry = Entry::make()
            ->collection($collection)
            ->locale(Site::default()->handle())
            ->slug($this->uniqueSlug($title));

        $values = $entry
            ->blueprint()
            ->fields()
            ->addValues([
                'title' => $title,
                'page_builder' => [$component],
            ])
            ->process()
            ->values();

        $entry->data($values);

        $entry->save();

        return [
            'id' => $entry->id(),
            'title' => $entry->value('title'),
            'edit_url' => $entry->editUrl(),
        ];
    }

    private function uniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        $slug = $slug !== '' ? $slug : 'global-component';
        $candidate = $slug;
        $attempt = 1;

        while (Entry::query()
            ->where('collection', 'global_components')
            ->where('locale', Site::default()->handle())
            ->where('slug', $candidate)
            ->count() > 0) {
            $attempt++;
            $candidate = $slug.'-'.$attempt;
        }

        return $candidate;
    }
}

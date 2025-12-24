@if ($media_items?->value() ?? false)
    <div class="component media-grid">
        <div class="grid grid-cols-4 gap-4">
            @foreach ($media_items as $media_item)
                <x-fieldset.media
                    :media="$media_item->media"
                    :media_options="$media_item->media_options"
                    :loading="($is_first ?? false) && $loop->first ? 'eager' : 'lazy'"
                />
            @endforeach
        </div>
    </div>
@endif

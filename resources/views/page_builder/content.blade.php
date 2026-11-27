@if($content->value() ?? false)
    <div class="component content" @if ($anchorId ?? false) id="{{ $anchorId }}" @endif>
        <div class="container">
            <x-fieldset.content :content="$content?->value()" />
        </div>
    </div>
@endif

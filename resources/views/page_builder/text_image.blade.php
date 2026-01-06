@if($content->value() ?? false || $media->value() ?? false)
    <div @class([
            'component text-image',
            'has-background' => $background->value(),
        ])
    >
        <div class="container">
            <div class="grid lg:grid-cols-2 lg:items-center lg:justify-center max-lg:gap-y-10">
                @if($content->value() ?? false)
                    <div
                        @class([
                            'lg:flex lg:justify-center',
                            'order-last xl:pl-16' => $toggle->value(),
                            'xl:pr-16' => !$toggle->value(),
                        ])
                    >
                        <div class="flex flex-col">
                            @if($content->value() ?? false)
                                <div>
                                    <x-fieldset.content :content="$content?->value()" />
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                @if($media->value() ?? false)
                    <div>
                        <x-fieldset.media
                            :media="$media?->value()"
                        />
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif

@if ($logos?->value() ?? false)
    <div class="component logo-grid">
        <div class="container">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($logos as $logo)
                    <div class="py-8 px-4 bg">
                        @if ($logo->logo ?? false)
                            @responsive($logo->logo, ['class' => 'max-h-full mx-auto w-auto h-12 sm:h-16'])
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

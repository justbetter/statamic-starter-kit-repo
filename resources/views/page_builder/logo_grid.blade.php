@if ($logos?->value() ?? false)
    <div class="component logo-grid">
        <div class="grid grid-cols-4 gap-4">
            @foreach ($logos as $logo)
                @if ($logo->logo ?? false)
                    @responsive($logo->logo, ['class' => 'w-full h-auto'])
                @endif
            @endforeach
        </div>
    </div>
@endif

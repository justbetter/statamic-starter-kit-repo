<footer class="mt-16">
    <div class="bg-primary-900">
        <div class="container flex flex-col items-center py-16">
            @if ($logo ?? false)
                <div class="flex flex-1 w-48 mb-10 lg:mb-12 *:flex *:flex-1">
                    <img src="{{ $logo->absoluteUrl() }}" alt="JustBetter logo" class="flex flex-1 max-w-[100px]">
                </div>
            @endif
            @php($footerNavigation = Statamic::tag('nav:footer_navigation')->fetch())
            @if($footerNavigation ?? false)
                <div class="flex gap-2 px-4">
                    @foreach ($footerNavigation as $item)
                        <a href="{{ $item['url']?->value() }}" @if(($item['blank'] ?? null)?->value()) target="_blank" rel="noopener" @endif>
                            {{ $item['title'] ?? '' }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</footer>

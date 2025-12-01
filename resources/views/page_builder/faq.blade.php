@php
    $faqItems = \Statamic\Statamic::tag('faq:getItems')->params(['type' => $faq_type?->value()?->value(), 'items' => $faq_items?->get(), 'categories' => $faq_categories?->get()])->fetch();
@endphp
@if($faqItems?->isNotEmpty() ?? false)
    <div class="component faq">
        <div class="container">
            <div class="flex justify-between items-center">
                <x-fieldset.title :title="$title?->value()" />

                <x-fieldset.buttons :buttons="$buttons?->value()" />
            </div>
            @foreach($faqItems as $faq)
                <div>
                    <x-title.default>{{ $faq->title }}</x-title.default>
                    <x-fieldset.content :content="$faq->answer_content" />
                </div>
            @endforeach
        </div>
    </div>
@endif

@foreach ($page_builder as $set)
    @php
        $options = $set['component_options'] ?? null;
        $options = $options instanceof \Statamic\Fields\Value ? $options->value() : $options;
        $anchorId = $options->anchor_id ?? null;
    @endphp
    @includeIf('page_builder.' . $set['type'], $set)
@endforeach

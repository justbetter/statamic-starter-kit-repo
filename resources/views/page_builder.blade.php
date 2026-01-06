@foreach ($page_builder as $set)
    @php
        $variables = $set->all();
        if ($eager_first ?? false) {
            $variables['is_first'] = $loop->first;
        }
    @endphp
    @includeIf('page_builder.' . $set['type'], $variables)
@endforeach

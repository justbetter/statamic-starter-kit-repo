@extends('layouts.app')
@section('content')
    @php
        $page_builder = $error_404_page?->page_builder ?? [];
    @endphp
    @include('page_builder')
@endsection
@extends('master.main', ['activePage' => 'authors', 'titlePage' => __('Edit Author')])
@section('content')

    @component('components.authors.author-form-edit', ['author' => $author])
    @endcomponent

@endsection

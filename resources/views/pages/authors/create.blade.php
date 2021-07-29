@extends('master.main', ['activePage' => 'authors', 'titlePage' => __('Create Author')])
@section('content')

    @component('components.authors.author-form-create')
    @endcomponent

@endsection
@extends('master.main', ['activePage' => 'authors', 'titlePage' => __('Authors List')])
@section('content')

    @component('components.authors.authors-list', ['authors' => $authors])
    @endcomponent

@endsection

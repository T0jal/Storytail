@extends('master.main', ['activePage' => 'books', 'titlePage' => __('Books List')])
@section('content')

    @component('components.books.books-list', ['books' => $books])
    @endcomponent

@endsection

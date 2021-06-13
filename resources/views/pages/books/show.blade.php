@extends('master.main', ['activePage' => 'books', 'titlePage' => __('Books List')])
@section('content')

    @component('components.books.book-form-show',
        ['book' => $book, 'next'=>$next, 'previous'=> $previous, 'tags' => $tags])
    @endcomponent

@endsection

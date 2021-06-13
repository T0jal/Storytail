@extends('master.main', ['activePage' => 'books', 'titlePage' => __('Books List')])
@section('content')

    @component('components.books.book-form-edit',
        ['book' => $book, 'authors'=> $authors, 'ageGroups'=> $ageGroups,
        'activities'=> $activities, 'activityBooks' => $activityBooks, 'tags' => $tags])

    @endcomponent

@endsection

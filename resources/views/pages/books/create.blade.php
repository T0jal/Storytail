@extends('master.main', ['activePage' => 'books', 'titlePage' => __('Books List')])

@section('content')

    @component('components.books.book-form-create',
                ['authors'=> $authors, 'ageGroups'=> $ageGroups, 'activities'=> $activities])
    @endcomponent

    @yield('scripts')

@endsection

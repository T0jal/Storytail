@extends('master.main', ['activePage' => 'authors', 'titlePage' => __('Show Author')])
@section('content')

    @component('components.authors.author-form-show', ['author' => $author, 'next'=>$next, 'previous'=> $previous])
    @endcomponent

@endsection
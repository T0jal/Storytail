@extends('master.main', ['activePage' => 'activities', 'titlePage' => __('Activities List')])
@section('content')

    @component('components.activities.activities-list', ['activities' => $activities])
    @endcomponent

@endsection

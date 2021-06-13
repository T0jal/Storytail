@extends('master.main', ['activePage' => 'activities', 'titlePage' => __('Activities List')])
@section('content')

    @component('components.activities.activity-form-edit', ['activity' => $activity])

    @endcomponent

@endsection

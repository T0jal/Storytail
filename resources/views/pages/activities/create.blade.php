@extends('master.main', ['activePage' => 'activities', 'titlePage' => __('Activities List')])

@section('content')

    @component('components.activities.activity-form-create', ['activityImages' => $activityImages])
    @endcomponent

    @yield('scripts')

@endsection

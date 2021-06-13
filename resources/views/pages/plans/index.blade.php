@extends('master.main', ['activePage' => 'plans', 'titlePage' => __('Plans List')])
@section('content')

    @component('components.plans.plans-list', ['plans' => $plans])
    @endcomponent

@endsection

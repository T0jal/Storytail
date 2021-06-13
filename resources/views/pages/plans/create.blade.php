@extends('master.main', ['activePage' => 'plans', 'titlePage' => __('Create Plan')])
@section('content')

    @component('components.plans.plan-form-create')
    @endcomponent

@endsection
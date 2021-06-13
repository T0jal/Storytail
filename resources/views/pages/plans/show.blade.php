@extends('master.main', ['activePage' => 'plans', 'titlePage' => __('Show Plan')])
@section('content')

    @component('components.plans.plan-form-show', ['plan' => $plan])
    @endcomponent

@endsection
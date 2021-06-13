@extends('master.main', ['activePage' => 'plans', 'titlePage' => __('Edit Plan')])
@section('content')

    @component('components.plans.plan-form-edit', ['plan' => $plan])
    @endcomponent

@endsection

@extends('master.main', ['activePage' => 'users', 'titlePage' => __('Edit User')])
@section('content')

    @component('components.users.user-form-edit', ['user' => $user, 'subscription' => $subscription, 'user_types' => $user_types, 'plans' => $plans])
    @endcomponent

@endsection
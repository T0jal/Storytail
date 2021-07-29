@extends('master.main', ['activePage' => 'users', 'titlePage' => __('Users Create')])
@section('content')

    @component('components.users.user-form-create', ['plans' => $plans, 'user_types' => $user_types])
    @endcomponent

@endsection
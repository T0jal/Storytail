@extends('master.main', ['activePage' => 'users', 'titlePage' => __('Show User')])
@section('content')

    @component('components.users.user-form-show', ['user' => $user, 'subscription' => $subscription, 'user_types' => $user_types, 'next'=>$next, 'previous'=> $previous])
    @endcomponent

@endsection

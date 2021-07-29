@extends('master.main', ['activePage' => 'users', 'titlePage' => __('Books List')])
@section('content')

    @component('components.users.users-list', ['users' => $users])
    @endcomponent

@endsection
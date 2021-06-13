@extends('master.main', ['activePage' => 'activities', 'titlePage' => __('Activities List')])
@section('content')

    @component('components.activities.activity-form-show',
        ['activity' => $activity, 'next'=>$next, 'previous'=> $previous, 'activityBooks' => $activityBooks])
    @endcomponent

@endsection

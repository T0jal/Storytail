@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ url('admin/users/')  }}">
                        @csrf
                        <div class="card ">

                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Show User') }}</h4>
                                <p class="card-category">{{ __('User Information') }}</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('User Photo') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group d-flex justify-content-center">
                                            <img class="rounded pr-1 pb-1" src="{{ asset('images/' . $user->user_photo_url) }}" style="width:200px;"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('First Name') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                id="first_name"
                                                name="first_name"
                                                disabled
                                                autocomplete="first_name"
                                                placeholder="User's name"
                                                class="form-control
                                                 @error('first_name') is-invalid @enderror"
                                                value="{{ $user->first_name }}"
                                                required
                                                aria-describedby="nameHelp">
                                            @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Last Name') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                id="last_name"
                                                name="last_name"
                                                disabled
                                                autocomplete="last_name"
                                                placeholder="User's name"
                                                class="form-control
                                                 @error('last_name') is-invalid @enderror"
                                                value="{{ $user->last_name }}"
                                                required
                                                aria-describedby="nameHelp">
                                            @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('User Name') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                id="user_name"
                                                name="user_name"
                                                disabled
                                                autocomplete="user_name"
                                                placeholder="User's name"
                                                class="form-control
                                                 @error('user_name') is-invalid @enderror"
                                                value="{{ $user->user_name }}"
                                                required
                                                aria-describedby="nameHelp">
                                            @error('user_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input
                                                type="email"
                                                id="email"
                                                name="email"
                                                disabled
                                                autocomplete="email"
                                                placeholder="Estimated reading time in minutes"
                                                value="{{ $user->email }}"
                                                required
                                                aria-describedby="nameHelp"
                                                class="form-control @error('email') is-invalid @enderror">
                                            @error('email')
                                                <div class="alert alert-danger"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('User Type') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                id="user_type"
                                                name="user_type"
                                                disabled
                                                autocomplete="user_type"
                                                placeholder="Estimated reading time in minutes"
                                                value="{{ $user->userType->user_type }}"
                                                required
                                                aria-describedby="nameHelp"
                                                class="form-control @error('user_type') is-invalid @enderror">
                                            @error('author')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Plan') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                id="plan_name"
                                                name="plan_name"
                                                disabled
                                                autocomplete="plan_name"
                                                placeholder="This user has no plans, just drifting through life."
                                                class="form-control
                                                 @error('plan_name') is-invalid @enderror"
                                                @if($subscription)
                                                value="{{ $subscription->plan->name }}"
                                                @else
                                                value=""
                                                @endif
                                                required
                                                aria-describedby="nameHelp">
                                            @error('plan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Created At') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                disabled
                                                id="created_at"
                                                name="created_at"
                                                autocomplete="created_at"
                                                placeholder="created_at"
                                                class="form-control @error('created at') is-invalid @enderror"
                                                value="{{ $user->created_at }}"
                                                required
                                                aria-describedby="nameHelp">

                                            @error('created_at')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Updated At') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                disabled
                                                id="updated_at"
                                                name="updated_at"
                                                autocomplete="updated_at"
                                                placeholder="updated_at"
                                                class="form-control
                                    @error('updated at') is-invalid @enderror"
                                                value="{{ $user->updated_at }}"
                                                required
                                                aria-describedby="nameHelp">

                                            @error('updated_at')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            @if($previous != 0)
                                <a href="{{url('admin/users/' . $previous)}}" type="button" class="btn btn-warning" style="width:150px">
                                    Previous User
                                </a>
                            @endif
                            <a href="{{url('admin/users/')}}" type="button" class="btn btn-danger" style="width:150px">Return to List</a>
                            @if($next != 0)
                                <a href="{{url('admin/users/' . $next)}}" type="button" class="btn btn-warning" style="width:150px">
                                    Next User
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

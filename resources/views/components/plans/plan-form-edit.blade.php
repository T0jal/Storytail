@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ url('admin/plans/' . $plan->id) }}">
                @csrf
                @method('PUT')
            <div class="card ">

                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ __('Edit Plan') }}</h4>
                    <p class="card-category">{{ __('Plan information') }}</p>
                </div>

                <div class="card-body">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    autocomplete="name"
                                    placeholder="Name"
                                    class="form-control @error('title') is-invalid @enderror"
                                    value="{{ $plan->name }}"
                                    aria-describedby="nameHelp">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Price (in euros)') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input
                                    type="text"
                                    id="price"
                                    name="price"
                                    autocomplete="price"
                                    placeholder="Last price"
                                    class="form-control"
                                    value="{{ $plan->price }}"
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
                        <label class="col-sm-2 col-form-label">{{ __('Duration (in days)') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input
                                    type="text"
                                    id="duration"
                                    name="duration"
                                    autocomplete="duration"
                                    class="form-control @error('duration') is-invalid @enderror"
                                    value="{{$plan->duration}}"
                                    aria-describedby="nameHelp">
                                @error('duration')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Access Level') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <select name="access_level" class="form-control">
                                    @if($plan->access_level == 1)
                                        <option selected value = 1 > Premium </option>
                                        <option value = 0 > Free </option>
                                    @else
                                        <option value = 1 > Premium </option>
                                        <option selected value = 0 > Free </option>
                                    @endif
                                </select>
                                @error('access_level')
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
                                    class="form-control
                                    @error('created at') is-invalid @enderror"
                                    value="{{ $plan->created_at }}"
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
                                    value="{{ $plan->updated_at }}"
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
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{url('admin/books/')}}" type="button" class="btn btn-danger">Return</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ url('admin/plans/') }}">
                @csrf
            <div class="card ">

                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ __('Create Plan') }}</h4>
                    <p class="card-category">{{ __('Plan information') }}</p>
                </div>

                <div class="card-body">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input
                                    type="text"
                                    required
                                    id="name"
                                    name="name"
                                    autocomplete="name"
                                    placeholder="Plan's Name"
                                    class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('name') }}"
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
                                    required
                                    id="price"
                                    name="price"
                                    autocomplete="price"
                                    class="form-control @error('price') is-invalid @enderror"
                                    placeholder="Plan's Price"
                                    value="{{ old('price') }}"
                                    aria-describedby="nameHelp">
                                @error('price')
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
                                    placeholder="How many days lasts the Plan"
                                    autocomplete="duration"
                                    class="form-control @error('duration') is-invalid @enderror"
                                    value="{{ old('duration') }}"
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
                                    <option selected value = 0>
                                        Free
                                    </option>
                                    <option value = 1>
                                        Premium
                                    </option>
                                </select>
                                @error('access_level')
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
                <button type="submit" class="btn btn-success" style="width:100px">Create</button>
                <a href="{{url('admin/plans/')}}" type="button" class="btn btn-danger" style="width:100px">Return</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ url('activities') }}">
                @csrf
            <div class="card ">

                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ __('Show Activity') }}</h4>
                    <p class="card-category">{{ __('Activity information') }}</p>
                </div>

                <div class="card-body">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Title') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input
                                    type="text"
                                    disabled
                                    id="title"
                                    name="title"
                                    autocomplete="title"
                                    placeholder="title"
                                    class="form-control
                                    @error('title') is-invalid @enderror"
                                    value="{{ $activity->title }}"
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
                        <label class="col-sm-2 col-form-label">{{ __('Description') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <textarea
                                    type="text"
                                    rows="6"
                                    disabled
                                    id="description"
                                    name="description"
                                    autocomplete="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    aria-describedby="nameHelp">{{$activity->description}}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Images') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                @foreach($activity->activityImages as $image)
                                    <img class="rounded pr-1 pb-1" src="{{ asset('images/' . $image->image_url) }}" style="width:100px"/>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Present in which Books') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                            <textarea
                                type="text"
                                rows="3"
                                disabled
                                id="books"
                                name="books"
                                autocomplete="books"
                                class="form-control @error('books') is-invalid @enderror"
                                aria-describedby="nameHelp">@foreach($activity->activityBooks as $activityBook){{ $loop->first ? '' : '; ' }}{{ $activityBook->book->title }}@endforeach</textarea>
                                @error('books')
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
                                    value="{{ $activity->created_at }}"
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
                                    value="{{ $activity->updated_at }}"
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
                    <br>
            <div class="d-flex justify-content-center">
                @if($previous != 0)
                    <a href="{{url('admin/activities/' . $previous)}}" type="button" class="btn btn-warning" style="width:170px">
                        Previous Activity
                    </a>
                @endif
                    <a href="{{url('admin/activities/')}}" type="button" class="btn btn-danger" style="width:150px">Return to List</a>
                @if($next != 0)
                    <a href="{{url('admin/activities/' . $next)}}" type="button" class="btn btn-warning" style="width:170px">
                        Next Activity
                    </a>
                @endif
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

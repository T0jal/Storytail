@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ url('authors') }}">
                @csrf
            <div class="card ">

                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ __('Show Author') }}</h4>
                    <p class="card-category">{{ __('Author information') }}</p>
                </div>

                <div class="card-body">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('First Name') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input
                                    type="text"
                                    disabled
                                    id="first_name"
                                    name="first_name"
                                    autocomplete="first_name"
                                    placeholder="First Name"
                                    class="form-control @error('title') is-invalid @enderror"
                                    value="{{ $author->first_name }}"
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
                        <label class="col-sm-2 col-form-label">{{ __('Last Name') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input
                                    type="text"
                                    disabled
                                    id="last_name"
                                    name="last_name"
                                    autocomplete="last_name"
                                    placeholder="Last Name"
                                    class="form-control" value="{{ $author->last_name }}"
                                    aria-describedby="nameHelp">
                                @error('author')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Author Photo') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group d-flex justify-content-center">
                                <img class="rounded pr-1 pb-1" src="{{ asset('images/' . $author->author_photo_url) }}" style="width:200px;"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Short Bio') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <textarea
                                    type="text"
                                    rows="4"
                                    disabled
                                    id="description"
                                    name="description"
                                    autocomplete="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    aria-describedby="nameHelp">{{$author->description}}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Nationality') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input
                                    type="text"
                                    disabled
                                    id="nationality"
                                    name="nationality"
                                    autocomplete="nationality"
                                    placeholder="nationality"
                                    class="form-control @error('read time') is-invalid @enderror"
                                    value="{{ $author->nationality }}"
                                    aria-describedby="nameHelp">
                                @error('nationality')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Books') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group d-flex justify-content-center">
                                @foreach($author->books as $book)
                                    <a href="{{url('admin/books/' . $book->id)}}">
                                        <img class="rounded pr-1 pb-1" src="{{ asset('images/' . $book->cover_url) }}" style="width:100px;"/>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

{{--                    <div class="row">--}}
{{--                        <label class="col-sm-2 col-form-label">{{ __('Books') }}</label>--}}
{{--                        <div class="col-sm-7">--}}
{{--                            <div class="form-group">--}}
{{--                                <textarea--}}
{{--                                    type="text"--}}
{{--                                    rows="4"--}}
{{--                                    disabled--}}
{{--                                    id="description"--}}
{{--                                    name="description"--}}
{{--                                    autocomplete="description"--}}
{{--                                    class="form-control @error('description') is-invalid @enderror"--}}
{{--                                    aria-describedby="nameHelp">@foreach($author->books as $book){{ $loop->first ? '' : ', ' }}{{ $book->title }}@endforeach</textarea>--}}
{{--                                @error('description')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

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
                                    value="{{ $author->created_at }}"
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
                                    value="{{ $author->updated_at }}"
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
                        <a href="{{url('admin/authors/' . $previous)}}" type="button" class="btn btn-warning" style="width:170px">
                            Previous Author
                        </a>
                    @endif
                        <a href="{{url('admin/authors/')}}" type="button" class="btn btn-danger" style="width:170px">Return to List</a>
                    @if($next != 0)
                        <a href="{{url('admin/authors/' . $next)}}" type="button" class="btn btn-warning" style="width:150px">
                            Next Author
                        </a>
                    @endif
                </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

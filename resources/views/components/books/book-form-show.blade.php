@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ url('admin/books') }}">
                @csrf
            <div class="card ">

                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ __('Show Book') }}</h4>
                    <p class="card-category">{{ __('Book information') }}</p>
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
                                    value="{{ $book->title }}"
                                    required
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
                        <label class="col-sm-2 col-form-label">{{ __('Cover') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group d-flex justify-content-center">
                                <img class="rounded pr-1 pb-1" src="{{ asset('images/' . $book->cover_url) }}" style="width:200px;"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Author') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input
                                    type="text"
                                    disabled
                                    id="author"
                                    name="author"
                                    autocomplete="author"
                                    placeholder="Maybe it's a ghost writer, how exciting!"
                                    class="form-control
                                    @error('author') is-invalid @enderror"
                                    value="@foreach($book -> authors as $author){{ $loop->first ? '' : ', ' }}{{ $author->first_name }} {{ $author->last_name }}@endforeach"
                                    required
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
                        <label class="col-sm-2 col-form-label">{{ __('Description') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <textarea
                                    type="text"
                                    rows="4"
                                    disabled
                                    id="description"
                                    name="description"
                                    autocomplete="description"
                                    class="form-control
                                    @error('description') is-invalid @enderror"
                                    required
                                    aria-describedby="nameHelp">{{$book->description}}</textarea>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Read Time (Min)') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input
                                    type="text"
                                    disabled
                                    id="read_time"
                                    name="read_time"
                                    autocomplete="read_time"
                                    placeholder="read_time"
                                    class="form-control
                                    @error('read time') is-invalid @enderror"
                                    value="{{ $book->read_time }}"
                                    required
                                    aria-describedby="nameHelp">

                                @error('read_time')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Tags') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input
                                    type="text"
                                    disabled
                                    id="tags"
                                    name="tags"
                                    autocomplete="tags"
                                    placeholder="One can only dream of a few tags."
                                    class="form-control
                                    @error('tags') is-invalid @enderror"
                                    value="{{ $tags }}"
                                    required
                                    aria-describedby="nameHelp">
                                @error('tags')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Age Group (Years)') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input
                                    type="text"
                                    disabled
                                    id="age_group"
                                    name="age_group"
                                    autocomplete="age_group"
                                    placeholder="age_group"
                                    class="form-control
                                    @error('age group') is-invalid @enderror"
                                    value="{{ $book->ageGroup->age_group }}"
                                    required
                                    aria-describedby="nameHelp">

                                @error('age_group')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Activities') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input
                                    type="text"
                                    disabled
                                    id="activities"
                                    name="activities"
                                    autocomplete="activities"
                                    placeholder="Activities? This one prefers to rest."
                                    class="form-control
                                    @error('author') is-invalid @enderror"
                                    value="@foreach($book -> activityBooks as $activityBook){{ $loop->first ? '' : ', ' }}{{ $activityBook->activity->title }}@endforeach"
                                    required
                                    aria-describedby="nameHelp">
                                @error('activities')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Is Active') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input
                                    type="text"
                                    disabled
                                    id="is_active"
                                    name="is_active"
                                    autocomplete="is_active"
                                    placeholder="is_active"
                                    class="form-control
                                    @error('age group') is-invalid @enderror"
                                    value="@if($book->is_active){{'Yes'}}@else{{'No'}}@endif"
                                    required
                                    aria-describedby="nameHelp">

                                @error('age_group')
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
                                <input
                                    type="text"
                                    disabled
                                    id="access_level"
                                    name="access_level"
                                    autocomplete="access_level"
                                    placeholder="access_level"
                                    class="form-control
                                    @error('age group') is-invalid @enderror"
                                    value="@if($book->access_level){{'Premium'}}@else{{'Free'}}@endif"
                                    required
                                    aria-describedby="nameHelp">

                                @error('age_group')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Inserted by') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input
                                    type="text"
                                    disabled
                                    id="user_id"
                                    name="user_id"
                                    autocomplete="user_id"
                                    placeholder="user_id"
                                    class="form-control
                                        @error('user_id') is-invalid @enderror"
                                    value="{{ $book->user->first_name }} {{ $book->user->last_name }}"
                                    required
                                    aria-describedby="nameHelp">

                                @error('user_id')
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
                                    value="{{ $book->created_at }}"
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
                                    value="{{ $book->updated_at }}"
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

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Pages') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group d-flex justify-content-center">
                                @foreach($book->pages as $page)
                                    <img class="rounded pr-1 pb-1" src="{{ asset('images/' . $page->page_image_url) }}" style="width:100px"/>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Audio') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                @if($page->audio_url)
                                    @foreach($book->pages as $page)
                                        <div class="d-flex flex-column justify-content-center" >
                                            <div>Audio from Page {{$page->page_index}}</div>
                                            <audio
                                                id="audio"
                                                controls
                                                class="rounded pr-1 pb-1"
                                                src={{ asset('audios/' . $page->audio_url) }}>
                                                Your browser does not support the
                                                <code>audio</code> element.
                                            </audio>
                                        </div>
                                    @endforeach
                                @else
                                    <input disabled
                                           class="form-control"
                                           placeholder="Can you hear it? Me neither, it's empty.">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Video') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group d-flex justify-content-center">
                                @if($book->video)
                                    <iframe class="rounded"
                                            width="280" height="157,5"
                                            src="{{$book->video->video_url}}"
                                            frameborder="0" gesture="media"
                                            allow="autoplay; encrypted-media"
                                            allowfullscreen>
                                    </iframe>
                                @else
                                    <input disabled
                                           class="form-control"
                                           placeholder="This book hopes to be worthy of a video one day.">
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="d-flex justify-content-center">
                @if($previous != 0)
                    <a href="{{url('admin/books/' . $previous)}}" type="button" class="btn btn-warning" style="width:150px">
                        Previous Book
                    </a>
                @endif
                    <a href="{{url('admin/books/')}}" type="button" class="btn btn-danger" style="width:150px">Return to List</a>
                @if($next != 0)
                    <a href="{{url('admin/books/' . $next)}}" type="button" class="btn btn-warning" style="width:150px">
                        Next Book
                    </a>
                @endif
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

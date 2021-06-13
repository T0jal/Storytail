@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form id="updateBook" method="POST" action="{{ url('admin/books/' . $book->id)  }}">
                        @csrf
                        @method('PUT')
                        <div class="card ">

                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Edit Book') }}</h4>
                                <p class="card-category">{{ __('Book information') }}</p>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Title*') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                id="title"
                                                name="title"
                                                autocomplete="title"
                                                placeholder="Book's name"
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
                                    <label class="col-sm-2 col-form-label">{{ __('Description*') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <textarea
                                                type="text"
                                                rows="4"
                                                id="description"
                                                name="description"
                                                autocomplete="description"
                                                placeholder="Describe the book in a few sentences"
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
                                    <label class="col-sm-2 col-form-label">{{ __('Read Time (Min)*') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                id="read_time"
                                                name="read_time"
                                                autocomplete="read_time"
                                                placeholder="Estimated reading time in minutes"
                                                class="form-control @error('read time') is-invalid @enderror"
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
                                                id="tags"
                                                name="tags"
                                                autocomplete="tags"
                                                placeholder="Add searchable keywords separated by a comma and a space (, ) like Adventure, Mystery, etc"
                                                class="form-control @error('tags') is-invalid @enderror"
                                                value="{{ $tags }}"
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
                                    <label class="col-sm-2 col-form-label">{{ __('Age Group (Years)*') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select name="age_group_id" class="form-control">
                                                    <option selected value = {{ $book->age_group_id }} >
                                                        {{ $book->ageGroup->age_group }}
                                                    </option>
                                                @foreach($ageGroups as $ageGroup)
                                                    @if($ageGroup->id != $book->age_group_id)
                                                        <option value = {{ $ageGroup->id }} >
                                                            {{ $ageGroup->age_group }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('age_group')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Is Active*') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select name="is_active" class="form-control">
                                                @if($book->is_active == 1)
                                                    <option selected value = 1 > Yes </option>
                                                    <option value = 0 > No </option>
                                                @else
                                                    <option value = 1 > Yes </option>
                                                    <option selected value = 0 > No </option>
                                                @endif
                                            </select>
                                            @error('is_active')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Access Level*') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select name="access_level" class="form-control">
                                                @if($book->access_level == 1)
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

                                <br>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Author') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select name="author_id[]" class="form-control" multiple style="height:130px">
                                                {{$currentBookAuthors[] = ''}}
                                                @foreach($book->authors as $currentAuthor)
                                                    {{$currentBookAuthors[] = $currentAuthor->id}}
                                                @endforeach
                                                @foreach($authors as $newAuthor)
                                                    @if(in_array($newAuthor->id, $currentBookAuthors))
                                                        <option selected value = {{ $newAuthor->id }} >
                                                            {{ $newAuthor->last_name }}, {{ $newAuthor->first_name }}
                                                        </option>
                                                    @else
                                                        <option value = {{ $newAuthor->id }} >
                                                            {{ $newAuthor->last_name }}, {{ $newAuthor->first_name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('author')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{url('admin/authors/create')}}" target="_blank" type="button" class="btn btn-success" style="width:170px">Add New Author</a>
                                            <button id="reloadAuthors" type="button" class="btn btn-warning" style="width:190px">Reload Authors' List</button>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Activities') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select name="activity_id[]" class="form-control" multiple style="height:130px">
                                                {{$currentActivities[] = ''}}
                                                @foreach($book->activityBooks as $activityBook)
                                                    {{$currentActivities[] = $activityBook->activity->id}}
                                                @endforeach
                                                @foreach($activities as $activity)
                                                    @if(in_array($activity->id, $currentActivities))
                                                        <option selected value = {{ $activity->id }} >
                                                            {{ $activity->title }}
                                                        </option>
                                                    @else
                                                        <option value = {{ $activity->id }} >
                                                            {{ $activity->title }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('activities')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{url('admin/activities/create')}}" target="_blank" type="button" class="btn btn-success" style="width:170px">Add New Activity</a>
                                            <button id="reloadActivities" type="button" class="btn btn-warning" style="width:190px">Reload Activities' List</button>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Current Cover') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <div class="d-flex justify-content-center">
                                                <img class="rounded pr-1 pb-1" alt="Image not found" src="{{ asset('images/' . $book->cover_url) }}" style="width:200px;"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('New Cover (.jpg File)') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <div>
                                                <label for="cover_url"></label>
                                                <input
                                                    type="file"
                                                    id="cover_url"
                                                    name="cover_url"
                                                    autocomplete="cover_url"
                                                    placeholder="Book's Cover URL"
                                                    value="{{ old('cover_url') }}"
                                                    aria-describedby="nameHelp">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button id=uploadCover type="button" class="btn btn-success" style="width:170px">Upload Cover</button>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Current Pages') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <div class="d-flex justify-content-center">
                                                @foreach($book->pages as $page)
                                                    <img class="rounded pr-1 pb-1" src="{{ asset('images/' . $page->page_image_url) }}" style="width:100px"/>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('New Pages (.jpg Files)') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <div>
                                                <label for="page_image_url"></label>
                                                <input
                                                    type="file"
                                                    multiple="multiple"
                                                    id="page_image_url"
                                                    name="page_image_url[]"
                                                    autocomplete="page_image_url"
                                                    placeholder="Book's pages"
                                                    value="{{ old('page_image_url') }}"
                                                    aria-describedby="nameHelp">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button id=uploadAllPages type="button" class="btn btn-success" style="width:170px">Upload All Pages</button>
                                        </div>
                                    </div>
                                </div>

                                @if($page->audio_url)
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('Current Audio') }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <div>
                                                    @foreach($book->pages as $page)
                                                        <div class="d-flex flex-column justify-content-center">
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Add Audio (.mp3 Files)') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <div>
                                                <label for="audio_url"></label>
                                                <input
                                                    type="file"
                                                    multiple="multiple"
                                                    id="audio_url"
                                                    name="audio_url[]"
                                                    autocomplete="audio_url"
                                                    placeholder="Page's Audios"
                                                    value="{{ old('audio_url') }}"
                                                    aria-describedby="nameHelp">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button id=uploadAllAudio type="button" class="btn btn-success" style="width:170px">Upload All Audio</button>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Video') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                                <input
                                                    type="text"
                                                    id="video_url"
                                                    name="video_url"
                                                    autocomplete="video_url"
                                                    placeholder="Youtube URL. Has to be an URL like https://www.youtube.com/embed/..."
                                                    class="form-control @error('read time') is-invalid @enderror"
                                                    value="@if($book->video){{{$book->video->video_url}}}@else{{{old('new_video_url')}}}@endif"
                                                    aria-describedby="nameHelp">
                                                <br>
                                            @error('new_video_url')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button id="previewVideo" type="button" class="btn btn-warning" style="width:150px">Preview Video</button>
                                        </div>

                                        <br>

                                        <div id="videoDiv" class="d-flex justify-content-center">
                                            <iframe id="video"
                                                    style="display:none"
                                                    class="rounded"
                                                    width="280" height="157,5"
                                                    src=""
                                                    frameborder="0" gesture="media"
                                                    allow="autoplay; encrypted-media"
                                                    allowfullscreen>
                                            </iframe>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <input
                                    hidden
                                    type="text"
                                    id="user_id"
                                    name="user_id"
                                    autocomplete="user_id"
                                    placeholder="user_id"
                                    class="form-control
                                    @error('user_id') is-invalid @enderror"
                                    value="{{ $book->user->first_name }} {{ $book->user->last_name }}"
                                    required
                                    aria-describedby="nameHelp">

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
@section('scripts')
    <script>

        //Reload Authors
        document.getElementById('reloadAuthors').onclick = function(e){
            location.reload();
        }

        //Reload Activities
        document.getElementById('reloadActivities').onclick = function(e){
            location.reload();
        }

        //Preview Video
        document.getElementById('previewVideo').onclick = function(e){
            location.reload();
        }
        let videoInput = document.getElementById("video_url");
        let videoPreview = document.getElementById("video");

        if (videoInput.value) {
            videoPreview.src = videoInput.value;
            $('#video').attr("style", "display:block");
        }
        else {
            $('#video').attr("style", "display:none");
        }

        //ALlows Images Preview
        FilePond.registerPlugin(FilePondPluginImagePreview);

        //Checks for Files Size
        FilePond.registerPlugin(FilePondPluginFileValidateSize);

        /*
        Inserting the component to upload the Cover Photo
        */
        const inputCover = document.querySelector('input[id="cover_url"]');
        const pondCover = FilePond.create( inputCover, {
            onaddfilestart: (file) => { isLoadingCheckCover(); },
            onprocessfile: (files) => { isLoadingCheckCover(); }
        });

        pondCover.setOptions({
            allowMultiple: false,
            instantUpload: false,
            allowFileSizeValidation: true,
            maxFileSize: '5MB',
            labelMaxFileSizeExceeded:'The file you are trying to upload is too big.',
            labelMaxFileSize: 'Maximum file size is {filesize}',
            server: {
                url : '/upload',
                headers : {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });

        document.getElementById('uploadCover').onclick = function(e){
            pondCover.processFiles();
        }

        function isLoadingCheckCover(){
            let isLoading = pondCover.getFiles().filter(x=>x.status !== 5).length !== 0;
            if(isLoading) {
                $('#updateBook [type="submit"]').attr("disabled", "disabled");
            } else {
                $('#updateBook [type="submit"]').removeAttr("disabled");
            }
        }

        /*
        Inserting the component to upload the Pages' Photos
        */
        const inputPages = document.querySelector('input[id="page_image_url"]');
        const pondPages = FilePond.create( inputPages, {
            onaddfilestart: (file) => { isLoadingCheckPages(); },
            onprocessfile: (files) => { isLoadingCheckPages(); }
        });

        pondPages.setOptions({
            allowMultiple:  true,
            instantUpload:  false,
            allowReorder:   true,
            allowFileSizeValidation: true,
            maxFileSize: '5MB',
            labelMaxFileSizeExceeded:'The file you are trying to upload is too big.',
            labelMaxFileSize: 'Maximum file size is {filesize}',
            server: {
                url : '/upload',
                headers : {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
        });

        document.getElementById('uploadAllPages').onclick = function(e){
            pondPages.processFiles();
        }

        function isLoadingCheckPages(){
            let isLoading = pondPages.getFiles().filter(x=>x.status !== 5).length !== 0;
            if(isLoading) {
                $('#updateBook [type="submit"]').attr("disabled", "disabled");
            } else {
                $('#updateBook [type="submit"]').removeAttr("disabled");
            }
        }

        /*
        Inserting the component to upload the Audio Files
        */
        const inputAudio = document.querySelector('input[id="audio_url"]');
        const pondAudio = FilePond.create( inputAudio, {
            onaddfilestart: (file) => { isLoadingCheckAudio(); },
            onprocessfile: (files) => { isLoadingCheckAudio(); }
        });

        pondAudio.setOptions({
            allowMultiple:  true,
            instantUpload:  false,
            allowReorder:   true,
            allowFileSizeValidation: true,
            maxFileSize: '10MB',
            labelMaxFileSizeExceeded:'The file you are trying to upload is too big.',
            labelMaxFileSize: 'Maximum file size is {filesize}',
            server: {
                url : '/upload',
                headers : {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });

        document.getElementById('uploadAllAudio').onclick = function(e){
            pondAudio.processFiles();
        }

        function isLoadingCheckAudio(){
            let isLoading = pondAudio.getFiles().filter(x=>x.status !== 5).length !== 0;
            if(isLoading) {
                $('#updateBook [type="submit"]').attr("disabled", "disabled");
            } else {
                $('#updateBook [type="submit"]').removeAttr("disabled");
            }
        }

    </script>
@endsection

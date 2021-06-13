@section('content')
    <body>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form id="createBook" method="POST" action="{{ url('admin/books')}}">
                            @csrf
                            <div class="card ">

                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">{{ __('Create Book') }}</h4>
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
                                                    value="{{ old('title') }}"
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
                                                    placeholder="Describe the book in a few sentences"
                                                    autocomplete="description"
                                                    class="form-control @error('description') is-invalid @enderror"
                                                    required
                                                    aria-describedby="nameHelp">{{ old('description') }}</textarea>
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
                                                    value="{{ old('read_time') }}"
                                                    required
                                                    aria-describedby="nameHelp"
                                                    class="form-control @error('read_time') is-invalid @enderror">
                                                @error('read_time')
                                                    <div class="alert alert-danger"> {{ $message }} </div>
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
                                                    value="{{ old('tags') }}"
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
                                                    @foreach($ageGroups as $ageGroup)
                                                        <option value = {{ $ageGroup->id }} >
                                                            {{ $ageGroup->age_group }}
                                                        </option>
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
                                                    <option selected Value = 1> Yes </option>
                                                    <option value = 0> No </option>
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
                                                    <option selected value = 0>
                                                        Free
                                                    </option>
                                                    <option value = 1>
                                                        Premium
                                                    </option>
                                                </select>
                                                @error('$book->access_level')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('Author(s)') }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <select name="author_id[]" class="form-control" multiple style="height:130px">
                                                    @foreach($authors as $author)
                                                        <option value="{{ $author->id }}">
                                                            {{ $author->last_name }}, {{ $author->first_name }}
                                                        </option>
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
                                                    @foreach($activities as $activity)
                                                        <option value="{{ $activity->id }}">
                                                            {{ $activity->title }}
                                                        </option>
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
                                                    value="{{ old('video_url') }}"
                                                    aria-describedby="nameHelp">
                                                @error('video')
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

                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('Cover Image (.jpg File)*')}}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <div>
                                                    <label for="cover_url"></label>
                                                    <input
                                                        type="file"
                                                        id="cover_url"
                                                        name="cover_url"
                                                        autocomplete="cover_url"
                                                        placeholder="Book's cover_url"
                                                        value="{{ old('cover_url') }}"
                                                        required
                                                        aria-describedby="nameHelp">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <button id=uploadCover type="button" class="btn btn-success" style="width:170px">Upload Cover</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __("Pages Images (.jpg Files)*") }}</label>
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
                                                        required
                                                        aria-describedby="nameHelp">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <button id=uploadAllPages type="button" class="btn btn-success" style="width:170px">Upload All Pages</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('Pages Audio (.mp3 Files)') }}</label>
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
                                                        placeholder="Pages's Audio"
                                                        value="{{ old('audio_url') }}"
                                                        aria-describedby="nameHelp">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <button id=uploadAllAudio type="button" class="btn btn-success" style="width:170px">Upload All Audio</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <input
                                                    hidden
                                                    type="text"
                                                    id="user_id"
                                                    name="user_id"
                                                    autocomplete="user_id"
                                                    placeholder="User ID"
                                                    class="form-control
                                                    @error('user_id') is-invalid @enderror"
                                                    value="1"
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
                                </div>
                            </div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success" style="width:100px">Save</button>
                                <a href="{{url('admin/books/')}}" type="button" class="btn btn-danger" style="width:100px">Return</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
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
        else{
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
                $('#createBook [type="submit"]').attr("disabled", "disabled");
            } else {
                $('#createBook [type="submit"]').removeAttr("disabled");
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
                $('#createBook [type="submit"]').attr("disabled", "disabled");
            } else {
                $('#createBook [type="submit"]').removeAttr("disabled");
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
                $('#createBook [type="submit"]').attr("disabled", "disabled");
            } else {
                $('#createBook [type="submit"]').removeAttr("disabled");
            }
        }

    </script>
@endsection

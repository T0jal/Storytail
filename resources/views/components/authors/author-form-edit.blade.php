@section('content')
    <body>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form id="editAuthor" method="POST" action="{{ url('admin/authors/' . $author->id)  }}">
                            @csrf
                            @method('PUT')
                            <div class="card ">

                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">{{ __('Edit Author') }}</h4>
                                    <p class="card-category">{{ __('Author information') }}</p>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('First Name') }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <input
                                                    type="text"
                                                    id="first_name"
                                                    name="first_name"
                                                    autocomplete="first_name"
                                                    placeholder="First Name"
                                                    class="form-control  @error('title') is-invalid @enderror"
                                                    value="{{ $author->first_name }}"
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
                                                autocomplete="last_name"
                                                placeholder="Last Name"
                                                class="form-control @error('title') is-invalid @enderror"
                                                value="{{ $author->last_name }}"
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
                                        <label class="col-sm-2 col-form-label">{{ __('Current Author Photo') }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group d-flex justify-content-center">
                                                <div>
                                                    <img class="rounded pr-1 pb-1" src="{{ asset('images/' . $author->author_photo_url) }}" style="width:200px;"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('New Author Photo') }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <div>
                                                    <label for="cover_url"></label>
                                                    <input
                                                        type="file"
                                                        id="author_photo_url"
                                                        name="author_photo_url"
                                                        autocomplete="author_photo_url"
                                                        placeholder="Author's photo"
                                                        value="{{ old('author_photo_url') }}"
                                                        aria-describedby="nameHelp">
                                                </div>
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
                                                    id="description"
                                                    name="description"
                                                    autocomplete="description"
                                                    class="form-control  @error('description') is-invalid @enderror"
                                                    required
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
                                        <label class="col-sm-2 col-form-label">{{ __('Country of Origin') }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                            <input
                                                type="text"
                                                id="nationality"
                                                name="nationality"
                                                autocomplete="nationality"
                                                placeholder="Exe: Nicaragua, Djibouti, Burkina Faso, Tajikistan,..."
                                                class="form-control  @error('read time') is-invalid @enderror"
                                                value="{{ $author->nationality }}"
                                                required
                                                aria-describedby="nameHelp">
                                                @error('nationality')
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
                                <button type="submit" class="btn btn-success" style="width:150px">Update</button>
                                <a href="{{url('admin/authors/')}}" type="button" class="btn btn-danger" style="width:150px">Return to List</a>
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
        //Allows Image Preview
        FilePond.registerPlugin(FilePondPluginImagePreview);

        //Checks for Files Size
        FilePond.registerPlugin(FilePondPluginFileValidateSize);

        const inputAuthor = document.querySelector('input[id="author_photo_url"]');
        const pondAuthor = FilePond.create(inputAuthor, {
            onaddfilestart: (file) => { isLoadingCheck(); },
            onprocessfile: (files) => { isLoadingCheck(); }
        });

        pondAuthor.setOptions({
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

        function isLoadingCheck(){
            let isLoading = pondAuthor.getFiles().filter(x=>x.status !== 5).length !== 0;
            if(isLoading) {
                $('#editAuthor [type="submit"]').attr("disabled", "disabled");
            } else {
                $('#editAuthor [type="submit"]').removeAttr("disabled");
            }
        }

    </script>
@endsection

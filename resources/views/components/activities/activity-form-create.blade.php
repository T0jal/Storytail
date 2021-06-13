@section('content')
    <body>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form id="createActivity" method="POST" action="{{ url('admin/activities/')}}">
                            @csrf
                            <div class="card ">

                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">{{ __('Create Activity') }}</h4>
                                    <p class="card-category">{{ __('Activity information') }}</p>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('Title') }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <input
                                                    type="text"
                                                    id="title"
                                                    name="title"
                                                    autocomplete="title"
                                                    placeholder="Activity's name"
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
                                        <label class="col-sm-2 col-form-label">{{ __('Description') }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <textarea
                                                    type="text"
                                                    rows="6"
                                                    id="description"
                                                    name="description"
                                                    placeholder="Describe the activity in a few sentences"
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
                                        <label class="col-sm-2 col-form-label">{{ __("Images") }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <div>
                                                    <label for="image_url"></label>
                                                    <input
                                                        type="file"
                                                        multiple="multiple"
                                                        id="image_url"
                                                        name="image_url[]"
                                                        autocomplete="image_url"
                                                        placeholder="Activity's Images"
                                                        value="{{ old('image_url') }}"
                                                        aria-describedby="nameHelp">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <button id=uploadAllImages type="button" class="btn btn-success" style="width:170px">Upload All Images</button>
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success" style="width:100px">Save</button>
                                <a href="{{url('admin/activities/')}}" type="button" class="btn btn-danger" style="width:100px">Return</a>
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

        const inputImages = document.querySelector('input[id="image_url"]');
        const pondImages = FilePond.create( inputImages, {
            onaddfilestart: (file) => { isLoadingCheck(); },
            onprocessfile: (files) => { isLoadingCheck(); }
        });

        pondImages.setOptions({
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

        document.getElementById('uploadAllImages').onclick = function(e){
            pondImages.processFiles();
        }

        function isLoadingCheck(){
            let isLoading = pondImages.getFiles().filter(x=>x.status !== 5).length !== 0;
            if(isLoading) {
                $('#createActivity [type="submit"]').attr("disabled", "disabled");
            } else {
                $('#createActivity [type="submit"]').removeAttr("disabled");
            }
        }

    </script>
@endsection

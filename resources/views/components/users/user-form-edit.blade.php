@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ url('admin/users/' . $user->id)  }}">
                        @csrf
                        @method('PUT')
                        <div class="card ">

                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Edit User') }}</h4>
                                <p class="card-category">{{ __('User Information') }}</p>
                            </div>

                            <div class="card-body">

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('First Name*') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                id="first_name"
                                                name="first_name"
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
                                    <label class="col-sm-2 col-form-label">{{ __('Last Name*') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                id="last_name"
                                                name="last_name"
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
                                    <label class="col-sm-2 col-form-label">{{ __('Username*') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                id="user_name"
                                                name="user_name"
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
                                    <label class="col-sm-2 col-form-label">{{ __('Email*') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input
                                                type="email"
                                                id="email"
                                                name="email"
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
                                    <label class="col-sm-2 col-form-label">{{ __('Password') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                id="password"
                                                name="password"
                                                autocomplete="password"
                                                placeholder="The password is hidden. Write a new password to update."
                                                value="{{ old('password') }}"
                                                aria-describedby="nameHelp"
                                                class="form-control @error('email') is-invalid @enderror">
                                            @error('password')
                                            <div class="alert alert-danger"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Plan') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select name="plan_id" class="form-control">
                                                @if($subscription)
                                                    <option selected value = {{ $subscription->plan_id }} >
                                                        {{ $subscription->plan->name }}
                                                    </option>
                                                    @foreach($plans as $plan)
                                                        @if($plan->id != $subscription->plan_id)
                                                            <option value = {{ $plan->id }} >
                                                                {{ $plan->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <option selected value = 1 >
                                                        Free
                                                    </option>
                                                    @foreach($plans as $plan)
                                                        @if($plan->id != 1)
                                                            <option value = {{ $plan->id }} >
                                                                {{ $plan->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('plan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('User Type') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select name="user_type_id" class="form-control">
                                                @if($user->user_type_id == 1)
                                                    <option selected value = 1 > Admin </option>
                                                    <option value = 2 > User </option>
                                                @else
                                                    <option value = 1 > Admin </option>
                                                    <option selected value = 2 > User </option>
                                                @endif
                                            </select>
                                            @error('user_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Current User Photo') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group d-flex justify-content-center">
                                            <div>
                                                <img class="rounded pr-1 pb-1" src="{{ asset('images/' . $user->user_photo_url) }}" style="width:200px;"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('New User Photo')}}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <div>
                                                <label for="user_photo_url"></label>
                                                <input
                                                    type="file"
                                                    id="user_photo_url"
                                                    name="user_photo_url"
                                                    autocomplete="user_photo_url"
                                                    placeholder="Book's user_photo_url"
                                                    value="{{ $user->user_photo_url }}"
                                                    aria-describedby="nameHelp">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button id=uploadUser type="button" class="btn btn-success" style="width:170px">Upload Photo</button>
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
@section('scripts')
    <script>
        //Allows Image Preview
        FilePond.registerPlugin(FilePondPluginImagePreview);

        //Checks for Files Size
        FilePond.registerPlugin(FilePondPluginFileValidateSize);

        const inputUser = document.querySelector('input[id="user_photo_url"]');
        const pondUser = FilePond.create(inputUser, {
            onaddfilestart: (file) => { isLoadingCheck(); },
            onprocessfile: (files) => { isLoadingCheck(); }
        });

        pondUser.setOptions({
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

        document.getElementById('uploadUser').onclick = function(e){
            pondUser.processFiles();
        }

        function isLoadingCheck(){
            let isLoading = pondUser.getFiles().filter(x=>x.status !== 5).length !== 0;
            if(isLoading) {
                $('#createUser [type="submit"]').attr("disabled", "disabled");
            } else {
                $('#createUser [type="submit"]').removeAttr("disabled");
            }
        }
    </script>
@endsection

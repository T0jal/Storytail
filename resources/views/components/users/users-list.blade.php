<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Users Table</h4>
                        <p class="card-category"> All the registered users</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                    <th>
                                        <a
                                            @if(Route::current()->getName() == 'users')
                                            href="{{url('admin/users/idAsc')}}"
                                            @else
                                            href="{{url('admin/users/')}}"
                                            @endif>
                                            <u>ID</u>
                                        </a>
                                    </th>

                                    <th> Photo </th>

                                    <th>
                                        <a
                                            @if(Route::current()->getName() == 'usersByNameAtoZ')
                                                href="{{url('admin/users/nameZtoA')}}"
                                            @else
                                                href="{{url('admin/users/nameAtoZ')}}"
                                            @endif>
                                            <u>Name</u>
                                        </a>
                                    </th>
                                    <th>
                                        <a
                                            @if(Route::current()->getName() == 'usersByUsernameAtoZ')
                                                href="{{url('admin/users/usernameZtoA')}}"
                                            @else
                                                href="{{url('admin/users/usernameAtoZ')}}"
                                            @endif>
                                            <u>Username</u>
                                        </a>
                                    </th>

                                    <th>
                                        <a
                                            @if(Route::current()->getName() == 'usersByEmailAtoZ')
                                            href="{{url('admin/users/emailZtoA')}}"
                                            @else
                                            href="{{url('admin/users/emailAtoZ')}}"
                                            @endif>
                                            <u>Email</u>
                                        </a>
                                    </th>

                                    <th>
                                        <a
                                            @if(Route::current()->getName() == 'usersByUserTypeAtoZ')
                                            href="{{url('admin/users/userTypeZtoA')}}"
                                            @else
                                            href="{{url('admin/users/userTypeAtoZ')}}"
                                            @endif>
                                            <u>User Type</u>
                                        </a>
                                    </th>

                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr >
                                        <td> {{ $user->id }}</td>

                                        <td><img class="rounded pr-1 pb-1" src="{{ asset('images/' . $user->user_photo_url) }}" style="width:120px;"/></td>

                                        <td> {{ $user->last_name }}, {{ $user->first_name }}</td>

                                        <td>{{$user->user_name}}</td>

                                        <td>{{$user->email}}</td>

                                        @if ($user->user_type_id == 1)
                                            <td> Admin </td>
                                        @else
                                            <td> User </td>
                                        @endif

                                        <td>
                                            <div>
                                                <a href="{{url('admin/users/' . $user->id)}}" type="button"
                                                     class="btn btn-success btn-sm" style="width:100px">Show</a>
                                            </div>
                                            <div>
                                                <a href="{{url('admin/users/' . $user->id . '/edit')}}" type="button"
                                                    class="btn btn-primary btn-sm" style="width:100px">Edit</a>
                                            </div>
                                            <div>
                                                <form action="{{url('admin/users/' . $user->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            style="width:100px">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">{{ $users->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

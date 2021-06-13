<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Authors Table</h4>
                        <p class="card-category"> All the authors available on the website</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                <th>
                                    <a
                                        @if(Route::current()->getName() == 'authors')
                                            href="{{url('admin/authors/idAsc')}}"
                                        @else
                                        href="{{url('admin/authors/')}}"
                                        @endif>
                                            <u>ID</u>
                                    </a>
                                </th>

                                <th> Picture </th>

                                <th>
                                    <a
                                        @if(Route::current()->getName() == 'authorsByNameAtoZ')
                                            href="{{url('admin/authors/nameZtoA')}}"
                                        @else
                                            href="{{url('admin/authors/nameAtoZ')}}"
                                        @endif>
                                            <u>Name</u>
                                    </a>
                                </th>
                                <th> Nationality </th>
                                <th >Actions </th>
                                </thead>
                                <tbody>
                                @foreach($authors as $author)
                                    <tr >
                                        <td> {{ $author->id }}</td>

                                        <td><img class="rounded pr-1 pb-1" src="{{ asset('images/' . $author->author_photo_url) }}" style="width:120px;"/></td>

                                        <td> {{ $author->last_name}}, {{ $author->first_name }}</td>

                                        <td> {{ $author->nationality }} </td>

                                        <td>
                                            <div>
                                                <a href="{{url('admin/authors/' . $author->id)}}" type="button"
                                                   class="btn btn-success btn-sm" style="width:100px">Show</a>
                                            </div>
                                            <div>
                                                <a href="{{url('admin/authors/' . $author->id . '/edit')}}" type="button"
                                                    class="btn btn-primary btn-sm" style="width:100px">Edit</a>
                                            </div>
                                            <div>
                                                <form action="{{url('admin/authors/' . $author->id)}}" method="POST">
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
                            <div class="d-flex justify-content-center">{{ $authors->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


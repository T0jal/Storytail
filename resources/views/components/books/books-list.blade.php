<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Books Table</h4>
                        <p class="card-category"> All the books available on the website</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                <th>
                                    <a
                                        @if(Route::current()->getName() == 'books')
                                        href="{{url('admin/books/idAsc')}}"
                                        @else
                                        href="{{url('admin/books/')}}"
                                        @endif>
                                        <u>ID</u>
                                    </a>
                                </th>

                                <th> Cover </th>

                                <th>
                                    <a
                                        @if(Route::current()->getName() == 'booksByTitleAtoZ')
                                        href="{{url('admin/books/titleZtoA')}}"
                                        @else
                                        href="{{url('admin/books/titleAtoZ')}}"
                                        @endif>
                                        <u>Title</u>
                                    </a>
                                </th>
                                <th> Author(s) </th>
                                <th> No. of Pages </th>
                                <th> Video </th>
                                <th> Access Level </th>
                                <th > Is Active </th>
                                <th >Actions </th>
                                </thead>
                                <tbody>
                                @foreach($books as $book)
                                    <tr >
                                        <td> {{ $book->id }}</td>

                                        <td><img class="rounded pr-1 pb-1" src="{{ asset('images/' . $book->cover_url) }}" style="width:120px;"/></td>

                                        <td> {{ $book->title }}</td>

                                        <td>
                                            @foreach($book->authors as $author)
                                                <a href="{{url('admin/authors/' . $author->id)}}">
                                                        {{$loop->first ? '' : ', '}}
                                                        <u>{{$author->first_name}} {{$author->last_name}}</u>
                                                </a>
                                            @endforeach
                                        </td>

                                        <td> {{$book->pages_count}} </td>

                                        @if ($book->video)
                                            <td> Yes </td>
                                        @else
                                            <td> No </td>
                                        @endif

                                        @if ($book->access_level)
                                            <td> Premium </td>
                                        @else
                                            <td> Free </td>
                                        @endif

                                        @if ($book->is_active)
                                            <td> Yes </td>
                                        @else
                                            <td> No </td>
                                        @endif
                                        <td>
                                            <div>
                                                <a href="{{url('admin/books/' . $book->id)}}" type="button"
                                                     class="btn btn-success btn-sm" style="width:100px">Show</a>
                                            </div>
                                            <div>
                                                <a href="{{url('admin/books/' . $book->id . '/edit')}}" type="button"
                                                    class="btn btn-primary btn-sm" style="width:100px">Edit</a>
                                            </div>
                                            <div>
                                                <form action="{{url('admin/books/' . $book->id)}}" method="POST">
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
                            <div class="d-flex justify-content-center">{{ $books->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Activities Table</h4>
                        <p class="card-category"> All the activities available on the website</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                <th>
                                    <a
                                        @if(Route::current()->getName() == 'activities')
                                        href="{{url('admin/activities/idAsc')}}"
                                        @else
                                        href="{{url('admin/activities/')}}"
                                        @endif>
                                        <u>ID</u>
                                    </a>
                                </th>

                                <th> Image </th>

                                <th>
                                    <a
                                        @if(Route::current()->getName() == 'activitiesByTitleAtoZ')
                                        href="{{url('admin/activities/titleZtoA')}}"
                                        @else
                                        href="{{url('admin/activities/titleAtoZ')}}"
                                        @endif>
                                        <u>Title</u>
                                    </a>
                                </th>
                                <th> No. of Images </th>
                                <th >Actions </th>
                                </thead>
                                <tbody>
                                @foreach($activities as $activity)
                                    <tr >
                                        <td> {{ $activity->id }}</td>

                                        <td>
                                            @foreach($activity->activityImages as $image)
                                                <img class="rounded pr-1 pb-1" src="{{ asset('images/' . $image->image_url) }}" style="width:150px"/>
                                                @break
                                            @endforeach
                                        </td>

                                        <td> {{ $activity->title }}</td>

                                        <td> {{$activity->activity_images_count}} </td>

                                        <td>
                                            <div>
                                                <a href="{{url('admin/activities/' . $activity->id)}}" type="button"
                                                   class="btn btn-success btn-sm" style="width:100px">Show</a>
                                            </div>

                                            <div>
                                                <a href="{{url('admin/activities/' . $activity->id . '/edit')}}" type="button"
                                                    class="btn btn-primary btn-sm" style="width:100px">Edit</a>
                                            </div>
                                            <div>
                                                <form action="{{url('admin/activities/' . $activity->id)}}" method="POST">
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
                            <div class="d-flex justify-content-center">{{ $activities->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Plans Table</h4>
                        <p class="card-category"> All the plans available on the website</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                <th>
                                    <a
                                        @if(Route::current()->getName() == 'plans')
                                        href="{{url('admin/plans/idAsc')}}"
                                        @else
                                        href="{{url('admin/plans/')}}"
                                        @endif>
                                        <u>ID</u>
                                    </a>
                                </th>

                                <th>
                                    <a
                                        @if(Route::current()->getName() == 'plansByNameAtoZ')
                                        href="{{url('admin/plans/nameZtoA')}}"
                                        @else
                                        href="{{url('admin/plans/nameAtoZ')}}"
                                        @endif>
                                        <u>Name</u>
                                    </a>
                                </th>

                                <th> Price </th>
                                <th> Duration </th>
                                <th> Access Level </th>
                                <th >Actions </th>
                                </thead>
                                <tbody>
                                @foreach($plans as $plan)
                                    <tr >
                                        <td> {{ $plan->id }}</td>

                                        <td> {{ $plan->name }}</td>

                                        <td> {{ $plan->price . ' €' }} </td>

                                        @if($plan->duration == 0)
                                            <td></td>
                                        @else
                                            <td> {{ $plan->duration . ' days' }} </td>
                                        @endif

                                        @if ($plan->access_level)
                                            <td> Premium </td>
                                        @else
                                            <td> Free </td>
                                        @endif

                                        <td>
                                            <div>
                                                <a href="{{url('admin/plans/' . $plan->id)}}" type="button"
                                                   class="btn btn-success btn-sm" style="width:100px">Show</a>
                                            </div>
                                            <div>
                                                <a href="{{url('admin/plans/' . $plan->id . '/edit')}}" type="button"
                                                    class="btn btn-primary btn-sm" style="width:100px">Edit</a>
                                            </div>
                                            <div>
                                                <form action="{{url('admin/plans/' . $plan->id)}}" method="POST">
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
                            <div class="d-flex justify-content-center">{{ $plans->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

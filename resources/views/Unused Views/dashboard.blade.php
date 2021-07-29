@extends('master.main', ['activePage' => 'Unused Views.dashboard', 'titlePage' => __('Unused Views.dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
        <div class="container-fluid px-0">
            <div class="row">
                <div class="col-md-12">
                    <img src="{{ asset('images/welcome.jpg') }}" alt="welcome" class="img-fluid rounded" />
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush

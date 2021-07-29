<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top">
  <div class="container-fluid">
    <div class="navbar-wrapper">
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
    <span class="sr-only">Toggle navigation</span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" style="padding-top: 25px; padding-right: 25px">
        <div class="ml-3">
            <a href="{{url('/')}}" type="button" class="btn btn-warning btn-sm">Website</a>
        </div>
        <div class="ml-3">
            <a href="{{url('/admin/logout')}}" type="button" class="btn btn-danger btn-sm">Logout</a>
        </div>
      </ul>
    </div>
  </div>
</nav>

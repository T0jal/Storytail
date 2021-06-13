<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="{{url('/admin')}}" class="simple-text logo-normal" style="color:orange">
        <img src="{{asset('images/logo_transparent.png')}}" style="width: 100px" alt="" class="rounded"/>
    </a>
  </div>
  <div class="sidebar-wrapper">
      <ul class="nav">
          <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('home') }}">
              <i class="material-icons">dashboard</i>
                <p>{{ __('Dashboard') }}</p>
            </a>
          </li>
          <li class="nav-item{{ $activePage == 'books' ? ' active' : '' }}">
            <a class="nav-link" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="material-icons">library_books</i>
                <p>{{ __('Books') }}</p>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="nav-link" href="{{ route('books') }}">Book's List</a>
                <a class="nav-link" href="{{ route('addBook') }}">Add Book</a>
            </div>
          </li>
          <li class="nav-item{{ $activePage == 'authors' ? ' active' : '' }}">
              <a class="nav-link" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">people</i>
                  <p>{{ __('Authors') }}</p>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="nav-link" href="{{ route('authors') }}">Author's List</a>
                  <a class="nav-link" href="{{ route('addAuthor') }}">Add Author</a>
              </div>
          </li>
          <li class="nav-item{{ $activePage == 'activities' ? ' active' : '' }}">
              <a class="nav-link" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">content_paste</i>
                  <p>{{ __('Activities') }}</p>
              </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="nav-link" href="{{ route('activities') }}">Activities' List</a>
                    <a class="nav-link" href="{{ route('addActivity') }}">Add Activity</a>
                </div>
          </li>
          <li class="nav-item{{ $activePage == 'plans' ? ' active' : '' }}">
              <a class="nav-link" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">euro</i>
                  <p>{{ __('Plans') }}</p>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="nav-link" href="{{ route('plans') }}">Plans' List</a>
                  <a class="nav-link" href="{{ route('addPlan') }}">Add Plan</a>
              </div>
          </li>
{{--        <li class="nav-item{{ $activePage == 'users' ? ' active' : '' }}">--}}
{{--        <a class="nav-link" href="{{ route('map') }}">--}}
{{--          <i class="material-icons">library_books</i>--}}
{{--            <p>{{ __('Users') }}</p>--}}
{{--        </a>--}}
{{--      </li>--}}
    </ul>
  </div>
</div>

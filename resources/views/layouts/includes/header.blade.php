
 <!-- partial:partials/_horizontal-navbar.html -->
    <div class="horizontal-menu">
      <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container-fluid">
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
            <ul class="navbar-nav navbar-nav-left">
              <li class="nav-item ml-0 mr-5 d-lg-flex d-none">
                <a href="#" class="nav-link horizontal-nav-left-menu"><i class="mdi mdi-format-list-bulleted"></i></a>
              </li>


              <li class="nav-item nav-search d-none d-lg-block ml-3">

              </li>

            </ul>

            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="{{url('/')}}"><img src="{{asset('images/tandaza-logo.png')}}" alt="logo"/></a>
                <a class="navbar-brand brand-logo-mini" href="{{url('/')}}"><img src="{{asset('images/tandaza-logo.png')}}" alt="logo"/></a>
            </div>

            <ul class="navbar-nav navbar-nav-right">

                <li class="nav-item nav-profile dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <span class="nav-profile-name">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                    <span class="online-status"></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                      <a class="dropdown-item" href="{{route('users.index')}}">
                        <i class="mdi mdi-settings text-primary"></i>
                        Users
                      </a>
                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout text-primary"></i>
                        Logout
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </div>
      </nav>
      <nav class="bottom-navbar">

      </nav>
    </div>

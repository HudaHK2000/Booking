<nav class="pcoded-navbar  ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div " >
            
            <div class="">
                <div class="main-menu-header">
                    {{-- <img class="img-radius" src="{{ asset('assets_dashboard/images/user/avatar-2.jpg')}}" alt="User-Profile-Image"> --}}
                    <div class="user-details">
                        {{-- <span>{{ Auth::user()->name }}</span> --}}
                        <div id="more-details">{{ Auth::user()->name }}<i class="fa fa-chevron-down m-l-5"></i></div>
                    </div>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="list-unstyled">
                        {{-- <li class="list-group-item"><a href="user-profile.html"><i class="feather icon-user m-r-5"></i>View Profile</a></li> --}}
                        {{-- <li class="list-group-item"><a href="#!"><i class="feather icon-settings m-r-5"></i>Settings</a></li> --}}
                        <li class="list-group-item">
                            <a href="{{ route('logout') }}"  onclick="event.preventDefault();document.getElementById('logout-form').submit();" >
                                <i class="feather icon-log-out m-r-5"></i>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            
            <ul class="nav pcoded-inner-navbar ">
                {{-- <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ url('home') }}" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather icon-home"></i>
                        </span>
                        <span class="pcoded-mtext">Home</span></a>
                </li>
                {{-- start li  --}}
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather icon-layout"></i>
                        </span>
                        <span class="pcoded-mtext">Country</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ url('country/create') }}" >Add</a></li>
                        <li><a href="{{ url('country') }}" >show</a></li>
                    </ul>
                </li>
                {{-- end li  --}}
                {{-- start li  --}}
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather icon-layout"></i>
                        </span>
                        <span class="pcoded-mtext">City</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ url('city/create') }}" >Add</a></li>
                        <li><a href="{{ url('city') }}" >show</a></li>
                    </ul>
                </li>
                {{-- end li  --}}

                {{-- start li  --}}
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather icon-layout"></i>
                        </span>
                        <span class="pcoded-mtext">Airport</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ url('airport/create') }}" >Add</a></li>
                        <li><a href="{{ url('airport') }}" >Show</a></li>
                    </ul>
                </li>
                {{-- end li  --}}
                {{-- start li  --}}
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather icon-layout"></i>
                        </span>
                        <span class="pcoded-mtext">Airline</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ url('airline/create') }}" >Add</a></li>
                        <li><a href="{{ url('airline') }}">Show</a></li>
                    </ul>
                </li>
                {{-- end li  --}}
                {{-- start li  --}}
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather icon-layout"></i>
                        </span>
                        <span class="pcoded-mtext">Airplane</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ url('airplane/create') }}" >Add</a></li>
                        <li><a href="{{ url('airplane') }}">Show</a></li>
                    </ul>
                </li>
                {{-- end li  --}}

                {{-- start li  --}}
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather icon-layout"></i>
                        </span>
                        <span class="pcoded-mtext">Direction</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ url('direction/create') }}" >Add</a></li>
                        <li><a href="{{ url('direction') }}">Show</a></li>
                    </ul>
                </li>
                {{-- end li  --}}

                 {{-- start li  --}}
                 <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather icon-layout"></i>
                        </span>
                        <span class="pcoded-mtext">Flights Schedules</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ url('flightSchedule/create') }}" >Add</a></li>
                        <li><a href="{{ url('flightSchedule') }}">Show</a></li>
                    </ul>
                </li>
                {{-- end li  --}}
                {{-- start li  --}}
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather icon-layout"></i>
                        </span>
                        <span class="pcoded-mtext">Booking</span>
                    </a>
                    <ul class="pcoded-submenu">
                        {{-- <li><a href="{{ url('flightSchedule/create') }}" >Add</a></li> --}}
                        <li><a href="{{ url('booking') }}">Show</a></li>
                    </ul>
                </li>
                {{-- end li  --}}
                {{-- start li  --}}
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link ">
                        <span class="pcoded-micon">
                            <i class="feather icon-layout"></i>
                        </span>
                        <span class="pcoded-mtext">Users</span>
                    </a>
                    <ul class="pcoded-submenu">
                        {{-- <li><a href="{{ url('flightSchedule/create') }}" >Add</a></li> --}}
                        <li><a href="{{ url('user') }}">Show</a></li>
                    </ul>
                </li>
                {{-- end li  --}}
            </ul>
        </div>
    </div>
</nav>
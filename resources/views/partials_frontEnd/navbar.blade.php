<!-- main-menu Start -->
<header class="top-area">
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="logo">
                        <a href="{{ url('home') }}">
                            tour<span>Nest</span>
                        </a>
                    </div><!-- /.logo-->
                </div><!-- /.col-->
                <div class="col-sm-10">
                    <div class="main-menu">
                    
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button><!-- / button-->
                        </div><!-- /.navbar-header-->
                        <div class="collapse navbar-collapse">      
                            <ul class="nav navbar-nav navbar-right">
                                <li class="@if (Request::is('home')) smooth-menu @endif"><a href="@if (Request::is('home')) #home @else {{ url('home') }} @endif">home</a></li>
                                <li class="smooth-menu"><a href="#pack">Flight </a></li>
                                <li class="smooth-menu"><a href="#blog">Travel Class</a></li>
                                <li class="dropdown @if (Request::is('profile')) active @endif">
                                    @guest
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">User <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu" style="background-color: #4D4E54;">
                                        @if (Route::has('login'))
                                                <li><a href="{{ route('login') }}">{{ ('Login') }}</a></li>
                                        @endif
                                        @if (Route::has('register'))
                                                <li><a href="{{ route('register') }}">{{ ('Register') }}</a></li>
                                        @endif
                                        </ul>
                                    @else
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu" style="background-color: #4D4E54;">
                                            @if (Auth::user()&& Auth::user()->is_admin == 1)
                                                <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                                            @endif
                                            @if(Auth::user()&&Auth::user()->passenger)
                                                <li class=" @if (Request::is('profile')) active @endif"><a href="{{ url('profile') }}">profile</a></li>
                                            @endif
                                            <li>
                                                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                            </li>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </ul>
                                    @endguest
                                </li>
                                {{-- <li><button class="book-btn">book now</button></li> --}}
                            </ul>
                        </div><!-- /.navbar-collapse -->
                        
                    </div><!-- /.main-menu-->
                </div><!-- /.col-->
            </div><!-- /.row -->
            <div class="home-border"></div><!-- /.home-border-->
        </div><!-- /.container-->
    </div><!-- /.header-area -->

</header><!-- /.top-area-->
<!-- main-menu End -->
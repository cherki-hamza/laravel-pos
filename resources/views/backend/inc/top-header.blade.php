 <header class="main-header">

        <!-- Logo -->
        <a href="" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>C</b>H</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>{{ __('words.DASHBOARD')}}</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>



            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">

              {{--   <ul class="nav navbar-nav">

                    <a href="#">
                       <li style="margin-top: 15px;" class="my-5">Perspectives
                        <i class="fa fa-bell text-primary"><span style="color:red;margin-bottom: 5px;">dev..</span></i></li>
                   </a>
                </ul> --}}



                <ul class="nav navbar-nav">

                        <!-- Tasks Menu -->
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li class="dropdown tasks-menu">
                                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach


                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            {{-- <img src="{{ asset('public/assets/backend/images/hamza.jpg') }}" class="user-image" alt=""> --}}
                            @if (Auth::user()->hasRole('super_admin'))
                                   <img src="{{ asset('public/assets/backend/images/hamza.jpg') }}" class="user-image" alt="">
                                @else
                                   <img width="30px" height="30px" src="{{ Auth::user()->avatar() }}" class="img-circle" alt="">
                                @endif
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->the_name() }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                @if (Auth::user()->hasRole('super_admin'))
                                   <img src="{{ asset('public/assets/backend/images/hamza.jpg') }}" class="img-circle" alt="{{ Auth::user()->the_name() }}">
                                @else
                                   <img  src="{{ Auth::user()->avatar() }}" class="img-circle" alt="{{ Auth::user()->the_name() }}">
                                @endif

                                <p>
                                    {{ Auth::user()->the_name() }}
                                    <small style="font-weight: bold">{{ Auth::user()->the_name().' ' }}developer web full stack</small>
                                    <small style="font-weight: bold">{{ Auth::user()->email }}</small>
                                </p>
                            </li>
                            <!-- Menu Body -->

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                </div>
                            </li>
                        </ul>
                    </li>


                </ul>

            </div>

        </nav>
    </header>

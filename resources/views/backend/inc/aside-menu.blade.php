<aside {{(LaravelLocalization::getCurrentLocale() ==='ar')?'dir=rtl':''}} class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section {{(LaravelLocalization::getCurrentLocale() ==='ar')?'dir=rtl':''}} style="height: auto;"{{-- style="margin-left: 5px;" --}} class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img style="width: 50px;height: 50px;border-radius: 100%;" src="{{asset(Auth::user()->photo())}}" class="img-circle" alt="{{Auth::user()->profile->username}}">
            </div>
            <div class="pull-left info">
                <p> <a href="{{route('dashboard.profile',Auth::user()->id)}}"> {{Auth::user()->profile->username}} </a></p>
                <!-- Status -->
                <a href="{{route('dashboard.profile',Auth::user()->id)}}"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

         <!-- start searsh -->
         <div style="background-color: #00c0ef" class="user-panel">
            <form action="{{route('dashboard.searsh_ref')}}" method="GET" class="sidebar-form">
                @csrf

                <div class="input-group">
                  <input type="text" name="q" class="form-control" placeholder="Search by Référence...">
                      <span class="input-group-btn">
                        <button  type="submit" name="search" id="search-btn" class="btn btn-flat btn-primary"><i class="fa fa-search"></i>
                        </button>
                      </span>
                </div>
              </form>
         </div>
        <!-- end searsh -->


        <!-- Sidebar Menu -->
        <ul style="font-size: 19px;" {{(LaravelLocalization::getCurrentLocale() ==='ar')?'dir=rtl':''}} {{-- style="margin-left: 10px" --}} class="sidebar-menu">
            {{-- <li class="header text-primary">Menu</li> --}}

            <li class="active"><a href="{{ route('dashboard') }}">
               {{--  <i style="font-size: 2rem;margin-right: 10px" class="fas fa-home text-primary"></i> --}}
               <img style="font-size: 2rem;margin-right: 10px" width="30px" height="30px" src="{{asset('public/assets-file/images/home.svg')}}" alt="listings">

                 <span>{{__('dashboard.DASHBOARD')}}</span></a></li>


            {{-- <li class="active"><a href="{{ route('dashboard.home') }}"><i style="font-size: 2rem;" class="fas fa-home text-primary"></i> <span>Home</span></a></li> --}}

            @if (Auth::user()->role == 'admin')

            <li class="active"><a href="{{route('dashboard.permessions')}}">
                {{-- <i style="color: goldenrod;font-size: 2rem;margin-right: 10px" class="fas fa-user-shield"></i> --}}
                <img style="font-size: 2rem;margin-right: 10px" width="30px" height="30px" src="{{asset('public/assets-file/images/permesion.svg')}}" alt="category">

                <span>{{__('dashboard.PERMESSIONS')}}</span></a></li>

            @endif


            @if (Auth::user()->role == 'editor')

            <li class="active"><a href="{{ route('dashboard.users_profiles') }}">
                {{-- <i style="font-size: 2rem;margin-right: 10px" class="fas fa-user text-primary"></i> --}}
                <img style="font-size: 2rem;margin-right: 10px" width="30px" height="30px" src="{{asset('public/assets-file/images/user.svg')}}" alt="user">

                <span>{{Auth::user()->profile->username}}</span></a></li>

            @else

            <li class="active"><a href="{{ route('dashboard.users_profiles') }}">
                {{-- <i style="font-size: 2rem;margin-right: 10px" class="fas fa-user text-primary"></i> --}}
                <img style="font-size: 2rem;margin-right: 10px" width="30px" height="30px" src="{{asset('public/assets-file/images/users.svg')}}" alt="category">

                <span>{{__('dashboard.ALL_USERS')}}</span></a></li>
            @endif

          {{--   <span><hr style="border-radius: 8px;height: 4px;margin-left: 6px;margin-right: 6px;background-image: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%);"/></span>
--}}


            <li class="treeview">
                <a href="#"> {{-- <i class="fa fa-link"></i> --}}
                    <img style="font-size: 2rem;margin-right: 10px" width="30px" height="30px" src="{{asset('public/assets-file/images/add.svg')}}" alt="listings">
                    <span>{{__('dashboard.LISTINGS')}}</span>
                    <span class="pull-right-container">
                       <i class="fa fa-angle-right pull-left"></i>
                     </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{route('listings.create')}}">
                        {{__('dashboard.Nouveau')}}
                        </a>
                     </li>
                    <li><a href="{{route('listings.index')}}">{{__('dashboard.Afficher_Tout')}}</a></li>
                </ul>
            </li>

            {{-- <span><hr style="border-radius: 8px;height: 4px;margin-left: 6px;margin-right: 6px;background-image: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%);"/></span>
--}}

           @if (Auth::user()->role == 'admin')
            <li class="treeview">
                <a href="#">{{-- <i class="fa fa-link"></i> --}}
                    <img style="font-size: 2rem;margin-right: 10px" width="30px" height="30px" src="{{asset('public/assets-file/images/add.svg')}}" alt="category">
                    <span>{{__('dashboard.CATEGORIES')}}</span>
                    <span class="pull-right-container">
                       <i class="fa fa-angle-right pull-left"></i>
                     </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('categories.create')}}">{{__('dashboard.Nouveau')}}</a></li>
                    <li><a href="{{route('categories.index')}}">{{__('dashboard.Afficher_Tout')}}</a></li>
                </ul>
            </li>
            @endif
           {{--  <span><hr style="border-radius: 8px;height: 4px;margin-left: 6px;margin-right: 6px;background-image: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%);"/></span>
--}}
            @if (Auth::user()->role == 'admin')
            <li class="treeview">
                <a href="#"> {{-- <i class="fa fa-link"></i> --}}
                    <img style="font-size: 2rem;margin-right: 10px" width="30px" height="30px" src="{{asset('public/assets-file/images/add.svg')}}" alt="cities">
                    <span>{{__('dashboard.CITIES')}}</span>
                    <span class="pull-right-container">
                       <i class="fa fa-angle-right pull-left"></i>
                     </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('cities.create')}}"> {{__('dashboard.Nouveau')}}</a></li>
                    <li><a href="{{route('cities.index')}}"> {{__('dashboard.Afficher_Tout')}}</a></li>
                </ul>
            </li>
            @endif
            {{-- <span><hr style="border-radius: 8px;height: 4px;margin-left: 6px;margin-right: 6px;background-image: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%);"/></span>
--}}

          @if (Auth::user()->role == 'admin')
            <li class="treeview">
                <a href="#"> {{-- <i class="fa fa-link"></i> --}}
                    <img style="font-size: 2rem;margin-right: 10px" width="30px" height="30px" src="{{asset('public/assets-file/images/add.svg')}}" alt="areas">
                    <span>{{__('dashboard.AREAS')}}</span>
                    <span class="pull-right-container">
                       <i class="fa fa-angle-right pull-left"></i>
                     </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('areas.create')}}">{{__('dashboard.Nouveau')}}</a></li>
                    <li><a href="{{route('areas.index')}}">{{__('dashboard.Afficher_Tout')}}</a></li>
                </ul>
            </li>
          @endif
            {{-- <span><hr style="border-radius: 8px;height: 4px;margin-left: 6px;margin-right: 6px;background-image: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%);"/></span>
--}}
         @if (Auth::user()->role == 'admin')
            <li class="treeview">
                <a href="#">

                   {{--  <img style="font-size: 2rem;margin-right: 10px" width="30px" height="30px" src="{{asset('public/assets-file/images/settings.png')}}" alt="setings">
--}}
                   <img style="font-size: 2rem;margin-right: 10px" width="30px" height="30px" src="{{asset('public/assets-file/images/settings.svg')}}" alt="category">

                    <span>{{__('dashboard.SETINGS')}}</span>
                    <span class="pull-right-container">
                       <i class="fa fa-angle-right pull-left"></i>
                     </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('site.settings')}}">{{__('dashboard.SITE_SETINGS')}}</a></li>
                    <li><a href="{{route('site.settings.about')}}">{{__('dashboard.About_SETINGS')}}</a></li>
                </ul>
            </li>
          @endif
            {{-- <span><hr style="border-radius: 8px;height: 4px;margin-left: 6px;margin-right: 6px;background-image: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%);"/></span>
--}}

            <li class="active">
                <a href="{{ route('contact.index') }}">
                    <img style="font-size: 2rem;margin-right: 10px" width="30px" height="30px" src="{{asset('public/assets-file/images/mail.svg')}}" alt="setings">

                    <span>{{__('dashboard.CONTACTS')}}</span>
                </a>
            </li>

            <li class="active">
                <a href="{{ route('site.user.listings.messages') }}">
                    <img style="font-size: 2rem;margin-right: 10px" width="30px" height="30px" src="{{asset('public/assets-file/images/dashboard.svg')}}" alt="setings">

                     <span>{{__('dashboard.Users_Listings_Messages')}}</span>
                </a>
            </li>

            {{-- <span><hr style="border-radius: 8px;height: 4px;margin-left: 6px;margin-right: 6px;background-image: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%);"/></span>
--}}
            <li class="active">
                <a href="{{ route('site.user.request') }}">
                    <img style="font-size: 2rem;margin-right: 10px" width="30px" height="30px" src="{{asset('public/assets-file/images/message.svg')}}" alt="setings">

                    <span>{{__('dashboard.Users_Requests')}}</span>
                </a>
            </li>


        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>



<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar direction">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('public/assets/backend/images/hamza.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Cherki Hamza</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">Menu Dev</li>
        <!-- Optionally, you can add icons to the links -->
        <li class=""><a href="{{ route('main') }}"><i class="fa fa-th"></i> <span>{{ __('words.HOME') }}</span></a></li>
        <li><a href="{{ route('users.index') }}"><i class="fa fa-users"></i> <span>{{ __('words.USERS') }}</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Categories</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="#">Laravel</a></li>
            <li><a href="#">React</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

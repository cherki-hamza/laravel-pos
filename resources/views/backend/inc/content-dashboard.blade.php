<div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="row">
            <div class="col-md-6">
                <h1 class="text-primary">
                    {{__('dashboard.DASHBOARD')}}
                 </h1>
            </div>
            <div class="col-md-6 text-right">
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
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section style="font-size: 17px;" class="content">
        <span>    @include('backend.alert.alert') </span>
        <!-- Your Page Content Here -->
        <!-- start row 1 -->
        <div class="row">

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    {{-- <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span> --}}
                    <a href="{{route('listings.index')}}">
                        <span class="info-box-icon bg-aqua"><i class="fas fa-sign"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{__('dashboard.LISTINGS')}}</span>
                            <span class="info-box-number">{{$listings}}</span>
                        </div>
                  </a>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="{{route('categories.index')}}">
                        <span class="info-box-icon bg-green"><i class="fas fa-list"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{__('dashboard.CATEGORIES')}}</span>
                            <span class="info-box-number">{{$categories}}</span>
                        </div>
                    </a>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="{{route('cities.index')}}">
                        <span class="info-box-icon bg-yellow"><i class="fas fa-city"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{__('dashboard.CITIES')}}</span>
                            <span class="info-box-number">{{$cities}}</span>
                        </div>
                    </a>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="{{route('areas.index')}}">
                        <span class="info-box-icon bg-red"><i class="fas fa-map-marker-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{__('dashboard.AREAS')}}</span>
                            <span class="info-box-number">{{$areas}}</span>
                        </div>
                    </a>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

        </div>
        <!-- end row 1 -->


        <!--  start row 2 -->
        <div class="row">

            <div style="margin-top: 80px" class="col-md-12-box box-primary">

                <div class="col-md-6">
                  <div class="box box-primary shadow">
                      <h2 class="box-header text-success">{{__('dashboard.Statistiques')}}</h2><br><br>
                      <div class="box-bod text-center">
                          {{ $real_estate_chart->container() }}
                      </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="box box-primary shadow">
                      <div class="box-header">
                          <h3>{{__('dashboard.Latest_Real_Estate')}}</h3>
                      </div>
                    <div class="box-body table-responsive">
                        <table {{(LaravelLocalization::getCurrentLocale() ==='ar')?'dir=rtl':''}} class="table table-bordered table-hover table-responsive">
                            <thead>
                                <tr class="bg-success">
                                <th>#{{__('dashboard.Id')}}</th>
                                <th>#{{__('dashboard.REF')}}</th>
                                <th>{{__('dashboard.LISTING_TITLE')}}</th>
                                <th>{{__('dashboard.LISTING_CATEGORY')}}</th>
                                <th>{{__('dashboard.CITIES')}}</th>
                                <th class="bg-info">{{__('dashboard.Show')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($latest_listings as $listing)
                                <tr>
                                    <td>{{$listing->id}}</td>
                                    <td>{{$listing->ref}}</td>
                                    <td>{!!$listing->handel_listing_title() !!}</td>
                                    <td>{{$listing->handel_listing_cat() }}</td>
                                    <td>{{$listing->handel_listing_city() }}</td>

                                    <td>
                                        <a href="{{route('listings.show', $listing->id)}}"><span class="btn btn-primary"><i style="margin-right: 5px;" class="fa fa-eye"></i>{{__('dashboard.Show')}}</span></a>
                                    </td>

                                 </tr>
                                 @endforeach

                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>

            </div>

        </div>


       {{--  <div class="box box-primary shadow">
            <h2 class="box-header text-success">{{__('dashboard.Annonces_Recommandées')}}</h2>
            <div class="box-bod text-center">
                {!! $best_rs_chart->container() !!}
            </div>
        </div> --}}

          {{-- <div class="row">
            <div class="col-md-12-box box-primary">

                <div class="col-md-6">
                  <div class="box box-primary shadow">
                      <h2 class="box-header text-success">anther</h2>
                      <div class="box-bod text-center">
                          {{ $chart2->container() }}
                      </div>
                  </div>
                </div>

                <div class="col-md-6">
                    <div class="box box-primary shadow">
                        <h2 class="box-header text-success">users</h2>
                        <div class="box-bod text-center">
                            {!! $chart3->container() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div> --}}
        <!-- end row 2 -->



    </section>
    <!-- /.content -->
</div>

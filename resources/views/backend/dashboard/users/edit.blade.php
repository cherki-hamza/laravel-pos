@extends('backend.master.app-dashboard')


@section('content')
<div class="wrapper">

    <!-- Start Main Header -->
       @include('backend.inc.top-header')
    <!-- End Main Header -->

    <!-- Start Menu -->
    @include('backend.layouts.menu')
    <!-- End Menu -->


    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 style="float: left">
                <small> {{ __('words.add') }}</small>
            </h1>

             <!--  -->
             <ol class="breadcrumb ">
                <li><a href="{{ route('main') }}"><i class="fa fa-dashboard"></i>{{ __('words.HOME') }} </a></li>
                <li><a href="{{ route('users.index') }}"><i class="fa fa-users"></i> <span>{{ __('words.USERS') }}</span></a></li>
                <li style="color: goldenrod" class="active">{{ __('words.add') }}</li>
              </ol>
             <!--  -->
        </section>

        <!-- Main content -->
        <section class="content" style="margin-top: 25px;">
                 <!-- start box -->
         <div class="box box-primary">
            <div class="box-header with-border">
                  <!-- start alert -->
                  <span>    @include('backend.alert.alert') </span>
                  <!-- end alert -->
              <h3 class="box-title">{{ __('words.add') }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ route('users.update',$user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
              <div class="box-body">

                <div class="form-group">
                  <label for="first_name">@lang('words.first_name')</label>
                  <input type="text" name="first_name" class="form-control @error('first_name') is-invalid  @enderror" id=""  value="{{ $user->first_name }}">
                  @error('first_name')
                  <div class="alert alert-danger mt-2">
                      {{$message}}
                  </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="last_name">@lang('words.last_name')</label>
                  <input type="text" name="last_name" class="form-control @error('last_name') is-invalid  @enderror" id=""  value="{{ $user->last_name }}">
                  @error('last_name')
                  <div class="alert alert-danger mt-2">
                      {{$message}}
                  </div>
                  @enderror
                </div>

                <div class="form-group">
                    <label for="email">@lang('words.email')</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid  @enderror" id=""  value="{{ $user->email }}">
                    @error('email')
                    <div class="alert alert-danger mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <hr>

                 <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="image">@lang('words.image')</label>
                            <input type="file" name="image" class="form-control image @error('image') is-invalid  @enderror">
                            @error('image')
                            <div class="alert alert-danger mt-2">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div style="text-align: -webkit-center;" class="col-lg-6 col-md-6 col-sm-12">
                         <img class="image-preview" style="width: 20%;height: 20%;border-radius: 100%;text-align: center" src="{{ $user->image_path}}" alt="">
                    </div>
                </div>
                <hr>


                <div class="form-group">
                    <label for="exampleInputPassword1">@lang('words.permissions')</label>
                    <div class="my-5">
                        @php
                            $models = ['users','categories','products'];
                            $maps = ['create','read','update','delete'];
                        @endphp
                        <!-- Custom Tabs -->
                        {{-- <li class="active"><a href="#tab_users" data-toggle="tab" aria-expanded="true">@lang('words.USERS')</a></li>
                            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Tab 2</a></li>
                            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li> --}}
                        <div class="nav-tabs-custom">
                          <ul class="nav nav-tabs">
                             @foreach ($models as $index=>$model)
                              <li class="{{ $index == 0 ? 'active':'' }}"><a href="#{{ $model }}" data-toggle="tab" aria-expanded="false">@lang('words.'. $model)</a></li>
                             @endforeach
                        </ul>
                          <div class="tab-content">
                            @foreach ($models as $index=>$model)
                            <div class="tab-pane {{ $index == 0 ? 'active':'' }}" id="{{ $model }}">


                    <div class="form-group">
                        @foreach ($maps as $map)
                        <label style="margin-right: 20px;"><input type="checkbox" {{ $user->hasPermission($map.'_'.$model)? 'checked':'' }} name="permissions[]" value="{{ $map }}_{{ $model }}" id="">@lang('words.'.$map)</label>
                        @endforeach
                    {{-- <label style="margin-right: 20px;"><input type="checkbox" name="permissions[]" value="create_{{ $model }}" id="">@lang('words.create')</label>
                    <label style="margin-right: 20px;"><input type="checkbox" name="permissions[]" value="read_{{ $model }}" id="">@lang('words.read')</label>
                    <label style="margin-right: 20px;"><input type="checkbox" name="permissions[]" value="update_{{ $model }}" id="">@lang('words.update')</label>
                    <label style="margin-right: 20px;"><input type="checkbox" name="permissions[]" value="delete_{{ $model }}" id="">@lang('words.delete')</label> --}}
                       </div>

                            </div>
                            @endforeach
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="categories">
                              Categories
                            </div>
                            <!-- /.tab-pane -->

                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="products">
                                products
                             </div>
                            <!-- /.tab-pane -->

                          </div>
                          <!-- /.tab-content -->
                        </div>
                        <!-- nav-tabs-custom -->
                      </div>
                </div>




              </div>
              <!-- /.box-body -->

              <div class="box-footer text-center">
                <button type="submit" class="btn btn-primary btn-block text-center"><i class="fa fa-edit"></i>@lang('words.update')</button>
              </div>
            </form>
          </div>
         <!-- end box -->
        </section>
        <!-- /.content -->
    </div>


    <!-- /.content-wrapper -->

 @stop

 @section('scripts')
 <script>
// script to priview image live
$(".image").change(function() {

         if (this.files && this.files[0]) {

             var reader = new FileReader();

              reader.onload = function(e) {

             $('.image-preview').attr('src', e.target.result);

             }
             reader.readAsDataURL(this.files[0]);

         }
 });

 </script>
@stop



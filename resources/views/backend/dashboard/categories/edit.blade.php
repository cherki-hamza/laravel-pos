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
                <small> {{ __('words.edit') }}</small>
            </h1>

             <!--  -->
             <ol class="breadcrumb ">
                <li><a href="{{ route('main') }}"><i class="fa fa-dashboard"></i>{{ __('words.HOME') }} </a></li>
                <li><a href="{{ route('categories.index') }}"><i class="fa fa-categories"></i> <span>{{ __('words.CATEGORIES') }}</span></a></li>
                <li style="color: goldenrod" class="active">{{ __('words.edit') }}</li>
              </ol>
             <!--  -->
        </section>

        <!-- Main content -->
        <section class="content" style="margin-top: 25px;">
                 <!-- start box -->
         <div style="width: 80%;margin: 5% auto" class="box box-primary">
            <div class="box-header with-border">
                  <!-- start alert -->
                  <span>    @include('backend.alert.alert') </span>
                  <!-- end alert -->
              <h3 class="box-title">{{ __('words.edit') }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ route('categories.update' , $category->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
              <div class="box-body">

              {{--   <div  class="form-group @error('category') has-error  @enderror">
                  <label for="category">@lang('words.NAME_OF_CATEGORY')</label>
                  <input style="margin: auto" type="text" name="category" class="form-control col-xs-5" id="inputError" placeholder="@lang('words.CATEGORIES')" value="{{ $category->category_name }}">
                  @error('category')
                  <div class="mt-2">
                    <span class="help-block">{{$message}}</span>
                  </div>
                  @enderror
                </div> --}}

                <!-- start tranlatabl category -->
                @foreach (config('translatable.locales') as $locale)

                <div class="form-group @error($locale.'.category') has-error  @enderror">
                    <label for="category">@lang('words.'.$locale.'.NAME_OF_CATEGORY')</label>
                    <input style="margin: auto"  type="text" name="{{ $locale }}[category]" class="form-control" id="inputError"  value="{{ $category->translate($locale)->category_name }}">
                    @error($locale.'.category')
                    <div class="mt-2">
                      <span class="help-block">{{$message}}</span>
                    </div>
                    @enderror
                </div>

                @endforeach
                 <!-- end tranlatabl category -->


              </div>
              <!-- /.box-body -->

              <div class="box-footer text-center">
                <button type="submit" class="btn btn-primary text-center"><i class="fa fa-plus"></i>@lang('words.update')</button>
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
  /*  // script to priview image live ****************
   $(".image").change(function() {

            if (this.files && this.files[0]) {

                var reader = new FileReader();

                 reader.onload = function(e) {

                $('.image-preview').attr('src', e.target.result);

                }
                reader.readAsDataURL(this.files[0]);

            }
    });
    //******************************************** */

    </script>
 @stop



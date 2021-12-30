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
                <li><a href="{{ route('products.index') }}"><i class="fa fa-products"></i> <span>{{ __('words.products') }}</span></a></li>
                <li style="color: goldenrod" class="active">{{ __('words.add') }}</li>
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
              <h3 class="box-title">{{ __('words.add') }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="box-body">

                <div class="form-group">
                    <label for="product">@lang('words.CATEGORIES')</label>

                    <select class="form-control" name="category_id">
                        <option selected>@lang('words.All_CATEGORIES')</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>


                </div>
                  <hr class="bg-info">
                <!-- start tranlatabl product -->
                @foreach (config('translatable.locales') as $locale)

                <div class="form-group @error($locale.'.product') has-error  @enderror">
                    <label for="name">@lang('words.' .$locale. '.PNAME')</label>
                    <input style="margin: auto"  type="text" name="{{ $locale }}[name]" class="form-control" id="inputError" placeholder="@lang('words.'.$locale.'.P_NAME')" value="{{ old($locale.'.name') }}">
                    @error($locale.'.name')
                    <div class="mt-2">
                      <span class="help-block">{{$message}}</span>
                    </div>
                    @enderror
                </div>

                <div class="form-group @error($locale.'.description') has-error  @enderror">
                    <label for="description">@lang('words.'.$locale.'.DESC_OF_PRODUCT')</label>
                    <textarea  name="{{ $locale }}[description]" class="form-control ckeditor" id="editor1">{{ old($locale.'.description') }}</textarea>
                    @error($locale.'.description')
                    <div class="mt-2">
                      <span class="help-block">{{$message}}</span>
                    </div>
                    @enderror
                </div>

                @endforeach


                <hr>
                <!-- start product image -->
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
                        <h2>Default Image</h2>
                         <img class="image-preview" style="width: 20%;height: 20%;border-radius: 100%;text-align: center" src="{{ asset('public/assets/backend/images/products/default-product-.png') }}" alt="">
                         @error('image')
                         <div class="mt-2 @error('image') has-error  @enderror">
                             <span class="help-block">{{$message}}</span>
                         </div>
                         @enderror
                        </div>
                </div>
                 <!-- end product image -->

                <!--  -->
                <div class="form-group">
                    <label for="purchase_price">@lang('words.purchase_price')</label>
                    <input style="margin: auto"  type="number" name="purchase_price" class="form-control" value="{{ old('purchase_price') }}">
                    @error('purchase_price')
                    <div class="mt-2 @error('purchase_price') has-error  @enderror">
                        <span class="help-block">{{$message}}</span>
                    </div>
                    @enderror
                </div>
                <!--  -->
                <div class="form-group">
                    <label for="sale_price">@lang('words.sale_price')</label>
                    <input style="margin: auto"  type="number" name="sale_price" class="form-control" value="{{ old('sale_price') }}">
                    @error('sale_price')
                    <div class="mt-2 @error('sale_price') has-error  @enderror">
                        <span class="help-block">{{$message}}</span>
                    </div>
                    @enderror
                </div>
                 <!--  -->
                 <div class="form-group">
                    <label for="stock">@lang('words.stock')</label>
                    <input style="margin: auto"  type="number" name="stock" class="form-control" value="{{ old('stock') }}">
                    @error('stock')
                    <div class="mt-2 @error('stock') has-error  @enderror">
                        <span class="help-block">{{$message}}</span>
                    </div>
                    @enderror
                </div>
             {{--    <!--  -->
                <div class="form-group">
                    <label for="product"></label>
                    <input style="margin: auto"  type="text" name="" class="form-control" id="inputError" placeholder="">
                </div>
                <!--  --> --}}
                 <!-- end tranlatabl product -->

              </div>
              <!-- /.box-body -->

              <div class="box-footer text-center">

                <button type="submit" class="btn btn-primary text-center"><i class="fa fa-plus"></i>@lang('words.add')</button>
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
    // Replace the <textarea id="products_editor"> with a CKEditor 4
    // instance, using default configuration.
    CKEDITOR.replace.('editor1');
    //CKEDITOR.config.language = "{{ app()->getLocale() }}";
</script>

<!-- ckeditor edit language -->
{{-- <script>
    CKEDITOR.editorConfig = function(config){
         config.language = "{{ app()->getLocale() }}"
    };
</script> --}}
    <script>
   // script to priview image live ****************
   $(".image").change(function() {

            if (this.files && this.files[0]) {

                var reader = new FileReader();

                 reader.onload = function(e) {

                $('.image-preview').attr('src', e.target.result);

                }
                reader.readAsDataURL(this.files[0]);

            }
    });
    //********************************************

    </script>
 @stop



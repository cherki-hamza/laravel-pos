@extends('backend.master.app-dashboard')


@section('styles')

<style>
.swal-overlay {
  background-color: rgba(43, 165, 137, 0.45);
}
</style>

@stop

@section('content')
<div class="wrapper">

    <!-- Start Main Header -->
    @include('backend.inc.top-header')
    <!-- End Main Header -->

    <!-- Start Main Header -->
    @include('backend.layouts.menu')
    <!-- End Main Header -->




    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
           {{--  <h1>
                <small> {{ __('words.SUPERVISORS') }} </small>
            </h1> --}}

            {{-- <img src="{{ $avatar }}" alt=""> --}}
            <!--  -->
             <ol class="breadcrumb ">
               <li><a href="{{ route('main') }}"><i class="fa fa-dashboard"></i>{{ __('words.HOME') }} </a></li>
               <li><a href="{{ route('users.index') }}"><i class="fa fa-users"></i> <span>{{ __('words.USERS') }}</span></a></li>
               <li><a href="{{ route('categories.index') }}"><i class="fa fa-categories"></i> <span>{{ __('words.CATEGORIES') }}</span></a></li>

             </ol>
            <!--  -->
            <x:notify-messages />
        </section>

        <!-- Main content -->
        <section class="content" style="margin-top: 25px;">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ __('words.CATEGORIES') }} <span> : {{ $categories->total() }}</span></h3>
             <!-- start search-->
             <form  action="{{ route('categories.index') }}" method="GET"  class="my-3">

                <div class="row">
                    <div class="col-md-4">
                      <input class="form-control" type="text" name="search" id="search" value="{{ request()->search }}" placeholder="@lang('words.search')">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i>@lang('words.search')</button>

                        @if(auth()->user()->hasPermission('create_categories'))
                        <a class="btn btn-primary" href="{{ route('categories.create') }}"><i class="fa fa-plus px-3"></i>@lang('words.add')</a>
                        @else
                         <a disabled class="btn btn-primary btn-sm" aria-disabled="true" href="#"><i class="fa fa-plus px-3"></i>@lang('words.add')</a>
                        @endif
                   </div>
                </div>
            </form>
           <!-- end search-->
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                     <!-- start alert -->
                 <span style="margin-top: 10px 10%" class="my-5">    @include('backend.alert.alert') </span>
                 <!-- end alert -->
                  <table class="table table-bordered table-hover">
                      <thead class="bg-aqua">
                         <tr>
                             <th>#ID</th>
                             <th>{{ __('words.NAME_OF_CATEGORY') }}</th>
                             <th>{{ __('words.products_count') }}</th>
                             <th>{{ __('words.related_products') }} </th>
                             <th>{{ __('words.action') }}</th>
                         </tr>
                      </thead>
                      <tbody>
                          @if ($categories->count() > 0)

                          @foreach ($categories as $index=>$category )
                          <tr>
                              <td>{{ $index+1 }}</td>
                              <td>{{ $category->category_name }}</td>
                              <td>{{ $category->products->count() }}</td>
                              <td><a href="{{ route('products.index' , ['category_id'=>$category->id]) }}" class="btn btn-primary"> {{ __('words.related_products') }} </a></td>
                               <td>
                                  <span class="mx-5">
                                      {{-- <a href="{{ route('categories.edit' , $category->id) }}"><i style="color: green;font-size: 20px" class="fa fa-edit"></i></a> --}}
                                      <a  class="btn btn-sm btn-warning" href="#"><i style="margin-right: 5px;" class="fa fa-eye"></i>@lang('words.show')</a>
                                 </span>

                               @if(auth()->user()->hasPermission('update_categories'))
                                <span class="mx-5">
                                    {{-- <a href="{{ route('categories.edit' , $category->id) }}"><i style="color: green;font-size: 20px" class="fa fa-edit"></i></a> --}}
                                    <a  class="btn btn-sm btn-info" href="{{ route('categories.edit' , $category->id) }}"><i style="margin-right: 5px;" class="fa fa-edit"></i>@lang('words.edit')</a>
                                </span>
                                @else
                                   <button class="btn btn-sm btn-info" disabled="disabled"><i style="margin-right: 5px;" class="fa fa-edit"></i>@lang('words.edit')</button>
                                @endif

                              @if(auth()->user()->hasPermission('delete_categories'))
                                <span class="mx-5">
                                    <form action="{{ route('categories.destroy' , $category->id) }}" method="POST" style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                       {{-- <a href="{{ route('categories.destroy' , $category->id) }}"><i style="color: red;font-size: 20px" class="fa fa-trash"></i></a> --}}
                                       {{-- <button onclick="confirm_delete()" type="submit" value="Delete" class="btn btn-danger">@lang('words.delete')</button> --}}
                                      {{--  <a class="btn btn-danger text-danger" title="Delete" data-toggle="tooltip" onclick="deletefunction({{$category->id}})"><i class="fa fa-trash"></i></a> --}}
                                      {{-- <input class="btn btn-sm btn-danger" type="submit" value="Delete" /> --}}
                                      <button class="btn btn-sm btn-danger" type="submit"><i style="margin-right: 5px;" class="fa fa-trash"></i>@lang('words.delete')</button>
                                    </form>
                                </span>
                                @else
                                   <button class="btn btn-sm btn-danger" disabled="disabled">@lang('words.delete')</button>
                              @endif
                              </td>
                          </tr>
                          @endforeach

                          @else
                             <tr>
                                 <td class="text-center text-danger" colspan="12">{{ __('words.no_data_found') }} </td>
                             </tr>
                          @endif

                      </tbody>

                  </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                    {{ $categories->appends(request()->query())->links()  }}
                  {{-- <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                  </ul> --}}
                </ul>
                </div>
              </div>
        </section>
        <!-- /.content -->
    </div>


    <!-- /.content-wrapper -->

 @stop

 @section('scripts')
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <!-- start script for confirmation delete -->
{{--  <script>
swal({
title: 'Are you sure?',
text: "You won't be able to revert this!",
type: 'warning',
buttons:{
confirm: {
text : 'Yes, delete it!',
className : 'btn btn-success'
},
cancel: {
visible: true,
className: 'btn btn-danger'
}
}
})
 </script> --}}
  <!-- end script for confirmation delete -->
 <script>
     $('.btn-danger').click(function(e) {
                var $form =  $(this).closest("form"); //Get the form here.
                e.preventDefault();
                   swal({
                        /*title: "Are you sure you want to Delete this?",
                        dangerMode: true,
                        type: "warning",
                        //showCancelButton: true,
                        //confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes",
                        closeOnConfirm: false,
                        */
                        title: "{{ __('words.are_you_sure') }}",
                        text: "{{ __('words.once_deleted_recover') }}",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                        preConfirm: function(result) {
                            window.location.href = '{{url('/categories/destroy')}}/'+id;
                        },
                        allowOutsideClick: false
                    }).then((Delete) => {
                        console.log(Delete); //This will be true when delete is clicked
                        if (Delete) {
                           $form.submit(); //Submit your Form Here.
                           //$('#yourFormId').submit(); //Use same Form Id to submit the Form.
                        }
                    });
        });
 </script>
 <!-- end script for confirmation delete -->
{{--  <script>
     var deletefunction = function(id){
        swal({
            title: "Are you sure you want to Delete this?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            closeOnConfirm: false,
            preConfirm: function(result) {
                window.location.href = '{{url('/categories/destroy')}}/'+id;
            },
            allowOutsideClick: false
        });
    };
 </script> --}}
 {{-- <script>
     function confirm_delete(){
         return swal("Are you sure for delete this?", {
            dangerMode: true,
            buttons: true,
     });
     }

 </script> --}}
 @stop



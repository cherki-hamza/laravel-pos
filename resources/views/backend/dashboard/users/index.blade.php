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
             </ol>
            <!--  -->
            <x:notify-messages />
        </section>

        <!-- Main content -->
        <section class="content" style="margin-top: 25px;">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ __('words.USERS') }} <span> : {{ $users->total() }}</span></h3>
             <!-- start search-->
             <form  action="{{ route('users.index') }}" method="GET"  class="my-3">

                <div class="row">
                    <div class="col-md-4">
                      <input class="form-control" type="text" name="search" id="search" value="{{ request()->search }}" placeholder="@lang('words.search')">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i>@lang('words.search')</button>

                        @if(auth()->user()->hasPermission('create_users'))
                        <a class="btn btn-primary" href="{{ route('users.create') }}"><i class="fa fa-plus px-3"></i>@lang('words.add')</a>
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
                             <th>{{ __('words.first_name') }}</th>
                             <th>{{ __('words.last_name') }}</th>
                             <th>{{ __('words.email') }}</th>
                             <th>{{ __('words.image') }}</th>
                             <th>{{ __('words.created_at') }}</th>
                             <th>{{ __('words.action') }}</th>
                         </tr>
                      </thead>
                      <tbody>
                          @if ($users->count() > 0)

                          @foreach ($users as $index=>$user )
                          <tr>
                              <td>{{ $index+1 }}</td>
                              <td>{{ $user->first_name }}</td>
                              <td>{{ $user->last_name }}</td>
                              <td>{{ $user->email }}</td>
                              <td>
                                  <img width="100px" height="100px" class="img-circle" src="{{ $user->image_path }}" alt="">
                              </td>
                              <td>{{ $user->created_at->diffForHumans() }}</td>
                              <td>

                                  <span class="mx-5">
                                      {{-- <a href="{{ route('users.edit' , $user->id) }}"><i style="color: green;font-size: 20px" class="fa fa-edit"></i></a> --}}
                                      <a  class="btn btn-warning" href="#">@lang('words.show')</a>
                                 </span>

                               @if(auth()->user()->hasPermission('update_users'))
                                <span class="mx-5">
                                    {{-- <a href="{{ route('users.edit' , $user->id) }}"><i style="color: green;font-size: 20px" class="fa fa-edit"></i></a> --}}
                                    <a  class="btn btn-info" href="{{ route('users.edit' , $user->id) }}">@lang('words.edit')</a>
                                </span>
                                @else
                                   <button class="btn btn-sm btn-info" disabled="disabled">@lang('words.edit')</button>
                                @endif

                              @if(auth()->user()->hasPermission('delete_users'))
                                <span class="mx-5">
                                    <form action="{{ route('users.destroy' , $user->id) }}" method="post" style="display: inline-block">
                                        @csrf
                                        @method('delete')
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
                    {{ $users->appends(request()->query())->links() }}
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
 <script>
     /*
     *  Author : cherki hamza
     *  Email  : cherki0hamza@gmail.com
     */
     // script for confirmation to delete record
    $('.btn-danger').click(function(e) {
               var $form =  $(this).closest("form"); //Get the form here.
               e.preventDefault();
                  swal({
                        title: "{{ __('words.are_you_sure') }}",
                        text: "{{ __('words.once_deleted_recover') }}",
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                       preConfirm: function(result) {
                           window.location.href = '{{url('/users/destroy')}}/'+id;
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
 @stop



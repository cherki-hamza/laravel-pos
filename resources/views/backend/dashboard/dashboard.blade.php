@extends('backend.master.app-dashboard')

@section('title')
{{ __('words.CH')}}
@stop

@section('style')
<style>

</style>
@stop

@section('content')
<div class="wrapper">

    <!-- Start Main Header -->
       @include('backend.inc.top-header')
    <!-- End Main Header -->

    <!-- Start Menu -->
    @include('backend.layouts.menu')
    <!-- End Menu -->


    <!-- Content Wrapper. Contains page content -->

          @include('backend.inc.content-dashboard-home')


    <!-- /.content-wrapper -->

 @stop



   <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right
        <div class="pull-right hidden-xs">
            {{__('dashboard.made_with_love')}}  🧡
        </div>
         -->
        <!-- Default to the left -->
        <div class="text-center">

          <p style="text-align:center">Copyright <i class="fa fa-copyright"></i> <?php echo Date('Y');  ?> make with love 🧡 by cherki hamza developer web full stack </p>

        </div>
    </footer>


</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="{{asset('public/assets/backend/en/js/jquery-2.2.3.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('public/assets/backend/en/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/assets/backend/en/js/app.min.js')}}"></script>

<!-- ckeditor 4 -->
<script src="{{asset('public/assets/backend/plugins/ckeditor/ckeditor.js')}}"></script>

<script>
       CKEDITOR.config.language = "{{ app()->getLocale() }}";
</script>



<!-- notify js -->
<script src="{{asset('public/js/notify.js')}}"></script>

@include('sweetalert::alert')




@yield('scripts')



</body>
</html>

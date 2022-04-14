{{--    @include('ckfinder::setup') --}}

   <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
   {{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
   
   <script src="{{ asset('assets/dist/jquery-1.12.4.js') }}"></script>
   <script src="{{ asset('assets/dist/jquery-ui-1.12.1/jquery-ui.js') }}"></script>

   <!-- Bootstrap 4 -->
   <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

   <!-- jQuery Knob Chart -->
   <script src="{{ asset('assets/plugins/knob/jquery.knob.js') }}"></script>
   <script src="{{ asset('assets/dist/js/moment.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    
   <!-- datepicker -->
   <script src="{{ asset('assets/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
   <script src="{{ asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
   {{-- <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script> --}}

   <!-- AdminLTE App -->
   <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
   
   <!-- Select 2 -->
   <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

   <!-- AdminLTE for demo purposes -->
   <script src="{{ asset('assets/dist/js/demo.js') }}"></script>

   <!-- DataTables -->
   <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
   <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.js') }}"></script>

   <!-- bootbox js -->
   <script src="{{ asset('assets/dist/bootbox-js/bootbox.js') }}"></script>


   <!-- delete confirm box -->
   <script>
      $(document).on('click','a.confirm',function(e){
         var link = $(this).attr("href");
         e.preventDefault();
         bootbox.confirm($(this).attr('confirm-text'), function(confirmed) {
            if(confirmed)
            document.location.href = link;
         });
      });
   
      $.widget.bridge('uibutton', $.ui.button);

      //Initialize Select2 Elements
      $('.select2').select2();

      $(function () {
         $("#example1").DataTable( {
            "pageLength": 25,
            //"ordering": false,
            responsive: true,
            "order": [],
         });

         $('#datepicker').datepicker({
            autoclose: true
         });

         $('[data-toggle="tooltip"]').tooltip(); 

      });

      // Add the following code if you want the name of the file appear on input type=file
      $(".custom-file-input").on("change", function() {
         var fileName = $(this).val().split("\\").pop();
         $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });

   </script>

   {{-- All the text editors availabes in include-editors.blade.php --}}
   @yield('js-extra')
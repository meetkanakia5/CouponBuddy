
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('dist/img/favicon.ico') }}" />

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}">
    
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/ionicons.min.css') }}">
    
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/flat/blue.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href=" {{ asset('assets/plugins/datatables/dataTables.bootstrap4.css') }}">
    
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">

    <!-- Select 2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datepicker/datepicker3.css') }}">
    
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker-bs3.css') }}">

    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

    <!-- Logout Css -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/logout.css') }}">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <style type="text/css">
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff;
            border-color: #006fe6;
            padding: 1px 10px;
            color: #fff;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: white;
            cursor: pointer;
            display: inline-block;
            font-weight: bold;
            margin-right: 2px;
        }

        .edit_a_tag, .del_a_tag {
            display: inline-block;
        }

        #edit_span, #delete_span {
            display: block;
        }
        
        #delete_span, #error_label {
            color:red;
        }

        #img_preview {
            flex: 0 0 66.666667%;
            max-width: 40%;
        }

        table, th, td {
            text-align: center;
        }

    </style>

    @yield('css-extra')
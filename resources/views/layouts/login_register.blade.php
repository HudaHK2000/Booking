<!DOCTYPE html>
<html lang="en">

<head>

	<title>
        @yield('title')
    </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="author" content="Phoenixcoded" />
	<!-- Favicon icon -->
    <link rel="shortcut icon" type="image/icon" href="{{ asset('assets/logo/favicon.png') }}"/>

	<!-- vendor css -->
	<link rel="stylesheet" href="{{ asset('assets_dashboard/css/style.css')}}">
	
	<style>
        ::selection {
            background-color: #00d8ff ;
            color: white;
        }
        .form-control:focus {
            border-color: #00d8ff;
        }
        .btn-primary {
            background-color: #00d8ff;
            border-color: #00d8ff;
        }
        .btn-primary:hover {
            background-color: #05c3e0;
            border-color: #05c3e0;
        }
        .btn-link:hover {
            color: #05c3e0;
            /* color: red; */
        }
        .btn-primary:not(:disabled):not(.disabled):active, .btn-primary:not(:disabled):not(.disabled).active {
            background-color: #00a5be;
            border-color: #00a5be;
        }
    </style>


</head>
<body>
    <!-- [ auth-signin ] start -->
    @yield('content')
    <!-- [ auth-signin ] end -->

    <!-- Required Js -->
    <script src="{{ asset('assets_dashboard/js/vendor-all.min.js')}}"></script>
    <script src="{{ asset('assets_dashboard/js/plugins/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets_dashboard/js/pcoded.min.js')}}"></script>
</body>

</html>
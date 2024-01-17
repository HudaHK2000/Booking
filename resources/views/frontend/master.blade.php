<!doctype html>
<html class="no-js"  lang="en">	
	<head>
		@include('partials_frontEnd/head')
	</head>

	<body>
		<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
			your browser</a> to improve your experience and security.</p>
		<![endif]-->

		<!-- main-menu Start -->
		@include('partials_frontEnd/navbar')
		<!-- main-menu End -->

		<!--about-us end -->
		@yield('content')

		<!-- footer-copyright start -->
		@include('partials_frontEnd/footer')
		<!-- footer-copyright end -->
		@include('partials_frontEnd/script')
	</body>

</html>
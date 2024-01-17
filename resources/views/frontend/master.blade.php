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

		<!--about-us start -->
		<section id="home" class="about-us">
			<div class="container">
				<div class="about-us-content">
					<div class="row">
						<div class="col-sm-12">
							<div class="single-about-us">
								<div class="about-us-txt">
									<h2>
										@yield('title')
									</h2>
								</div><!--/.about-us-txt-->
							</div><!--/.single-about-us-->
						</div><!--/.col-->
						
					</div><!--/.row-->
				</div><!--/.about-us-content-->
			</div><!--/.container-->
		</section><!--/.about-us-->
		<!--about-us end -->
		@yield('content')

		<!-- footer-copyright start -->
		@include('partials_frontEnd/footer')
		<!-- footer-copyright end -->
		@include('partials_frontEnd/script')
	</body>

</html>
@extends('frontend.master')
@section('content')	
@if(session('Message'))
    <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center; z-index: 100;">
        <div style="background-color: #fff; padding: 20px; border-radius: 10px; text-align: center;">
            <p>{{ session('Message') }}</p>
            <button style="padding: 10px 20px; margin-top: 10px; background-color: #00d8ff;  border-radius: 10px; color: #fff; border: none; cursor: pointer;" onclick="window.location.href='{{ url('home') }}'">Exit</button>
        </div>
    </div>
@endif
<!--about-us start -->
<section id="home" class="about-us">
	<div class="container">
		<div class="about-us-content">
			<div class="row">
				<div class="col-sm-12">
					<div class="single-about-us">
						<div class="about-us-txt">
							<h2>
								Delight in the Allure of the Captivating Earth
							</h2>
						</div><!--/.about-us-txt-->
					</div><!--/.single-about-us-->
				</div><!--/.col-->
				
			</div><!--/.row-->
		</div><!--/.about-us-content-->
	</div><!--/.container-->
</section><!--/.about-us-->
			<!--travel-box start-->
			<section  class="travel-box" >
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="single-travel-boxes">
								<div id="desc-tabs" class="desc-tabs">
	
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation">
											 <a href="#flights" aria-controls="flights" role="tab" data-toggle="tab">
												 <i class="fa fa-plane"></i>
												 flights
											 </a>
										</li>
									</ul>
	
									<!-- Tab panes -->
									<div class="tab-content">							
										<div role="tabpanel" class="tab-pane active fade in" id="flights">
											<form action="{{url('getallFlight')}}" method="post">
											@csrf
											<div class="tab-para">
												<div class="row">
													<div class="col-lg-3 col-md-4 col-sm-5">
														<div class="single-tab-select-box">
	
															<h2>from</h2>
	
															<div class="travel-select-icon">
																<select class="form-control" name="from">
	
																	  <option value="">enter your location</option><!-- /.option-->
																	@foreach ($countries as $country)
																		<option value="{{$country->id}}">{{$country->name}}</option><!-- /.option-->
																	@endforeach
																</select><!-- /.select-->
															</div><!-- /.travel-select-icon -->
														</div><!--/.single-tab-select-box-->
													</div><!--/.col-->
	
													<div class="col-lg-3 col-md-4 col-sm-5">
														<div class="single-tab-select-box">
	
															<h2>to</h2>
	
															<div class="travel-select-icon">
																<select class="form-control" name="to">
																	  <option value="">enter your destination location</option><!-- /.option-->
																	  @foreach ($countries as $country)
																		<option value="{{$country->id}}">{{$country->name}}</option><!-- /.option-->
																	@endforeach
	
																</select><!-- /.select-->
															</div><!-- /.travel-select-icon -->
	
														</div><!--/.single-tab-select-box-->
													</div><!--/.col-->

													<div class="col-lg-3 col-md-4 col-sm-5">
														<div class="single-tab-select-box">
															<h2>departure</h2>
															<div class="travel-check-icon">
																<form action="#">
																	<input type="date" name="departure" value="{{app('request')->input('departure')}}" class="form-control" placeholder="12 -01 - 2017 ">
																</form>
															</div><!-- /.travel-check-icon -->
														</div><!--/.single-tab-select-box-->
													</div><!--/.col-->
	
													<div class="col-lg-3 col-md-4 col-sm-5">
														<div class="single-tab-select-box">
															<h2>return</h2>
															<div class="travel-check-icon">
																{{-- <form action="#"> --}}
																	<input type="date" name="date_return" value="{{app('request')->input('date_return')}}" class="form-control"  placeholder="22 -01 - 2017 ">
																{{-- </form> --}}
															</div>
														</div>
													</div>
													{{-- <input type="hidden" value="huda" name="arrival"> --}}
	
													<div class="col-lg-2 col-md-1 col-sm-4">
														<div class="single-tab-select-box">
															<h2>adults</h2>
															<div class="travel-select-icon">
																<select class="form-control" name="adults">
																	  <option value="1">1</option><!-- /.option-->
																	@for ($i = 2; $i < 9; $i++)																	
																		<option value="{{$i}}">{{$i}}</option><!-- /.option-->
																	@endfor								
																</select><!-- /.select-->
															</div><!-- /.travel-select-icon -->
														</div><!--/.single-tab-select-box-->
													</div><!--/.col-->
													
													<div class="col-lg-2 col-md-1 col-sm-4">
														<div class="single-tab-select-box">
															<h2>childs</h2>
															<div class="travel-select-icon">
																<select class="form-control" name="childs">
																	<option value="0">0</option><!-- /.option-->
																	@for ($i = 1; $i < 9; $i++)																	
																		<option value="{{$i}}">{{$i}}</option><!-- /.option-->
																	@endfor	
																</select><!-- /.select-->
															</div><!-- /.travel-select-icon -->
														</div><!--/.single-tab-select-box-->
													</div><!--/.col-->

													<div class="col-lg-3 col-md-3 col-sm-4">
														<div class="single-tab-select-box">
															<h2>class</h2>
															<div class="travel-select-icon">
																<select class="form-control" name="class">
																	<option value="">enter class</option><!-- /.option-->
																	@foreach ($classes as $class)
																	@if ($class->name != 'Disabled')	
																	<option value="{{$class->id}}">{{$class->name}}</option><!-- /.option-->
																	@endif
																    @endforeach
																</select><!-- /.select-->
															</div><!-- /.travel-select-icon -->
														</div><!--/.single-tab-select-box-->
													</div><!--/.col-->

													<div class="clo-sm-5">
														<div class="about-btn pull-right">
															<button  type="submit" class="about-view travel-btn">
																search	
															</button><!--/.travel-btn-->
														</div><!--/.about-btn-->
													</div><!--/.col-->
												</div><!--/.row-->
	
											</div>
											</form>
										</div><!--/.tabpannel-->
	
									</div><!--/.tab content-->
								</div><!--/.desc-tabs-->
							</div><!--/.single-travel-box-->
						</div><!--/.col-->
					</div><!--/.row-->
				</div><!--/.container-->
	
			</section><!--/.travel-box-->
			<!--travel-box end-->
	
			<!--service start-->
			<section id="service" class="service">
				<div class="container">
	
					<div class="service-counter text-center">
	
						<div class="col-md-4 col-sm-4">
							<div class="single-service-box">
								<div class="service-img">
									<img src="{{ asset('assets/images/service/s1.png') }}" alt="service-icon" />
								</div><!--/.service-img-->
								<div class="service-content">
									<h2>
										<a href="#">
										Choose amazing tour packages
										</a>
									</h2>
									<p>Must use our tour Planner for breathtaking tour packages!</p>
								</div><!--/.service-content-->
							</div><!--/.single-service-box-->
						</div><!--/.col-->
	
						<div class="col-md-4 col-sm-4">
							<div class="single-service-box">
								<div class="service-img">
									<img src="{{ asset('assets/images/service/s2.png') }}" alt="service-icon" />
								</div><!--/.service-img-->
								<div class="service-content">
									<h2>
										<a href="#">
											book top class hotel
										</a>
									</h2>
									<p>This amazing site helps you book the best hotels all around the world!</p>
								</div><!--/.service-content-->
							</div><!--/.single-service-box-->
						</div><!--/.col-->
	
						<div class="col-md-4 col-sm-4">
							<div class="single-service-box">
								<div class="statistics-img">
									<img src="{{ asset('assets/images/service/s3.png') }}" alt="service-icon" />
								</div><!--/.service-img-->
								<div class="service-content">
	
									<h2>
										<a href="#">
											online flight booking
										</a>
									</h2>
									<p>Book your flight instantly using TourNest!</p>
								</div><!--/.service-content-->
							</div><!--/.single-service-box-->
						</div><!--/.col-->
	
					</div><!--/.statistics-counter-->	
				</div><!--/.container-->
	
			</section><!--/.service-->
			<!--service end-->	
	
			<!--packages start-->
			<section id="pack" class="packages" style="padding-top:0px">
				<div class="container">
				  	<div class="gallary-header text-center">
						<h2>
					  		Our Flight 
						</h2>
						<p>
					  		Choose a trip from our featured trips
						</p>
				  	</div>
					<div class="packages-content">
						<div class="row">
						@foreach( $flightSchedules as $flightSchedule )
						<form method="GET" action='{{url("flightDetails/$flightSchedule->id")}}'>
						{{-- <form action="{{url('booking')}}" method="Get" enctype="multipart/form-data"> --}}
                            @csrf
							{{-- <input type="hidden" value="{{ $flightSchedule->id }}"> --}}
							<div class="col-md-4 col-sm-6">
								<div class="single-package-item">
								  <img src='{{ asset("flightImage/{$flightSchedule->image}") }}' alt="package-place" class="image-height-flight">
								  <div class="single-package-item-txt">
									<h3> 
									  {{ $flightSchedule->direction->destinationAirport->city->name }} 
									  {{-- <span class="pull-right">{{ $flightSchedule->airplaneFlight->airplaneSeats()->where('travel_class_id',1)->first() }}</span> --}}
									</h3>
									<div class="packages-para" style="color: #565a50">
										<h5 style="padding: 17px 0 0"> From City:
											{{ $flightSchedule->direction->originAirport->city->name }} 
										</h5>
										<h5 style="padding: 17px 0 0"> From Airport:
											{{ $flightSchedule->direction->originAirport->name }} 
										</h5>
									</div>
									<div class="packages-para">
									  <p>
										Departure time:
										{{ $flightSchedule->departure_time }}
									  </p>
									  <p>
										Arrival time:
										{{ $flightSchedule->arrival_time }}
									  </p>
	
									  <p>
										time:
										{{ App\Http\Controllers\HomeController::calculateTimeDifference( $flightSchedule->departure_time , $flightSchedule->arrival_time) }}
									  </p>
									  
									</div>
									<div class="about-btn">
									  <button  class="about-view packages-btn">
										book now
									  </button>
									</div><!--/.about-btn-->
								  </div><!--/.single-package-item-txt-->
								</div><!--/.single-package-item-->
					
							  </div><!--/.col-->
						</form>
						@endforeach
						</div><!--/.row-->
					</div><!--/.packages-content-->
				</div><!--/.container-->

			</section><!--/.packages-->
			<!--packages end-->

			<!--blog start-->
			<section id="blog" class="blog">
				<div class="container">
					<div class="blog-details">
							<div class="gallary-header text-center">
								<h2>
									Travel Class
								</h2>
								<p>
									Explanation of travel class
								</p>
							</div><!--/.gallery-header-->
							<div class="blog-content">
								<div class="row">

									@foreach ( $classes as $trave_class )
									@if ($trave_class->name != 'Disabled')
										<div class="col-sm-3 col-md-3">
											<div class="thumbnail">
												<h2>{{ $trave_class->name }}</h2>
												<div class="thumbnail-img">
													<img src='{{ asset("assets/images/travelClass/{$trave_class->image}") }}' alt="blog-img">
													<div class="thumbnail-img-overlay"></div><!--/.thumbnail-img-overlay-->
												</div><!--/.thumbnail-img-->
												<div class="caption">
													<div class="blog-txt">
														<p>
															{{ $trave_class->description }}
														</p>
													</div><!--/.blog-txt-->
												</div><!--/.caption-->
											</div><!--/.thumbnail-->
										</div><!--/.col-->
									@endif
									@endforeach
									
								</div><!--/.row-->
							</div><!--/.blog-content-->
						</div><!--/.blog-details-->
					</div><!--/.container-->

			</section><!--/.blog-->
			<!--blog end-->
@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('exitButton').addEventListener('click', function() {
            var Message = document.getElementById('Message');
            Message.style.display = 'none';
        });
    });
</script>
@endsection
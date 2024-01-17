@extends('frontend.master')
@section('content')
<section id="" class="about-us">
	<div class="container">
		<div class="about-us-content">
			<div class="row">
				<div class="col-sm-12">
					<div class="single-about-us">
						<div class="about-us-txt">
							<h2>
								Our Flight 
							</h2>
						</div><!--/.about-us-txt-->
					</div><!--/.single-about-us-->
				</div><!--/.col-->
				
			</div><!--/.row-->
		</div><!--/.about-us-content-->
	</div><!--/.container-->
</section><!--/.about-us-->
<!--travel-box end-->
<!--packages start-->
<section id="pack" class="packages">
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
@endsection
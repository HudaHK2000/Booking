@extends('frontend.master')
@section('title')
Our Flight 
@endsection
@section('content')
<!--travel-box start-->
<section  class="travel-box">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="single-travel-boxes">
					<div id="desc-tabs" class="desc-tabs">

						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation">
								 <a href="#" aria-controls="flights" role="tab" data-toggle="tab">
									 <i class="fa fa-plane"></i>
									 flights
								 </a>
							</li>
						</ul>

					</div><!--/.desc-tabs-->
				</div><!--/.single-travel-box-->
			</div><!--/.col-->
		</div><!--/.row-->
	</div><!--/.container-->

</section><!--/.travel-box-->
<!--travel-box end-->
<!--packages start-->
<section id="pack" class="packages">
    <div class="container"> 
        <div class="packages-content">
            <div class="row">
            @foreach( $flightSchedules as $flightSchedule )
                <div class="col-md-4 col-sm-6">
                    <div class="single-package-item">
                        <img src='{{ asset("flightImage/{$flightSchedule->image}") }}' alt="package-place" class="image-height-flight">
                        <div class="single-package-item-txt">
                            <h3> 
                                {{ $flightSchedule->direction->destinationAirport->city->name }} 
                            </h3>
                            <div class="packages-para">
                                <p>
                                Departure time:
                                {{ $flightSchedule->departure_time }}
                                </p>
                            </div>
                            <div class="packages-para">
                                <p>
                                Arrival time:
                                {{ $flightSchedule->arrival_time }}
                                </p>
                            </div>
                            <div class="packages-para">
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
            @endforeach
            </div><!--/.row-->
        </div><!--/.packages-content-->
    </div><!--/.container-->
</section><!--/.packages-->
<!--packages end-->
@endsection
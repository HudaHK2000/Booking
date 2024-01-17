@extends('frontend.master')
@section('content')
@if(session('Message'))
    <div id="Message" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center; z-index: 100;">
        <div style="background-color: #fff; padding: 20px; border-radius: 10px; text-align: center;">
            <p>{{ session('Message') }}</p>
            <button id="exitButton" style="padding: 10px 20px; margin-top: 10px; background-color: #00d8ff; border-radius: 10px; color: #fff; border: none; cursor: pointer;">Exit</button>
        </div>
    </div>
@endif
<section id="" class="about-us">
	<div class="container">
		<div class="about-us-content">
			<div class="row">
				<div class="col-sm-12">
					<div class="single-about-us">
						<div class="about-us-txt">
							<h2>
								Flight Details
							</h2>
						</div><!--/.about-us-txt-->
					</div><!--/.single-about-us-->
				</div><!--/.col-->
				
			</div><!--/.row-->
		</div><!--/.about-us-content-->
	</div><!--/.container-->
</section><!--/.about-us-->
<!--travel-box start-->
<section  class="travel-box">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="single-travel-boxes">
                    <div id="desc-tabs" class="desc-tabs">

                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation">
                                 <a href="#flights" aria-controls="flights" role="tab" data-toggle="tab">
                                     Flight Details
                                 </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">              
                            <div role="tabpanel" class="tab-pane active fade in" id="flights">
                                <form action="{{url('booking')}}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $flightSchedule->id }}" name="flight_id">
                                <div class="tab-para">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <h4 style="color:#565A5C; margin-block:17px;">
                                                {{$flightSchedule->direction->originAirport->city->name }} >> {{$flightSchedule->direction->destinationAirport->city->name }}
                                            </h4>
                                            <img src='{{ asset("flightImage/{$flightSchedule->image}") }}' alt="">
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="single-tab-select-box">
                                                    <h2>From Airport</h2>
                                                    <div class="input-by-user">
                                                        <input type="text" name="" value=" {{$flightSchedule->direction->originAirport->name }}" class="form-control" readonly>
                                                    </div><!-- /.travel-select-icon -->
                                                </div><!--/.single-tab-select-box-->
                                            </div><!--/.col-->
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="single-tab-select-box">
                                                    <h2>To Airport</h2>
                                                    <div class="input-by-user">
                                                        <input type="text" name="" value=" {{$flightSchedule->direction->destinationAirport->name }}" class="form-control" readonly>
                                                    </div><!-- /.travel-select-icon -->
                                                </div><!--/.single-tab-select-box-->
                                            </div><!--/.col-->
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="single-tab-select-box">
                                                    <h2>Airline</h2>
                                                    <div class="input-by-user">
                                                        <input type="text" name="" value=" {{ $flightSchedule->airplaneFlight->airline->name }}" class="form-control" readonly>
                                                    </div><!-- /.travel-select-icon -->
                                                </div><!--/.single-tab-select-box-->
                                            </div><!--/.col-->
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="single-tab-select-box">
                                                    <h2>Airplane</h2>
                                                    <div class="input-by-user">
                                                        <input type="text" name="" value=" {{ $flightSchedule->airplaneFlight->model }}" class="form-control" readonly>
                                                    </div><!-- /.travel-select-icon -->
                                                </div><!--/.single-tab-select-box-->
                                            </div><!--/.col-->
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="single-tab-select-box">
                                                    <h2>Departure Date/Time</h2>
                                                    <div class="input-by-user">
                                                        <input type="text" name="" value=" {{ $flightSchedule->departure_time  }}" class="form-control" readonly>
                                                    </div><!-- /.travel-select-icon -->
                                                </div><!--/.single-tab-select-box-->
                                            </div><!--/.col-->
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="single-tab-select-box">
                                                    <h2>Arrival Date/Time</h2>
                                                    <div class="input-by-user">
                                                        <input type="text" name="" value=" {{ $flightSchedule->arrival_time  }}" class="form-control" readonly>
                                                    </div><!-- /.travel-select-icon -->
                                                </div><!--/.single-tab-select-box-->
                                            </div><!--/.col-->
                                            <div class="col-lg-3 col-md-3 col-sm-6">
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
                                            <div class="col-lg-3 col-md-3 col-sm-6">
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
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="single-tab-select-box">
                                                    <h2>class</h2>
                                                    <div class="travel-select-icon @error('class') div-input-validation @enderror" >
                                                        <select class="form-control" name="class">
                                                            <option value="">enter class</option><!-- /.option-->
                                                            @foreach ($classes as $class)
                                                            @if ($class->name != 'Disabled')	
                                                            <option value="{{$class->id}}">{{$class->name}}</option><!-- /.option-->
                                                            @endif
                                                            @endforeach
                                                        </select><!-- /.select-->
                                                        @error('class')
                                                        <div class="div-text-validation">{{ $errors->first('class') }}</div>
                                                        @enderror
                                                    </div><!-- /.travel-select-icon -->
                                                </div><!--/.single-tab-select-box-->
                                            </div><!--/.col-->
                                        </div>       
                                        
                                    </div><!--/.row-->
                                    <div class="row">
                                        <div class="clo-sm-5">
                                            <div class="about-btn pull-right">
                                                <button  type="submit" class="about-view travel-btn">
                                                    Booking  
                                                </button><!--/.travel-btn-->
                                            </div><!--/.about-btn-->
                                        </div><!--/.col-->
                                    </div>
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
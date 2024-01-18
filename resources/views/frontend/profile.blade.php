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
								Profile
							</h2>
						</div><!--/.about-us-txt-->
					</div><!--/.single-about-us-->
				</div><!--/.col-->
				
			</div><!--/.row-->
		</div><!--/.about-us-content-->
	</div><!--/.container-->
</section><!--/.about-us-->
<!--travel-box start-->
<section  class="travel-box" id="profile">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="single-travel-boxes">
                    <div id="desc-tabs" class="desc-tabs">

                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation">
                                <a href="#" >
                                    <i class="fa fa-plane"></i>
                                    Your Passenger Information
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">							
                            <div role="tabpanel" class="tab-pane active fade in" id="flights">
                                <form action='{{url("passenger/{$passenger->id}")}}' method="POST" enctype="multipart/form-data">
                                @csrf
                                {{method_field('PATCH')}}

                                    <div class="tab-para">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-5 col-sm-6">
                                                <div class="single-tab-select-box">
                                                    <h2>First Name</h2>
                                                    <div class="input-by-user @error('first_name') div-input-validation @enderror">
                                                        <input type="text" name="first_name" value="{{ $passenger->first_name}}" class="form-control" placeholder="Enter your first Name">
                                                    </div>
                                                    @error('first_name')
                                                    <div class="div-text-validation">{{ $errors->first('first_name') }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-5 col-sm-6">
                                                <div class="single-tab-select-box">
                                                    <h2>Last Name</h2>
                                                    <div class="input-by-user @error('last_name') div-input-validation @enderror">
                                                        <input type="text" name="last_name" value="{{ $passenger->last_name }}" class="form-control" placeholder="Enter your last Name">
                                                    </div>
                                                    @error('last_name')
                                                    <div class="div-text-validation">{{ $errors->first('last_name') }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-5 col-sm-6">
                                                <div class="single-tab-select-box">
                                                    <h2>Choose your Country:</h2>
                                                    <div class="travel-select-icon @error('country_id') div-input-validation @enderror">
                                                        <select class="form-control" name="country_id">
                                                            <option value="" selected>Choose your Country</option>
                                                            @foreach ($countries as $country)
                                                                <option @if($passenger->country_id == $country->id) selected @endif  value="{{$country->id}}" >{{$country->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('country_id')
                                                        <div class="div-text-validation">{{ $errors->first('country_id') }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-5 col-sm-6">
                                                <div class="single-tab-select-box">
                                                    <h2>Phone</h2>
                                                    <div class="input-by-user @error('phone') div-input-validation @enderror">
                                                        <input type="text" name="phone" value="{{ $passenger->phone }}" class="form-control" placeholder="Enter your phone number" >
                                                    </div>
                                                    @error('phone')
                                                    <div class="div-text-validation">{{ $errors->first('phone') }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-5 col-sm-6 ">
                                                <div class="single-tab-select-box">
                                                    <h2>Birthday</h2>
                                                    <div class="input-by-user @error('birthday') div-input-validation @enderror">
                                                        <input type="date" name="birthday" value="{{ $passenger->birthday }}" class="form-control">
                                                    </div>
                                                    @error('birthday')
                                                    <div class="div-text-validation">{{ $errors->first('birthday') }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-4 col-md-5 col-sm-6">
                                                <div class="single-tab-select-box">
                                                    <h2>Birthday</h2>
                                                    <div class="travel-check-icon">
                                                        <form action="#">
                                                            <input type="date" name="birthday" class="form-control" data-toggle="datepicker"  value="{{ old('birthday') }}">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="col-lg-4 col-md-5 col-sm-6">
                                                <div class="single-tab-select-box">
                                                    <h2>Gender</h2>
                                                    <div class="travel-select-icon @error('gender') div-input-validation @enderror">
                                                        <select class="form-control" name="gender">
                                                            <option value="" selected>Chosse Gender</option>
                                                            <option value="female" @if($passenger->gender == 'female') selected @endif >Female</option>
                                                            <option value="male"  @if($passenger->gender == 'male') selected @endif >Male</option>
                                                        </select>
                                                        @error('gender')
                                                        <div class="div-text-validation">{{ $errors->first('gender') }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-5 col-sm-6">
                                                <div class="single-tab-select-box">
                                                    <h2>Passport</h2>
                                                    <div class="input-by-user @error('passport') div-input-validation @enderror">
                                                        <input type="file" name="passport" value="{{ $passenger->passport }}" class="form-control" style="padding-top: 11px;">
                                                    </div>
                                                    @error('passport')
                                                    <div class="div-text-validation">{{ $errors->first('passport') }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-5 col-sm-6">
                                                    <img src='{{ asset("assets/images/passenger/{$passenger->passport}") }}' alt="passport Image" style="margin-top: 10px;"  width="150px">
                                            </div>
                                        </div><!--/.row-->
                                        <div class="row">
                                            <div class="clo-sm-5">
                                                <div class="about-btn pull-right">
                                                    <button  type="submit" class="about-view travel-btn">
                                                        Edit	
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

<div class="container">
    <div class="packages-content">
        <div class="row contact-form">
            {{-- <div class="col-md-12"> --}}
            <table class="table">
                      <thead>
                      <tr>
                          <th>Flights Name</th>
                          <th>Type of reserved seat</th>
                          <th>Seat price</th>
                          {{-- <th>Delete</th> --}}
                      </tr>
                      </thead>
                      <tbody>
                        @foreach($profileBookings as $profileBooking)
                        <tr>
                            <td> From {{$profileBooking->flightSeat->flightSchedule->direction->originAirport->city->name}} To {{$profileBooking->flightSeat->flightSchedule->direction->destinationAirport->city->name}}</td>
                            <td>{{$profileBooking->flightSeat->seat->travelClass->name}}</td>
                             <td>{{$profileBooking->flightSeat->price}}</td>
                            {{-- <td>
                                <form method="post" action='{{url("")}}'>
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>  --}}
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
                  <div class="row">
                    <div class="col-md-12">
                        <p>Number of reserved seats: {{$countNumSeat}}</p>
                        @php
                            $totalPrice = 0;
                        @endphp
                        @foreach($profileBookings as $profileBooking)
                            @php
                                $totalPrice += $profileBooking->flightSeat->price;
                            @endphp
                        @endforeach
                        <p>Total Price: {{$totalPrice}}</p>
                    </div>
                </div>
            </div>
        </div>
      </div><!--/.packages-content-->
    
</div>

@endsection
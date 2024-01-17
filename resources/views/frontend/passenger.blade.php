@extends('frontend.master')
@section('title')
 
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
                                <a href="#" >
                                    <i class="fa fa-plane"></i>
                                    Passenger
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">							
                            <div role="tabpanel" class="tab-pane active fade in" id="flights">
                                <form action="{{url('passenger')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="tab-para">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-5 col-sm-6">
                                                <div class="single-tab-select-box">
                                                    <h2>First Name</h2>
                                                    <div class="input-by-user @error('first_name') div-input-validation @enderror">
                                                        <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" placeholder="Enter your first Name">
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
                                                        <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" placeholder="Enter your last Name">
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
                                                                <option @if(old('country_id')== $country->id) selected @endif  value="{{$country->id}}" >{{$country->name}}</option>
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
                                                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Enter your phone number" >
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
                                                        <input type="date" name="birthday" value="{{ old('birthday') }}" class="form-control">
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
                                                            <option value="female" @if(old('gender')== 'female') selected @endif >Female</option>
                                                            <option value="male"  @if(old('gender')== 'male') selected @endif >Male</option>
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
                                                        <input type="file" name="passport" value="{{ old('passport') }}" class="form-control" style="padding-top: 11px;">
                                                    </div>
                                                    @error('passport')
                                                    <div class="div-text-validation">{{ $errors->first('passport') }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="clo-sm-5">
                                                <div class="about-btn pull-right">
                                                    <button  type="submit" class="about-view travel-btn">
                                                        submit	
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
@endsection
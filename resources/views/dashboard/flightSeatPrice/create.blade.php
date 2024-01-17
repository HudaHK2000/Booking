@extends('dashboard.dashboard')
@section('content')
<div class="row">
    <!-- [ form-element ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Add Price Of Seats</h5>
                <div class="card-header-right">
                    <div class="btn-group card-option">
                        <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="feather icon-more-horizontal"></i>
                        </button>
                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(12px, 28px, 0px);">
                            <li class="dropdown-item full-card"><a href="#!"><span style=""><i class="feather icon-maximize"></i> maximize</span><span style="display: none;"><i class="feather icon-minimize"></i> Restore</span></a></li>
                            <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                            <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-header">
                <p>Flight Number: {{ $flightSchedule->id }} </p>
                <p>From Airport: {{ $flightSchedule->direction->originAirport->name }} , To Airport: {{ $flightSchedule->direction->destinationAirport->name }}</p>
                <p>Airline: {{ $flightSchedule->airplaneFlight->airline->name }} , With Airplane: {{ $flightSchedule->airplaneFlight->model }}</p>
                <p>Number of Seats: {{ $flightSchedule->airplaneFlight->number_of_seats }}</p>
            </div>
            <div class="card-body">
                <form role="form" method="POST" action="{{ url('flightSeatPrice') }}" enctype="multipart/form-data">
                    @csrf
                    @if (session()->has('success'))
                        <div class="row">
                            <div class="alert alert-primary alert-dismissible fade show col-lg-12" role="alert">
                                <strong>{{ session()->get('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                        </div>
                    @endif
                    <input type="hidden" name="flight_id" value="{{ $flightSchedule->id }}">
                    <div class="form-row">
                        <div class="form-group col-md-6 @error('first_class') input-was-validated @enderror">
                            <label for="inputPriceSeatForFirstClass">For First Class :</label>
                            <input type="number" name="first_class" class="form-control" id="inputPriceSeatForFirstClass" placeholder="Price seat For First Class" value="{{ old('first_class') }}">
                            @error('first_class')
                            <div>{{ $errors->first('first_class') }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 @error('business_class') input-was-validated @enderror">
                            <label for="inputPriceSeatForBusinessClass">For Business Class :</label>
                            <input type="number" name="business_class" class="form-control" id="inputPriceSeatForBusinessClass" placeholder="Price seat For Business Class" value="{{ old('business_class') }}">
                            @error('business_class')
                            <div>{{ $errors->first('business_class') }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 @error('premium_economy_class') input-was-validated @enderror">
                            <label for="inputPriceSeatForPremiumEconomyClass">For Premium Economy Class :</label>
                            <input type="number" name="premium_economy_class" class="form-control" id="inputPriceSeatForPremiumEconomyClass" placeholder="Price seat For Premium Economy Class" value="{{ old('premium_economy_class') }}">
                            @error('premium_economy_class')
                            <div>{{ $errors->first('premium_economy_class') }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 @error('economy_class') input-was-validated @enderror">
                            <label for="inputPriceSeatForEconomyClass">For Economy Class :</label>
                            <input type="number" name="economy_class" class="form-control" id="inputPriceSeatForEconomyClass" placeholder="Price seat For Economy Class" value="{{ old('economy_class') }}">
                            @error('economy_class')
                            <div>{{ $errors->first('economy_class') }}</div>
                            @enderror
                        </div>

                    </div>
                    <button type="submit" class="btn  btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
    <!-- [ form-element ] end -->
</div>
@endsection
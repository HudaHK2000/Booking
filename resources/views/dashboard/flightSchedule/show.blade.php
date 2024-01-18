@extends('dashboard.dashboard')
@section('content')
<div class="row">
    <!-- [ form-element ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Details of the trip Passenger</h5>
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
            <div class="card-body">
                <p>Flight Number: {{ $flightSchedule->id }} </p>
                <p>From Airport: {{ $flightSchedule->direction->originAirport->name }} <br> To Airport: {{ $flightSchedule->direction->destinationAirport->name }}</p>
                <p>Airline: {{ $flightSchedule->airplaneFlight->airline->name }} <br> With Airplane: {{ $flightSchedule->airplaneFlight->model }}</p>
                <p>Number of Seats: {{ $flightSchedule->airplaneFlight->number_of_seats }}</p>
                <p>
                    @if(isset($price[0]->price))
                    {{-- <p style="margin-block: 20px"> --}}
                        The price of a seat in first class: 
                        {{ $price[0]->price }} $
                    {{-- </p> --}}
                    <br>
                @endif
                @if(isset($price[1]->price))
                    {{-- <p style="margin-block: 20px"> --}}
                        The price of a seat in business class: 
                        {{ $price[1]->price }} $
                    {{-- </p> --}}
                    <br>
                @endif
                @if(isset($price[2]->price))
                    {{-- <p style="margin-block: 20px"> --}}
                        The price of a seat in premium class: 
                        {{ $price[2]->price }} $
                    {{-- </p> --}}
                    <br>
                @endif
                @if(isset($price[3]->price))
                    {{-- <p style="margin-block: 20px"> --}}
                        The price of a seat in economy class: 
                        {{ $price[3]->price }} $
                    {{-- </p> --}}
                @endif
                </p>
            </div>
        </div>
    </div>
    <!-- [ form-element ] end -->
</div>
@endsection
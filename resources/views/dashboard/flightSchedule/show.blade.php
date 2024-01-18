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
                <div class="row">
                    <div class="card mb-3 col-md-4" style="border-top:none; border: 1px solid #2C3E50; padding-top:15px" >
                        <img class="img-fluid card-img-top" src='{{ asset("flightImage/{$flightSchedule->image}") }}' alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Flight Number: {{ $flightSchedule->id }}</h5>
                            <p class="card-text">From Airport: {{ $flightSchedule->direction->originAirport->name }}</p>
                            <p class="card-text">To Airport: {{ $flightSchedule->direction->destinationAirport->name }}</p>
                            <p class="card-text">Airline: {{ $flightSchedule->airplaneFlight->airline->name }}</p>
                            <p class="card-text">With Airplane: {{ $flightSchedule->airplaneFlight->model }}</p>
                            <p class="card-text">Number of Seats: {{ $flightSchedule->airplaneFlight->number_of_seats }}</p>
                        </div>
                    </div>
                    <div class="col-md-8">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Class</th>
                                                <th>First</th>
                                                <th>Business</th>
                                                <th>Premium Economy</th>
                                                <th>Economy</th>
                                            </tr>
                                            <tr>
                                                <th>Price</th>
                                                <th>
                                                    @if(isset($price[0]->price))
                                                        {{ $price[0]->price }} $
                                                        @else 
                                                        0
                                                    @endif
                                                </th>
                                                <th>
                                                    @if(isset($price[1]->price))
                                                        {{ $price[1]->price }} $
                                                        @else 
                                                        0
                                                    @endif
                                                </th>
                                                <th>
                                                    @if(isset($price[2]->price))
                                                        {{ $price[2]->price }} $
                                                        @else 
                                                        0
                                                    @endif
                                                </th>
                                                <th>
                                                    @if(isset($price[3]->price))
                                                        {{ $price[3]->price }} $
                                                        @else 
                                                        0
                                                    @endif
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Total number</td>
                                                <td>
                                                    @if(isset($allSeat['First Class']))
                                                        {{ $allSeat['First Class'] }} 
                                                        @else 
                                                        0
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($allSeat['Business Class']))
                                                        {{ $allSeat['Business Class'] }} 
                                                        @else 
                                                        0
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($allSeat['Premium Economy Class']))
                                                        {{ $allSeat['Premium Economy Class'] }} 
                                                        @else 
                                                        0
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($allSeat['Economy Class']))
                                                        {{ $allSeat['Economy Class'] }}
                                                    @else 
                                                        0
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Number reserved</td>
                                                <td>
                                                    @if(isset($seatsCount['First Class']))
                                                        {{ $seatsCount['First Class'] }} 
                                                        @else 
                                                        0
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($seatsCount['Business Class']))
                                                        {{ $seatsCount['Business Class'] }} 
                                                        @else 
                                                        0
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($seatsCount['Premium Economy Class']))
                                                        {{ $seatsCount['Premium Economy Class'] }} 
                                                        @else 
                                                        0
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($seatsCount['Economy Class']))
                                                        {{ $seatsCount['Economy Class'] }} 
                                                        @else 
                                                        0
                                                    @endif
                                                </td>
                                            </tr>
                                         
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ form-element ] end -->
</div>
@endsection
@extends('dashboard.dashboard')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5>Booking</h5>
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    @if (session()->has('success'))
                    <div class="offset-lg-1 alert alert-primary alert-dismissible fade show col-lg-10" role="alert">
                        <strong>{{ session()->get('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @endif
                    <table class="table table-hover .table_content_center">
                        <thead>
                            <tr>
                                <th>Passenger name</th>
                                <th>Flight Num</th>
                                <th>Flights</th>
                                <th>Agree</th>
                                <th>Not Agree</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $key=>$booking)
                            <tr>
                                <td style="text-transform: capitalize;">{{ $booking->passenger->first_name }} {{ $booking->passenger->last_name }}</td>
                                <td>{{ $booking->flightSeat->flightSchedule->id }}</td>
                                <td style="text-transform: capitalize;">
                                    <a href='{{ url("flightSchedule/{$booking->flightSeat->flightSchedule->id}") }}'>From {{ $booking->flightSeat->flightSchedule->direction->originAirport->city->name }} 
                                        To {{ $booking->flightSeat->flightSchedule->direction->destinationAirport->city->name }}
                                    </a>    
                                </td>
                                <td>
                                    <form method="post" action='{{ url("") }}'>
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success" >
                                            Agree
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action='{{ url("") }}'>
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger" >
                                            Not Agree
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
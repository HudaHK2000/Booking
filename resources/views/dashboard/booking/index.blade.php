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
                                <th>#</th>
                                <th>Passenger name</th>
                                <th>Flights</th>
                                {{-- <th>Edit</th>
                                <th>Delete</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1; ?>
                            @foreach ($bookings as $booking)
                            <tr>
                                <td>
                                    <?php echo $count++ ?>
                                </td>
                                <td style="text-transform: uppercase;">{{ $booking->passenger->first_name }} {{ $booking->passenger->last_name }}</td>
                                <td style="text-transform: capitalize;">From {{ $booking->flightSeat->flightSchedule->direction->originAirport->city->name }}  To {{ $booking->flightSeat->flightSchedule->direction->destinationAirport->city->name }}</td>

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
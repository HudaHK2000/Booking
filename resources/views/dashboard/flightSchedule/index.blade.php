@extends('dashboard.dashboard')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5>Flights Scheduls</h5>
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
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>From Airpot</th>
                                <th>To Airport</th>
                                <th>Departure Date/Time</th>
                                <th>Arrival Date/time</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($flightSchedules as $key=>$flightSchedule)
                            <tr style="align-items: center;align-content: center;">
                                <td class="center">
                                    {{ $key+1 }}
                                </td>
                                <td style="text-transform: capitalize;">{{ $flightSchedule->origin_airports->origin_airport->name }}</td>
                                <td style="text-transform: capitalize;">{{ $flightSchedule->destination_airports->destination_airport->name }}</td>
                                <td>{{ $flightSchedule->departure_time }}</td>
                                <td>{{ $flightSchedule->arrival_time }}</td>
                                <td>
                                    <a href='{{ url("flightSchedule/$flightSchedule->id/edit") }}' class="btn btn-outline-primary">
                                        Edit
                                    </a>
                                </td>
                                <td>
                                    <form method="post" action='{{ url("flightSchedule/$flightSchedule->id") }}'>
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger" >
                                            Delete
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
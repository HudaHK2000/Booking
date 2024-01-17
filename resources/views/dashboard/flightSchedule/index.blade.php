@extends('dashboard.dashboard')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5>Flights Scheduls</h5>
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
                                <th>Image</th>
                                <th>Airline</th>
                                <th>Airplane</th>
                                <th>Status</th>
                                <th>Departure Date/Time</th>
                                <th>Arrival Date/time</th>
                                <th>Price</th>
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
                                <td style="text-transform: capitalize;">{{ $flightSchedule->direction->originAirport->name }}</td>
                                <td style="text-transform: capitalize;">{{ $flightSchedule->direction->destinationAirport->name }}</td>
                                <td>
                                    <img src='{{ asset("flightImage/{$flightSchedule->image}") }}' width="50px" alt="">
                                <td>{{ $flightSchedule->airplaneFlight->airline->name }}</td>
                                <td>{{ $flightSchedule->airplaneFlight->model }}</td>
                                <td>
                                    @if ($flightSchedule->flightStatu->name == 'Done')
                                        <span  class="btn btn-outline-info" >
                                            <i class="feather mr-2 icon-check-circle"></i>
                                            {{ $flightSchedule->flightStatu->name }}
                                        </span>
                                    @elseif ($flightSchedule->flightStatu->name == 'Waiting')
                                        <span  class="btn btn-outline-info" >
                                            <i class="feather mr-2 icon-info"></i>
                                            {{ $flightSchedule->flightStatu->name }}
                                        </span>
                                    @endif
                                  
                                </td>
                                <td>{{ $flightSchedule->departure_time }}</td>
                                <td>{{ $flightSchedule->arrival_time }}</td>
                                <td>
                                    <a href='{{ url("flightSeatPrice/$flightSchedule->id") }}' class="btn  btn-outline-success">
                                        Add Price
                                    </a>
                                </td>
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
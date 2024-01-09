@extends('dashboard.dashboard')
@section('content')
<div class="row">
    <!-- [ form-element ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Add Flights</h5>
            </div>
            <div class="card-body">
                <form role="form" method="POST" action="{{ url('flightSchedule') }}" enctype="multipart/form-data">
                    @csrf
                    @if (session()->has('success'))
                        <div class="row">
                            <div class="alert alert-primary alert-dismissible fade show col-lg-12" role="alert">
                                <strong>{{ session()->get('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                        </div>
                    @endif
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputFromAirport">From Airport To Airport:</label>
                            <select id="inputFromAirport" class="form-control" name="airports">
                                <option selected="">select airports</option>
                                @foreach ($directions as $direction )
                                    <option value="{{$direction->id}}">From {{$direction->origin_airport->name}} To {{$direction->destination_airport->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputDepartureTime">Departure Date Time:</label>
                            <input type="datetime-local" name="departure_time" class="form-control" id="inputDepartureTime" placeholder="Departure Date Time">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputArrivalTime">Arrival Date Time"</label>
                            <input type="datetime-local" name="arrival_time" class="form-control" id="inputArrivalTime" placeholder="Arrival Date Time">
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
@extends('dashboard.dashboard')
@section('content')
<div class="row">
    <!-- [ form-element ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit direction from airport to airport</h5>
            </div>
            <div class="card-body">
                <form role="form" method="post" action='{{ url("direction/$direction->id") }}' enctype="multipart/form-data">
                    {{method_field('PATCH')}}
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
                            <label for="inputFromAirport">From Airport:</label>
                            <select id="inputFromAirport" class="form-control" name="origin_airport_code">
                                <option selected="">select airport:</option>
                                @foreach ($airports as $airport )
                                    <option value="{{$airport->airport_code}}"
                                        @if ($airport->airport_code == $direction->origin_airport_code)
                                            selected
                                        @endif
                                        >{{$airport->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputToAirport">To Airport:</label>
                            <select id="inputToAirport" class="form-control" name="destination_airport_code">
                                <option selected="">select airport:</option>
                                @foreach ($airports as $airport )
                                    <option value="{{$airport->airport_code}}"
                                        @if ($airport->airport_code == $direction->destination_airport_code)
                                            selected
                                        @endif
                                        >{{$airport->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn  btn-primary">Edit</button>
                </form>
            </div>
        </div>
    </div>
    <!-- [ form-element ] end -->
</div>
@endsection
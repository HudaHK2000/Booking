@extends('dashboard.dashboard')
@section('content')
<div class="row">
    <!-- [ form-element ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit Airplane</h5>
            </div>
            <div class="card-body">
                <form role="form" method="POST" action="{{  url("airplane/{$airplane->id}") }}" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PATCH')}}
                    @if (session()->has('success'))
                        <div class="row">
                            <div class="alert alert-primary alert-dismissible fade show col-lg-12" role="alert">
                                <strong>{{ session()->get('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                        </div>
                    @endif
                    <div class="form-row">
                        <div class="form-group col-md-6 @error('airline_id') input-was-validated @enderror">
                            <label for="inputAirline">Airline</label>
                            <select id="inputAirline" class="form-control" name="airline_id">
                                @foreach ($airlines as $airline )
                                    <option value="{{$airline->id}}"
                                        @if ($airline->id == $airplane->airline_id)
                                            selected
                                        @endif
                                        >{{$airline->name}}</option>
                                @endforeach
                            </select>
                            @error('airline_id')
                            <div>{{ $errors->first('airline_id') }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 @error('model') input-was-validated @enderror">
                            <label for="inputairplane">airplane</label>
                            <input type="text" name="model" value="{{ $airplane->model }}" class="form-control" id="inputairplane" placeholder="airplane model">
                            @error('model')
                            <div>{{ $errors->first('model') }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 @error('number_of_seats') input-was-validated @enderror">
                            <label for="airplaneSeat">Number Of Seats</label>
                            <input type="number" name="number_of_seats" value="{{ $airplane->number_of_seats }}" class="form-control" id="airplaneSeat" placeholder="Airplane Number Of Seats">
                            @error('number_of_seats')
                            <div>{{ $errors->first('number_of_seats') }}</div>
                            @enderror
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
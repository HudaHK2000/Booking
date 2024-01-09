@extends('dashboard.dashboard')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5>Airplane's Seats</h5>
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table table-hover .table_content_center">
                        <thead>
                            <tr>
                                <th>Number Of Seat</th>
                                <th>Travel Class</th>
                                <th>Save</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (session()->has('success'))
                                <div class="row">
                                    <div class="alert alert-primary alert-dismissible fade show col-lg-12" role="alert">
                                        <strong>{{ session()->get('success') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                </div>
                            @endif
                            @foreach ($airplaneSeats as $airplaneSeat)
                            <tr>
                                <form role="form" method="POST" action='{{ url("airplaneSeat/{$airplaneSeat->id}") }}' enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="form-row">  
                                        <td style="text-transform: capitalize;">{{ $airplaneSeat->seat_id }}</td>
                                        <td style="text-transform: capitalize;">
                                            <div class="form-group col-md-6 @error('travel_class_id') input-was-validated @enderror">
                                                <select id="inputTravelClass" class="form-control" name="travel_class_id">
                                                    @foreach ($travelClasses as $travelClass )
                                                        <option value="{{$travelClass->id}}"
                                                            @if ($travelClass->id ==   $airplaneSeat->travelClass->id )
                                                                selected
                                                            @endif
                                                            >{{$travelClass->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('travel_class_id')
                                                <div>{{ $errors->first('travel_class_id') }}</div>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn  btn-primary"  style="margin: auto; display: block">Save</button>
                                        </td>
                                    </div>
                                </form>
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
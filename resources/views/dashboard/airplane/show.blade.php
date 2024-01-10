@extends('dashboard.dashboard')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $airplaneSeats[0]->airplane->model }} Airplane Seats</h5><br>
                <p class="mt-2">Number of seats: {{ $airplaneSeats[0]->airplane->number_of_seats }}</p>
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table table-hover .table_content_center">
                        <thead>
                            <tr>
                                <th>Number Of Seat</th>
                                <th>Travel Class</th>
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
                                <div class="form-row">  
                                    <td style="text-transform: capitalize;">{{ $airplaneSeat->seat_id }}</td>
                                    <td style="text-transform: capitalize;">
                                        <div class="form-group col-md-6 @error('travel_class_id') input-was-validated @enderror">
                                            <form action='{{ url("airplaneSeat/{$airplaneSeat->id}") }}' method="post" class="myForm">
                                                @csrf
                                                    <select name="travel_class_id" id="myForm{{ $airplaneSeat->id }}" class="form-control" >
                                                        @foreach ($travelClasses as $travelClass )
                                                            <option value="{{$travelClass->id}}"
                                                            @if ($travelClass->id ==   $airplaneSeat->travelClass->id )
                                                                selected
                                                            @endif
                                                            >{{$travelClass->name}}</option>
                                                        @endforeach
                                                    </select>
                                            </form>
                                            @error('travel_class_id')
                                            <div>{{ $errors->first('travel_class_id') }}</div>
                                            @enderror
                                        </div>
                                    </td>
                                </div>
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
@section('script')
<script>
    $('select').on('change', function(){
        var seatId = $(this).closest('tr').find('td:first').text();
        var travelClassId = $(this).val();
        var urlAirplaneSeat =$(this).closest('form').attr('action');

// console.log(seatId,travelClassId,urlAirplaneSeat);
        $.ajax({
            url: urlAirplaneSeat,
            type: "POST",
            data: {
                'seat_id': seatId,
                'travel_class_id': travelClassId,
                '_token': '{{ csrf_token() }}'
            },
            success: function(response){
                console.log(response);
            }
        });
    });
</script>
@endsection

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
                        <div class="form-group col-md-6  @error('airports') input-was-validated @enderror">
                            <label for="inputFromAirport">From Airport To Airport:</label>
                            <select id="inputFromAirport" class="form-control" name="airports">
                                <option selected="" value="">select airports</option>
                                @foreach ($directions as $direction )
                                    <option @if(old('airports')== $direction->id) selected @endif  value="{{$direction->id}}">From {{$direction->originAirport->name}} To {{$direction->destinationAirport->name}}</option>
                                @endforeach
                            </select>
                            @error('airports')
                                <div>{{ $errors->first('airports') }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 @error('airline') input-was-validated @enderror">
                            <label for="inputAirline">Airline:</label>
                            <select id="inputAirline" class="form-control" name="airline">
                                <option selected="" value="">select airline</option>
                                @foreach ($airlines as $airline )
                                    <option @if(old('airline')== $airline->id) selected @endif  value="{{$airline->id}}">{{$airline->name}}</option>
                                @endforeach
                            </select>
                            @error('airline')
                            <div>{{ $errors->first('airline') }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6  @error('airplane') input-was-validated @enderror">
                            <label for="inputAirplane">Airplane:</label>
                            <select id="inputAirplane" class="form-control" name="airplane">
                                <option selected="" value="">select Airplane:</option>
                                @foreach ($airplanes as $key=>$airplane )
                                    <option @if(old('airplane')== $airplane->id) selected @endif value="{{$airplane->id}}">{{$airplane->name}}</option>
                                @endforeach
                            </select>   
                            @error('airplane')
                            <div>{{ $errors->first('airplane') }}</div>
                            @enderror 
                        </div>
                        <div class="form-group col-md-6  @error('departure_time') input-was-validated @enderror">
                            <label for="inputDepartureTime">Departure Date Time:</label>
                            <input type="datetime-local" name="departure_time" value="{{ old('departure_time') }}" class="form-control" id="inputDepartureTime" placeholder="Departure Date Time">
                            @error('departure_time')
                                <div>{{ $errors->first('departure_time') }}</div>
                            @enderror 
                        </div>
                        <div class="form-group col-md-6  @error('arrival_time') input-was-validated @enderror">
                            <label for="inputArrivalTime">Arrival Date Time"</label>
                            <input type="datetime-local" name="arrival_time" value="{{ old('arrival_time') }}" class="form-control" id="inputArrivalTime" placeholder="Arrival Date Time">
                            @error('arrival_time')
                                <div>{{ $errors->first('arrival_time') }}</div>
                            @enderror 
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
@section('script')
<script>
    $(document).ready(function(){
        $('#inputAirline').on('change', function(){
            var airlineId = $(this).val();
            // console.log(airlineId);
            if(airlineId){
                $.ajax({
                    url: '/getAirplanesByAirline/'+airlineId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        if(data.length > 0){ // تحقق من وجود بيانات
                            $('#inputAirplane').empty();
                            $.each(data, function(key, value){
                            $('#inputAirplane').append('<option value="'+value.id+'">'+value.model+'</option>');
                        });
                        }
                        else{
                            $('#inputAirplane').empty();
                            $('#inputAirplane').append('<option selected="">No Airplane For this Airline</option>');
                        }
                    }
                });
            } else {
                $('#inputAirplane').empty();
                $('#inputAirplane').append('<option selected="">No Airplane For this Airline</option>');
            }
        });
    });
</script>

@endsection
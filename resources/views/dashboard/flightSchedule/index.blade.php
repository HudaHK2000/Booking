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
                    <form class="form-group" action="{{ url('flightSchedule') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-3 col-sm-6 @error('origin_airport_code') input-was-validated @enderror">
                                <label for="inputFromAirport">From Airport:</label>
                                <select id="inputFromAirport" class="form-control" name="search_origin_airport">
                                    <option value="">select airport:</option>
                                    @foreach ($airports as $airport)
                                        <option value="{{ $airport->id }}" {{ (old('search_origin_airport') == $airport->id) ? 'selected' : '' }}>
                                            {{ $airport->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3 col-sm-6">
                                <label for="inputToAirport">To Airport:</label>
                                <select id="inputToAirport" class="form-control" name="search_destination_airport">
                                    <option value="">select airport:</option>
                                    @foreach ($airports as $airport)
                                        <option value="{{ $airport->id }}" {{ (old('search_destination_airport') == $airport->id) ? 'selected' : '' }}>
                                            {{ $airport->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3 col-sm-6">
                                <label for="inputAirline">Airline</label>
                                <select id="inputAirline" class="form-control" name="search_airline">
                                    <option selected="" value="">select Airline</option>
                                    @foreach ($airlines as $airline )
                                        <option @if(old('search_airline')== $airline->id) selected @endif value="{{$airline->id}}">{{$airline->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3 col-sm-6">
                                <label for="inputAirplane">Airplane:</label>
                                <select id="inputAirplane" class="form-control" name="search_airplane">
                                    <option selected="" value="">select Airplane:</option>
                                    @foreach ($airplanes as $key=>$airplane )
                                        <option 
                                        @if(old('search_airplane')== $airplane->id)selected @endif
                                        value="{{$airplane->id}}" > {{$airplane->model}} </option>
                                    @endforeach
                                </select>   
                            </div>
                            <div class="form-group col-md-3 col-sm-6">
                                <label for="inputFlightStatu">Flight Statu:</label>
                                <select id="inputFlightStatu" class="form-control" name="search_flight_status">
                                    <option selected="" value="">select Flight Statu:</option>
                                    @foreach ($flightStatus as $key=>$flightStatu )
                                        <option 
                                        @if(old('search_flight_status')== $flightStatu->id)selected @endif
                                        value="{{$flightStatu->id}}" > {{$flightStatu->name}} </option>
                                    @endforeach
                                </select>   
                            </div>
                            <div class="form-group col-lg-3 col-md-4 col-sm-6 div_search">
                                <label for="inputSearchDateDeparture" class="" style="margin-right: 10px">departure:</label>
                                <input type="date" name="searchDateDeparture" value="{{app('request')->input('searchDateDeparture')}}" class="form-control" id="inputSearchDateDeparture" placeholder="">
                            </div>
                            <div class="form-group col-lg-3 col-md-4 col-sm-6 div_search">
                                <label for="inputSearchTeteArrival" class="" style="margin-right: 10px">arrival:</label>
                                <input type="date" name="searchDateArrival"  value="{{app('request')->input('searchDateArrival')}}" class="form-control" id="inputSearchDateArrival" placeholder="">
                            </div>
                            <div class="form-group col-lg-3 col-md-4 col-sm-6 mb-2"
                            style="display: flex; align-items: flex-end;">
                                {{-- <label for="inputSearchTeteArrival" class="" style="margin-right: 10px"></label> --}}

                                <button type="submit" class="btn btn-primary mb-2" style="width: 140px;">Search</button>
                            </div>
                        </div>
                        {{-- <div class="row" style="flex-direction: row-reverse;">
                            <button type="submit" class="btn  btn-primary mb-2" style="width: 140px;">Search</button>
                        </div> --}}
                    </form>
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
                                <th>Num</th>
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
                                <td >{{ $flightSchedule->id }}</td>
                                {{-- <td class="center">
                                    {{ $key+1 }}
                                </td> --}}
                                <td style="text-transform: capitalize;">{{ $flightSchedule->direction->originAirport->name }}</td>
                                <td style="text-transform: capitalize;">{{ $flightSchedule->direction->destinationAirport->name }}</td>
                                <td>
                                    <img src='{{ asset("flightImage/{$flightSchedule->image}") }}' width="50px" alt="">
                                <td>{{ $flightSchedule->airplaneFlight->airline->name }}</td>
                                <td>{{ $flightSchedule->airplaneFlight->model }}</td>
                                <td>
                                    <form action='{{ url("update-flight-status/{$flightSchedule->id}") }}' method="post">
                                        @csrf
                                        <div class="form-group" >
                                            <select id="ChangeFlightStatu" class="form-control ChangeFlightStatu" name="flight_statu" style="width: 150px">
                                                @foreach ($flightStatus as $flightStatu )
                                                    <option 
                                                    @if($flightSchedule->flightStatu->id== $flightStatu->id)selected @endif
                                                    value="{{$flightStatu->id}}" > {{$flightStatu->name}} </option>
                                                @endforeach
                                            </select>   
                                        </div>
                                    </form>
                                </td>
                                <td>{{ $flightSchedule->departure_time }}</td>
                                <td>{{ $flightSchedule->arrival_time }}</td>
                                <td>
                                    <a href='{{ url("flightSeatPrice/$flightSchedule->id") }}' class="btn btn-outline-success">
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
                    {{-- {!! $flightSchedules->links() !!} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('.ChangeFlightStatu').change(function(){
            var flightId = $(this).closest('tr').find('td:first').text();
            var newStatusId = $(this).val();
            var urlAirplaneSeat =$(this).closest('form').attr('action');
console.log(flightId,newStatusId,urlAirplaneSeat);
            $.ajax({
                url: urlAirplaneSeat,
                type: 'POST',
                data: {
                    'flightId': flightId,
                    'newStatusId': newStatusId,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response){
                    // يمكنك إضافة رسالة تأكيد هنا أو تحديث الصفحة بشكل آخر
                    console.log(response);
                },
                error: function(xhr, status, error){
                    console.error(error);
                }
            });
        });
    });
</script>
@endsection
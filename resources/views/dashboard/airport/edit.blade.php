@extends('dashboard.dashboard')
@section('content')
<div class="row">
    <!-- [ form-element ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit Airport</h5>
            </div>
            <div class="card-body">
                <form role="form" method="POST" action='{{ url("airport/{$airport->id}") }}' enctype="multipart/form-data">
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
                        <div class="form-group col-md-6 @error('name') input-was-validated @enderror">
                            <label for="inputairport">Airport</label>
                            <input type="text" name="name" class="form-control" id="inputairport" placeholder="airport" value="{{ $airport->name }}">
                            @error('name')
                            <div>{{ $errors->first('name') }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 @error('airport_code') input-was-validated @enderror">
                            <label for="inputairportCode">Airport Code</label>
                            <input type="text" name="airport_code" class="form-control" id="inputairportCode" placeholder="airport Code" value="{{ $airport->airport_code }}">
                            @error('airport_code')
                            <div>{{ $errors->first('airport_code') }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 @error('country_id') input-was-validated @enderror">
                            <label for="inputCountry">Country:</label>
                            <input list="countries" name="country_name" id="inputCountry" class="form-control" value="{{ $airport->city->country->name }}" autocomplete="off">
                            <datalist id="countries">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->name }}"   data-country-id="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </datalist>
                            @error('country_id')
                            <div>{{ $errors->first('country_id') }}</div>
                            @enderror
                        </div>
                        
                        <!-- Input Hidden for Country ID -->
                        <input type="hidden" name="country_id" id="countryIdInput" value="{{ $airport->city->country_id }}">
                        <div class="form-group col-md-6">
                            <label for="inputCity">City</label>
                            <select id="inputCity" class="form-control" name="city_id">
                                <option selected="">select City</option>
                                @foreach ($cities as $key=>$city )
                                    <option @if($airport->city_id == $city->id) selected @endif value="{{$city->id}}">{{$city->name}}</option>
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
@section('script')
<script>
    $(document).ready(function(){
        $('#inputCountry').on('change', function(){
            var countryId;
            var selectedOption = $('datalist#countries option[value="' + $(this).val() + '"]');
            if (selectedOption.length > 0) {
                countryId = selectedOption.data('country-id');
                $('#countryIdInput').val(countryId);
            }
            if(countryId){
                $.ajax({
                    url: '/getCities/'+countryId, // استبدل هذا بالمسار الصحيح لطرح الطلب إلى الخادم
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        if(data.length > 0){ // تحقق من وجود بيانات
                            $('#inputCity').empty();
                            $.each(data, function(key, value){
                                $('#inputCity').append('<option value="'+value.id+'">'+value.name+'</option>');
                            });
                        }
                        else{
                            $('#inputCity').empty();
                            $('#inputCity').append('<option value="">No cities</option>');
                        }
                    }
                });
            } else {
                $('#inputCity').empty();
            }
        });
    });
</script>

@endsection
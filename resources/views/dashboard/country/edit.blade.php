@extends('dashboard.dashboard')
@section('content')
<div class="row">
    <!-- [ form-element ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit Country</h5>
            </div>
            <div class="card-body">
                <form role="form" method="POST" action='{{ url("country/{$country->id}") }}' enctype="multipart/form-data">
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
                            <label for="inputCountry">Country</label>
                            <input type="text" name="name" class="form-control" id="inputCountry" placeholder="Country" value="{{ $country->name }}">
                            @error('name')
                            <div>{{ $errors->first('name') }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 @error('country_code') input-was-validated @enderror">
                            <label for="inputCountryCode">Country Code</label>
                            <input type="text" name="country_code" class="form-control" id="inputCountryCode" placeholder="Country Code" value="{{ $country->country_code }}">
                            @error('name')
                            <div>{{ $errors->first('country_code') }}</div>
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
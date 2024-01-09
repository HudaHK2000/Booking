@extends('dashboard.dashboard')
@section('content')
<div class="row">
    <!-- [ form-element ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Add Country</h5>
            </div>
            <div class="card-body">
                <form role="form" method="POST" action="{{ url('country') }}" enctype="multipart/form-data">
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
                        <div class="form-group col-md-6 @error('name') input-was-validated @enderror">
                            <label for="inputCountry">Country</label>
                            <input type="text" name="name" class="form-control " value="{{ old('name') }}" id="inputCountry" placeholder="Country">
                            @error('name')
                            <div>{{ $errors->first('name') }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 @error('country_code') input-was-validated @enderror">
                            <label for="inputCountryCode">Country Code</label>
                            <input type="text" name="country_code" class="form-control" value="{{ old('country_code') }}" id="inputCountryCode" placeholder="Country Code">
                            @error('country_code')
                            <div>{{ $errors->first('country_code') }}</div>
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
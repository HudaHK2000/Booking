@extends('dashboard.dashboard')
@section('content')
<div class="row">
    <!-- [ form-element ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit Airline</h5>
            </div>
            <div class="card-body">
                <form role="form" method="POST" action="{{  url("airline/{$airline->id}") }}" enctype="multipart/form-data">
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
                            <label for="inputairline">airline</label>
                            <input type="text" name="name" class="form-control" id="inputairline" placeholder="Airline Name" value="{{ $airline->name }}">
                            @error('name')
                            <div>{{ $errors->first('name') }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 @error('address') input-was-validated @enderror">
                            <label for="inputAirlineAddress">Address</label>
                            <input type="text" name="address" class="form-control" id="inputAirlineAddress" placeholder="Airline Address" value="{{ $airline->address }}">
                            @error('address')
                            <div>{{ $errors->first('address') }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 @error('website') input-was-validated @enderror">
                            <label for="inputAirlineWebsite">Website</label>
                            <input type="text" name="website" class="form-control" id="inputAirlineWebsite" placeholder="Website" value="{{ $airline->website }}">
                            @error('website')
                            <div>{{ $errors->first('website') }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 @error('phone') input-was-validated @enderror">
                            <label for="inputAirlinePhone">Phone</label>
                            <input type="text" name="phone" class="form-control" id="inputAirlinePhone" placeholder="Phone" value="{{ $airline->phone }}">
                            @error('phone')
                            <div>{{ $errors->first('phone') }}</div>
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
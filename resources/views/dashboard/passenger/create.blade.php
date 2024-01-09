@extends('dashboard.dashboard')
@section('content')
<div class="row">
    <!-- [ form-element ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Add Passenger</h5>
            </div>
            <div class="card-body">
                <form role="form" method="POST" action="{{ url('passenger-store') }}" enctype="multipart/form-data">
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
                        {{-- gender''user_id'--}}
                        <div class="form-group col-md-6">
                            <label for="inputFirstName">First Name</label>
                            <input type="text" name="first_name" class="form-control" id="inputFirstName" placeholder="First Name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputLastName">last Name</label>
                            <input type="text" name="last_name" class="form-control" id="inputLastName" placeholder="Last Name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPhone">Phone</label>
                            <input type="number" name="phone" class="form-control" id="inputPhone" placeholder="Passenger Phone">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputBirthday">Birthday</label>
                            <input type="date" name="birthday" class="form-control" id="inputBirthday" placeholder="Passenger Birthday">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassport">passport</label>
                            <div class="input-group ">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputPassport">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCountry">country</label>
                            <select id="inputCountry" class="form-control" name="country_id">
                                <option selected="">select country</option>
                                @foreach ($countries as $country )
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <fieldset class="form-group col-md-6">
                            {{-- <div class="row"> --}}
                                <label for="inputPassword3" class=" col-form-label">Radios</label>
                                <div class="">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="female" checked="">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                </div>
                            {{-- </div> --}}
                        </fieldset>
                        
                    </div>
                    <button type="submit" class="btn  btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
    <!-- [ form-element ] end -->
</div>
@endsection
@extends('dashboard.dashboard')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5>Direction</h5>
            </div>   
            <div class="card-body table-border-style">
                <div class="table-responsive">
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
                                <th>#</th>
                                <th>From Airpot</th>
                                <th>To Airport</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($directions as $key=>$direction)
                            <tr>
                                <td class="center">
                                    {{ $key+1 }}
                                </td>
                                <td style="text-transform: capitalize;">{{ $direction->originAirport->name }}</td>
                                <td style="text-transform: capitalize;">{{ $direction->destinationAirport->name }}</td>
                                <td>
                                    <a href='{{ url("direction/$direction->id/edit") }}' class="btn btn-outline-primary">
                                        Edit
                                    </a>
                                </td>
                                <td>
                                    <form method="post" action='{{ url("direction/$direction->id") }}'>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
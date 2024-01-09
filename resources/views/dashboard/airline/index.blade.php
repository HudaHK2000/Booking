@extends('dashboard.dashboard')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5>Airlines</h5>
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
                    <table class="table table-hover .table_content_center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>AirLines</th>
                                <th>Address</th>
                                <th>Website</th>
                                <th>Phone</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1; ?>
                            @foreach ($airlines as $airline)
                            <tr>
                                <td>
                                    <?php echo $count++ ?>
                                </td>
                                <td style="text-transform: uppercase;">{{ $airline->name }}</td>
                                <td style="text-transform: capitalize;">{{ $airline->address }}</td>
                                <td style="text-transform: capitalize;">{{ $airline->website }}</td>
                                <td>{{ $airline->phone }}</td>
                                <td>
                                    <a href='{{ url("airline/$airline->id/edit") }}' class="btn btn-outline-primary">
                                        Edit
                                    </a>
                                </td>
                                <td>
                                    <form method="post" action='{{ url("airline/$airline->id") }}'>
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
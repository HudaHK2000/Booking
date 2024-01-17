@extends('dashboard.dashboard')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5>Airplane</h5>
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
                                <th>Airplane</th>
                                <th>Airline</th>
                                <th>Number Of Seats</th>
                                <th>Show Seats Details</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1; ?>
                            @foreach ($airplanes as $airplane)
                            <tr>
                                <td>
                                    <?php echo $count++ ?>
                                </td>
                                <td style="text-transform: capitalize;">{{ $airplane->model }}</td>
                                <td style="text-transform: capitalize;">{{ $airplane->airline->name }}</td>
                                <td style="text-transform: capitalize;">{{ $airplane->number_of_seats }}</td>
                                <td>
                                    <a href='{{ url("airplane/$airplane->id") }}' class="btn btn-outline-info">
                                        Show Seats Details
                                    </a>
                                </td>
                                <td>
                                    <a href='{{ url("airplane/$airplane->id/edit") }}' class="btn btn-outline-primary">
                                        Edit
                                    </a>
                                </td>
                                <td>
                                    <form method="post" action='{{ url("airplane/$airplane->id") }}'>
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
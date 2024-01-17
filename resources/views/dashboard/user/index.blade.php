@extends('dashboard.dashboard')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5>Users</h5>
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
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Admin</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key=>$user)
                            <tr style="align-items: center;align-content: center;">
                                <td class="center">
                                    {{ $key+1 }}
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td class="admin-btn" data-route='{{url("user-admin/$user->id")}}'>@if($user->is_admin)  yes @else no @endif</td>                                  
                                <td>
                                    <form method="post" action='{{url("user-destroy/$user->id")}}'>
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

@section('script')
    <script>
        $('.admin-btn').click(function () {
            var _this= $(this);
            var urluser= _this.data('route');
            $.ajax({
                url: urluser,
                type: "put",
                data: {
                    "_token": "{{csrf_token()}}",
                },
                dataType: "json",
                success: function (response) {
                    if (response == 1) {
                        _this.html('yes');
                    } else {
                        _this.html('no');
                    }
                }
            });
        });
    </script>
@endsection
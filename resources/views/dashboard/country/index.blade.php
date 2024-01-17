@extends('dashboard.dashboard')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5>Countries</h5>
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
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Country</th>
                                <th>Country Code</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($countries as $key=>$country)
                            <tr>
                                <td class="center">
                                    {{ $key+1 }}
                                </td>
                                <td style="text-transform: capitalize;">{{ $country->name }}</td>
                                <td>{{ $country->country_code }}</td>
                                <td>
                                    <a href='{{ url("country/$country->id/edit") }}' class="btn btn-outline-primary">
                                        Edit
                                    </a>
                                </td>
                                <td>
                                    <form method="post" action='{{ url("country/$country->id") }}'>
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
                    {{-- <nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item {{ ($countries->currentPage() == 1) ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $countries->previousPageUrl() }}">Previous</a>
                            </li>
                            @foreach(range(1, $countries->lastPage()) as $page)
                                <li class="page-item {{ ($page == $countries->currentPage()) ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $countries->url($page) }}">{{ $page }}</a>
                                </li>
                            @endforeach
                            <li class="page-item {{ ($countries->currentPage() == $countries->lastPage()) ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $countries->nextPageUrl() }}">Next</a>
                            </li>
                        </ul>
                    </nav> --}}
                    {{-- <nav aria-label="Page navigation m-auto"> --}}
                        {!! $countries->links() !!}
                        {{-- <ul class="pagination">
                            <li class="page-item {{ $countries->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $countries->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            {{ $countries->links() }}
                            <li class="page-item {{ $countries->hasMorePages() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $countries->nextPageUrl() }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul> --}}
                    {{-- </nav> --}}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
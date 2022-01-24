<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="d-flex align-items-end flex-wrap">
                        <div class="mr-md-3 mr-xl-5">
                            <h2>Welcome back,</h2>
                            <p class="mb-md-0">Your analytics dashboard template.</p>
                        </div>
                        <div class="d-flex">
                            <i class="mdi mdi-home text-muted hover-cursor"></i>
                            <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                            <p class="text-primary mb-0 hover-cursor">Analytics</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-end flex-wrap">
                        <button type="button" class="btn btn-light bg-white btn-icon mr-3 d-none d-md-block ">
                            <i class="mdi mdi-download text-muted"></i>
                        </button>
                        <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
                            <i class="mdi mdi-clock-outline text-muted"></i>
                        </button>
                        <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
                            <i class="mdi mdi-plus text-muted"></i>
                        </button>
                        <button class="btn btn-primary mt-2 mt-xl-0">Download report</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User list</h4>
                        <div class="table-responsive pt-3">
                            {{-- Commented code will be get upgrade version --}}
                            <table id="table" class="display" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        {{-- <th>Progress</th> --}}
                                        <th>Phone</th>

                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            {{-- <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </td> --}}
                                            <td> {{ $user->phone }} </td>

                                            <td>{{ $user->created_at->diffForHumans() }}</td>
                                            <td style="cursor: pointer">
                                                <ul class="navbar-nav navbar-nav-right">
                                                    <li class="nav-item nav-profile dropdown">
                                                        <a class="nav-link dropdown-toggle" href="#"
                                                            data-toggle="dropdown" id="profileDropdown">
                                                            <i class="mdi mdi-drag-vertical"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                                            aria-labelledby="profileDropdown">
                                                            <a class="dropdown-item"
                                                                href="{{ route('dashboard.user.details',encrypt($user->id)) }}">
                                                                <i class="mdi mdi-account-circle text-primary"></i>
                                                                Details
                                                            </a>
                                                            <a class="dropdown-item">
                                                                <i class="mdi mdi-logout text-primary"></i>
                                                                Logout
                                                            </a>
                                                        </div>
                                                    </li>
                                                </ul>
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
    </div>
    <!-- content-wrapper ends -->
    @include('admin.layout.footer')
</div>


@section('script')
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@endsection

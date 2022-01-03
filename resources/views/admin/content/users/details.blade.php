<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="d-flex align-items-end flex-wrap">

                        <div class="d-flex">
                            <i class="mdi mdi-home text-muted hover-cursor"></i>
                            <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                            <p class="text-primary mb-0 hover-cursor">user</p>
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
                        <h4 class="card-title">User Profile</h4>
                        <h4 class="card-title text-center @if ($user->status == 1) text-success @else text-danger @endif">
                            @if ($user->status == 1)
                                Account regester successfully
                            @else
                                This account is inactive
                            @endif
                        </h4>
                        <h4 class="card-title text-right text-success">{{ ucfirst($user->user_type) }}</h4>
                        <div class="row">
                            <div class="col-sm-4 grid-margin stretch-card">
                                <img src="{{ ($user->avatar=="" || $user->avatar==null)? asset('images/auth/lockscreen-bg.jpg'): get_image_by_upload_id($user->avatar) }}" height="300"
                                    style="width:100%" />
                            </div>
                            <div class="col-sm-8 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <form class="forms-sample">
                                            <div class="form-group">
                                                <label for="exampleInputName1">Name</label>
                                                <input type="text" class="form-control" name="name"
                                                    id="exampleInputName1" placeholder="Name"
                                                    value="{{ $user->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail3">Email address</label>
                                                <input type="email" class="form-control" id="exampleInputEmail3"
                                                    placeholder="Email" name="email" value="{{ $user->email }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="phonenumber">Phone number</label>
                                                <input type="email" class="form-control" id="phonenumber"
                                                    placeholder="Phone number" name="phone"
                                                    value="{{ $user->phone }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleSelectGender">Gender</label>
                                                <select class="form-control" id="exampleSelectGender">
                                                    @if ($user->getUserDetails == null)
                                                        <option value="Select Gender" selected>Selected Gender</option>
                                                    @else
                                                        <option value="male" @if ($user->getUserDetails != null) @if (strtolower($user->getUserDetails->gender) == strtolower('male')) selected @endif @endif>Male</option>
                                                        <option value="female" @if ($user->getUserDetails != null) @if (strtolower($user->getUserDetails->gender) == strtolower('female')) selected @endif @endif>Female</option>
                                                        <option value="other" @if ($user->getUserDetails != null) @if (strtolower($user->getUserDetails->gender) == strtolower('other')) selected @endif @endif>Other</option>
                                                    @endif

                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary mr-2">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User details</h4>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="container-fluid float-left">
                                    <h3 class="float-left">Account verified at </h3>
                                    @if ($user->phone != '' && $user->status == 1)
                                        <h5 class="text-success float-right"> {{ $user->created_at->diffForHumans() }}
                                        </h5>
                                    @else
                                        <h5 class="text-danger float-right"> Email not verified</h5>
                                    @endif

                                </div>
                                <div class="container-fluid float-left">
                                    <h3 class="float-left">Email verified at </h3>
                                    @if ($user->email_verified_at != '')
                                        <h5 class="text-success float-right">
                                            {{ $user->email_verified_at->diffForHumans() }}</h5>
                                    @else
                                        <h5 class="text-danger float-right"> Email not verified</h5>
                                    @endif

                                </div>
                                <div class="container-fluid mt-1 float-left">
                                    <h3 class="float-left">Account created at </h3>
                                    <h5 class="text-success float-right">{{ $user->created_at->diffForHumans() }}</h5>
                                </div>
                                <div class="container-fluid mt-1 float-left">
                                    <h3 class="float-left">Account updeted at </h3>
                                    <h5 class="text-success float-right">{{ $user->updated_at->diffForHumans() }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-6">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Address</h4>

                        @foreach ($user->getAddress as $key => $item)
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <p class="font-weight-bold">{{ $item->knownName }}.</p>
                                        <p>
                                            {{ $item->city }},
                                        </p>
                                        <p>
                                            {{ $item->state }} , {{ $item->postalCode }}
                                        </p>
                                        <p>
                                            {{ $item->postalCode }}
                                        </p>
                                    </address>
                                </div>
                                <div class="col-md-6">
                                    <address class="text-primary">
                                        <p class="font-weight-bold">
                                            Full address
                                        </p>
                                        <p class="mb-2">
                                            {{ $item->address }}
                                        </p>
                                        <p class="mb-2">

                                        </p>
                                        <p class="mb-2 float-right" style="margin-top: -40px">
                                            <a href="https://maps.google.com/?ll={{ $item->lattitude }},{{ $item->longitude }}" target="__blank"><i class="mdi mdi-google-maps icon-lg"></i></a>
                                        </p>


                                    </address>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Device</h4>
                        <h4 class="card-title text-center @if ($user->device_token == '') text-danger @else text-success @endif">
                            @if ($user->device_token == '')
                                This use not install app
                            @else
                                This device register successfully
                            @endif
                        </h4>
                        <h4 class="card-title text-right text-success">
                            @if (strtolower($user->plateform) == 'android')
                                <span class="mdi mdi-android"></span> &nbsp;&nbsp;{{ ucfirst($user->plateform) }}
                            @else
                                <span class="mdi mdi-web"></span> &nbsp;&nbsp;{{ ucfirst($user->plateform) }}
                            @endif
                        </h4>
                        <div class="row">
                            <div class="col-sm-12">
                                <form class="forms-sample">
                                    <div class="form-group">
                                        <label for="phonenumber">Regester device number</label>
                                        <textarea type="email" class="form-control" id="phonenumber"
                                            readonly>{{ $user->device_token }}</textarea>
                                    </div>
                                </form>
                            </div>
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

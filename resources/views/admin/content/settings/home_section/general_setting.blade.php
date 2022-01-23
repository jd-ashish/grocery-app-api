@section('style')
    <link rel="stylesheet" href="{{ asset('vendors/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/media-uploader.css') }}">
@endsection
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between flex-wrap">
                    {{ inline_brd(['Dashboard', 'Settings', 'General setting']) }}

                </div>
            </div>
        </div>
        <form method="post" action="{{ route('general.setting.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Site information</h4>
                        <div class="form-group">
                        <label>Site Name</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Site Name" name="site_name" aria-label="sitename" value="@if($general_setting){{ $general_setting->site_name }}@endif">
                        </div>
                        <div class="form-group">
                        <label>Address</label>
                        <textarea type="text" class="form-control" placeholder="address" aria-label="address" name="address" rows="4">@if($general_setting){{ $general_setting->address }}@endif</textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Logo</label>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap">
                                    @if($general_setting)
                                        @if($general_setting->logo!=null || $general_setting->logo!="")
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered"><img
                                                            src="{{ get_image_by_upload_id($general_setting->logo) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <br>
                                <input type="hidden" name="image" value="@if($general_setting){{ $general_setting->logo }}@endif">
                                <button type="button" class="btn btn-info media_upload_form_btn"
                                    data-btntitle="Select Image" data-modaltitle="Upload Image"
                                    data-imgid="" data-toggle="modal" data-target="#media_upload_modal">
                                    Upload logo
                                </button>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Personal Informations</h4>
                        <div class="form-group">
                        <label>Phone number</label>
                        <input type="number" class="form-control form-control-sm" placeholder="Phone number" name="phone" aria-label="phone" value="@if($general_setting){{ $general_setting->phone }}@endif">
                        </div>
                        <div class="form-group ">
                            <label>Email address</label>
                            <input type="email" class="form-control form-control-sm" placeholder="Email ID" name="email" aria-label="email" value="@if($general_setting){{ $general_setting->email }}@endif">
                        </div>
                        <div class="form-group mt-5">
                            <label for="image" class="mt-3">favicon</label>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap">
                                    @if($general_setting)
                                        @if($general_setting->favicon!=null || $general_setting->favicon!="")
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered"><img
                                                            src="{{ get_image_by_upload_id($general_setting->favicon) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif

                                </div>
                                <br>
                                <input type="hidden" name="favicon" value="@if($general_setting){{ $general_setting->favicon }}@endif">
                                <button type="button" class="btn btn-info media_upload_form_btn"
                                    data-btntitle="Select Image" data-modaltitle="Upload Image"
                                    data-imgid="" data-toggle="modal" data-target="#media_upload_modal">
                                    Upload favicon
                                </button>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Social account</h4>
                        <div class="form-group">
                            <label>Facebook Link</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-facebook" type="button">
                                    <i class="mdi mdi-facebook"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control" placeholder="Facebook" aria-label="Faccebook" name="facebook" value="@if($general_setting){{ $general_setting->facebook }}@endif">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Instagram</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-youtube" type="button">
                                    <i class="mdi mdi-instagram"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control" placeholder="Instagram" aria-label="instagram" name="instagram" value="@if($general_setting){{ $general_setting->instagram }}@endif"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Twitter</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-twitter" type="button">
                                    <i class="mdi mdi-twitter"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control" placeholder="Twitter" aria-label="twitter" name="twitter" value="@if($general_setting){{ $general_setting->twitter }}@endif"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Youtube</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-youtube" type="button">
                                    <i class="mdi mdi-youtube"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control" placeholder="Youtube" aria-label="youtube" name="youtube" value="@if($general_setting){{ $general_setting->youtube }}@endif"/>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">More option comming soon...</h4>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 grid-margin stretch-card"></div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <div class="template-demo float-right">
                            <button type="submit" class="btn btn-outline-primary btn-icon-text load">
                                <i class="mdi mdi-file-check btn-icon-prepend"></i>
                                Submit
                              </button>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </form>
    </div>
    <!-- content-wrapper ends -->
    @include('admin.layout.footer')
</div>


@section('script')
    <script src="{{ asset('vendors/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('vendors/media_controll/media.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@endsection

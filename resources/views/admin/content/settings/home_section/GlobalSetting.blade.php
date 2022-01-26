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
                    {{ inline_brd(['Dashboard', 'Settings', 'Global setting']) }}
                    {{-- <div class="d-flex justify-content-between align-items-end flex-wrap">
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
                    </div> --}}
                </div>
            </div>
        </div>
        <form method="post" action="{{ route('global.setting.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Storage driver Configuration</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Storage List</h4>
                                    <div class="form-group">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="storage_driver1"
                                                    value="Cloudinar" id="ExampleRadio1" checked>
                                                Cloudinar
                                            </label>
                                        </div>
                                        <div class="form-check form-check-success">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="storage_driver2"
                                                    value="LocalStorage" id="ExampleRadio2" checked>
                                                Local Storage
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4>Default Storage</h4>
                                    <div class="form-group">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input CloudinarDriver" name="default_storage_driver"
                                                    value="cloudinar" id="ExampleRadio1" @if(setting('default_storage')=="cloudinar") checked @endif>
                                                Cloudinar
                                            </label>
                                        </div>
                                        <div class="form-check form-check-success">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input storageDriver" name="default_storage_driver"
                                                    value="local" id="ExampleRadio2" @if(setting('default_storage')=="local") checked @endif>
                                                Local Storage
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Cloudinar Configuration</h4>
                            <div class="form-group">
                                <label>CLOUDINARY URL</label>
                                <input type="text" class="form-control form-control-sm CLOUDINARY_URL" placeholder="CLOUDINARY URL"
                                    name="CLOUDINARY_URL" aria-label="phone" value="@if(env('DEMO'))****************************************************************@else{{ env('CLOUDINARY_URL') }}@endif">
                            </div>
                            <div class="form-group ">
                                <label>CLOUDINARY UPLOAD PRESET</label>
                                <input type="text" class="form-control form-control-sm CLOUDINARY_UPLOAD_PRESET" placeholder="CLOUDINARY UPLOAD PRESET"
                                    name="CLOUDINARY_UPLOAD_PRESET" aria-label="CLOUDINARY_UPLOAD_PRESET"
                                    value="@if(env('DEMO'))****************************************************************@else{{ env('CLOUDINARY_UPLOAD_PRESET') }}@endif">
                            </div>
                            <div class="form-group ">
                                <label>CLOUDINARY NOTIFICATION URL <small>(Optional)</small></label>
                                <input type="text" class="form-control form-control-sm CLOUDINARY_NOTIFICATION_URL" placeholder="CLOUDINARY NOTIFICATION URL"
                                    name="CLOUDINARY_NOTIFICATION_URL" aria-label="CLOUDINARY_NOTIFICATION_URL"
                                    value="@if(env('DEMO'))****************************************************************@else{{ env('CLOUDINARY_NOTIFICATION_URL') }}@endif">
                            </div>
                            <div class="template-demo float-right">
                                <button type="button" class="btn btn-outline-primary btn-icon-text saveCloudinary">
                                    <i class="mdi mdi-file-check btn-icon-prepend"></i>
                                    Save Cloudinary Configurations
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Payment Getway</h4>
                            <div class="form-group">
                                <div class="form-check form-check-primary">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="razorpay"
                                            value="1" id="ExampleRadio1" @if(setting('razorpay')=="1") checked @endif>
                                        Razorapy
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>RZP SECRTL</label>
                                <input type="text" class="form-control form-control-sm RZP_SECRT" placeholder="Razorpay SECRT key"
                                    name="RZP_SECRT" aria-label="phone" value="@if(env('DEMO'))****************************************************************@else{{ env('RZP_SECRT') }}@endif">
                            </div>
                            <div class="form-group ">
                                <label>RZP KEY</label>
                                <input type="text" class="form-control form-control-sm RZP_KEY" placeholder="RZP KEY ID"
                                    name="RZP_KEY" aria-label="RZP_KEY"
                                    value="@if(env('DEMO'))****************************************************************@else{{ env('RZP_KEY') }}@endif">
                            </div>
                            <div class="form-group ">
                                <label>RZP AUTH </label>
                                <input type="text" class="form-control form-control-sm RZP_AUTH" placeholder="RZP AUTH"
                                    name="RZP_AUTH" aria-label="RZP_AUTH"
                                    value="@if(env('DEMO'))****************************************************************@else{{ env('RZP_AUTH') }}@endif">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Cashfree payment getway.</h4>
                            <div class="form-group">
                                <div class="form-check form-check-primary">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="cashfree"
                                            value="1" id="ExampleRadio1" @if(setting('cashfree')=="1") checked @endif>
                                        Cashfree
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>APP ID</label>
                                <input type="text" class="form-control form-control-sm APP_ID" placeholder="APP ID"
                                    name="APP_ID" aria-label="phone" value="@if(env('DEMO'))****************************************************************@else{{ env('APP_ID') }}@endif">
                            </div>
                            <div class="form-group ">
                                <label>Secret Key</label>
                                <input type="text" class="form-control form-control-sm SecretKey" placeholder="Secret Key"
                                    name="SecretKey" aria-label="SecretKey"
                                    value="@if(env('DEMO'))****************************************************************@else{{ env('SecretKey') }}@endif">
                            </div>
                            <h4 class="card-title">Is COD enabled</h4>
                            <div class="form-check form-check-success">
                                <label class="form-check-label pointer">
                                    <input type="checkbox" class="form-check-input " name="cod"
                                        @if(setting('cod')=="1") checked @endif>
                                        Is COD enabled
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Product releted</h4>
                            <div class="form-group">
                                <label>Max Execlusive Offfer Main Screen</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Max Execlusive Offfer Main Screen" aria-label="max_execlusive" name="max_execlusive" value="{{ setting('max_execlusive') }}">
                                </div>
                            </div>
                            <h4 class="card-title">Save time</h4>
                            <div class="form-check form-check-success">
                                <label class="form-check-label pointer">
                                    <input type="checkbox" class="form-check-input " name="is_send_email_at_time_order"
                                        @if(setting('is_send_email_at_time_order')=="yes") checked @endif>
                                        Save your order time ~ 2-5 sec while user do order
                                </label>
                                <small>After turn on goto Cron <a href="{{ route('conf.cron') }}">HERE</a> use order cron sheduler</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Exclusive offer.</h4>
                            <div class="form-group">
                                <div class="form-check form-check-primary">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input " name="exclusive_offer_type"
                                            value="card"  @if(setting('exclusive_offer_type')=="card") checked @endif>
                                        Card wise
                                    </label>
                                </div>
                                <div class="form-check form-check-success">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input storageDriver" name="exclusive_offer_type"
                                            value="product"  @if(setting('exclusive_offer_type')=="product") checked @endif>
                                        Product Wise
                                    </label>
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
                            <h4 class="card-title">Site Images</h4>
                            <div class="form-group">
                                <label>Logo</label>
                                <div class="input-group">
                                    <input type="file" class="form-control" placeholder="Logo" aria-label="app_logo" name="app_logo"/>

                                </div>
                                <div class="input-group">
                                    <img src="{{ asset(setting("app_logo")) }}"/>
                                </div>
                            </div>
                            <h4 class="card-title"></h4>
                            <div class="form-group">
                                <label>Favicon</label>
                                    <input type="file" class="form-control" placeholder="Favicon" aria-label="favicon" name="favicon"/>
                                    <img src="{{ asset(setting("favicon")) }}"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Admin Login Config.</h4>
                            <div class="form-group">
                                <label></label>
                                <div class="form-check form-check-success">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input " name="login_by_phone"
                                             @if(setting('login_by_phone')=="1") checked @endif>
                                            Login With Phone (<small>For admin Login</small>)
                                    </label>
                                    <small>Make sure you have sms configuration!</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label></label>
                                <div class="form-check form-check-success">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input " name="is_dummy"
                                            @if(setting('is_dummy')=="1") checked @endif>
                                            Is dummy data On
                                    </label>
                                    <small>OTP=123456 , password=your_mobile@123 , email=admin@gmail.com!</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>FMC server key</label>
                                <div class="input-group">
                                    <textarea  class="form-control" placeholder="FMC server key" rows="8" aria-label="app_logo" name="fmc">@if(env('DEMO'))************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************@else{{ setting("fmc") }}@endif</textarea>

                                </div>
                            </div>
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

            $(".CloudinarDriver").change(function(){
                CloudinarDriver();
            })
            $(".saveCloudinary").click(function(){
                SaveCloudinarry();
            })
            function CloudinarDriver() {
                $(".loader").show();
                $.ajax({
                    type: "POST",
                    url: "{{ route('setting.storage.driver.check') }}",
                    data: {driver:"CloudinarDriver",_token: $(".token").val(),},
                    success: function(data) {
                        $(".loader").hide();
                        if(data=="error"){
                            $(".CloudinarDriver").prop('checked',false);
                            $(".storageDriver").prop('checked',true);
                            toast("CLOUDINARY_URL or CLOUDINARY_UPLOAD_PRESET not set ","error");
                        }else{
                            $(".CloudinarDriver").prop('checked',true);
                            $(".storageDriver").prop('checked',false);
                        }

                    }
                });
            }
            function SaveCloudinarry() {
                $(".loader").show();
                $.ajax({
                    type: "POST",
                    url: "{{ route('save.cloudinary-config') }}",
                    data: {CLOUDINARY_NOTIFICATION_URL:$(".CLOUDINARY_NOTIFICATION_URL").val(),CLOUDINARY_URL:$(".CLOUDINARY_URL").val(),CLOUDINARY_UPLOAD_PRESET:$(".CLOUDINARY_UPLOAD_PRESET").val(),_token: $(".token").val(),},
                    success: function(data) {
                        $(".loader").hide();
                        toast("Update successfully ","success");
                        $(".CloudinarDriver").prop('checked',true);
                        $(".storageDriver").prop('checked',false);

                    }
                });
            }
        });
    </script>
@endsection

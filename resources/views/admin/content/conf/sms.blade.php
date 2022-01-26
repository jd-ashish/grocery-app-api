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
                    {{ inline_brd(['Dashboard', 'configuration', 'SMS Setting']) }}
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
        <form method="post" action="{{ route('global.setting.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">SMS Configuration</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Storage List</h4>
                                    <div class="form-group">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="sms_driver"
                                                    value="Cloudinar" id="ExampleRadio1" checked>
                                                Fast To SMS
                                            </label>
                                        </div>
                                        <div class="form-check form-check-success">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="sms_driver2"
                                                    value="LocalStorage" id="ExampleRadio2" checked>
                                                    MessageBird
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4>Default SMS</h4>
                                    <div class="form-group">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label pointer">
                                                <input type="radio" class="form-check-input fast_2_sms" name="default_sms"
                                                    value="default_sms" @if(setting('default_sms')=="fast_2_sms") checked @endif>
                                                Fast2SMS
                                            </label>
                                            <small><a href="https://www.fast2sms.com?aff=ICYkqRgi">SIGNUP Fast 2 SMS</a></small>
                                        </div>
                                        <div class="form-check form-check-success">
                                            <label class="form-check-label pointer">
                                                <input type="radio" class="form-check-input MessageBird" name="default_sms"
                                                    value="MessageBird" id="ExampleRadio2" @if(setting('default_sms')=="message_bird_api_key") checked @endif>
                                                    MessageBird
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
                            <h4 class="card-title">Message Bird Configuration </h4>
                            <div class="form-group">
                                <label>API KEY</label>
                                <input type="text" class="form-control form-control-sm message_bird_api_key" placeholder="Api Key"
                                    name="message_bird_api_key" aria-label="message_bird_api_key" value="@if(env('DEMO'))****************************************************************@else{{ setting('message_bird_api_key') }}@endif">
                                    <small><a href="https://messagebird.com/">SIGNUP MessageBird or get api key</a></small>
                            </div>
                            @if(env("DEMO"))

                            @else
                            
                            @if(setting('default_sms')=="message_bird_api_key")
                            @php
                            $mb = \App\Http\Controllers\Admin\SMS\MessageBird::ballance();
                                // print_r($mb);
                                //[payment] => prepaid [type] => credits [amount] => 10
                            @endphp
                            @endif
                            <h4>{{ $mb->amount }} {{ $mb->type }} Available</h4>
                            @endif
                            
                            <div class="template-demo float-right">
                                <button type="button" class="btn btn-outline-primary btn-icon-text saveMessageBird">
                                    <i class="mdi mdi-file-check btn-icon-prepend"></i>
                                    Save MessageBird Configurations
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Fast Two SMS Configuration </h4>
                            <div class="form-group">
                                <label>API KEY</label>
                                <input type="text" class="form-control form-control-sm fast_2_sms_api_key" placeholder="fast 2 sms api key"
                                    name="fast_2_sms_api_key" aria-label="fast_2_sms_api_key" value="@if(env('DEMO'))****************************************************************@else{{ setting('fast_2_sms_api_key') }}@endif">
                                    <small><a href="https://www.fast2sms.com?aff=ICYkqRgi">SIGNUP Fast 2 SMS or get api key</a></small>
                            </div>
                            <div class="form-group ">
                                <label></label>
                                <label class="form-check-label pointer">
                                    <input type="checkbox" class="form-check-input is_f2s_dlt" name="is_f2s_dlt"
                                   id="ExampleRadio2" @if(setting('is_f2s_dlt')=="1") checked @endif>
                                        <b>(Without DLT send only OTP)</b>
                                </label>
                            </div>
                            <div class="template-demo float-right">
                                <button type="button" class="btn btn-outline-primary btn-icon-text saveF2s">
                                    <i class="mdi mdi-file-check btn-icon-prepend"></i>
                                    Save Fast2Sms Configurations
                                </button>
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

            $(".fast_2_sms").change(function(){
                fast_2_smsCheck();
            })
            $(".MessageBird").change(function(){
                MessageBirdCheck();
            })
            $(".saveF2s").click(function(){
                saveF2s();
            })
            $(".saveMessageBird").click(function(){
                saveMessageBird();
            })
            function fast_2_smsCheck() {
                $(".loader").show();
                $.ajax({
                    type: "POST",
                    url: "{{ route('is.f2s.install') }}",
                    data: {_token: $(".token").val()},
                    success: function(data) {
                        $(".loader").hide();
                        if(data){
                            $(".fast_2_sms").prop('checked',true);
                            $(".MessageBird").prop('checked',false);

                        }else{
                            toast("Please config Fast2Sms","error");
                            $(".fast_2_sms").prop('checked',false);
                            $(".MessageBird").prop('checked',true);
                        }

                    }
                });
            }
            function MessageBirdCheck() {
                $(".loader").show();
                $.ajax({
                    type: "POST",
                    url: "{{ route('is.MessageBir.install') }}",
                    data: {_token: $(".token").val()},
                    success: function(data) {
                        $(".loader").hide();
                        if(data){
                            $(".MessageBird").prop('checked',true);
                            $(".fast_2_sms").prop('checked',false);

                        }else{
                            toast("Please config Message Bird","error");
                            $(".fast_2_sms").prop('checked',true);
                            $(".MessageBird").prop('checked',false);
                        }

                    }
                });
            }
            function saveF2s() {
                $(".loader").show();
                var is_f2s_dlt = $('.is_f2s_dlt').is(":checked")
                $.ajax({
                    type: "POST",
                    url: "{{ route('save.saveF2s-config') }}",
                    data: {fast_2_sms_api_key:$(".fast_2_sms_api_key").val(),is_f2s_dlt:is_f2s_dlt,_token: $(".token").val()},
                    success: function(data) {
                        $(".loader").hide();
                        toast("Update successfully ","success");

                    }
                });
            }
            function saveMessageBird() {
                $(".loader").show();
                var is_f2s_dlt = $('.is_f2s_dlt').is(":checked")
                $.ajax({
                    type: "POST",
                    url: "{{ route('save.saveMessageBird-config') }}",
                    data: {message_bird_api_key:$(".message_bird_api_key").val(),_token: $(".token").val()},
                    success: function(data) {
                        $(".loader").hide();
                        toast("Update successfully ","success");

                    }
                });
            }
        });
    </script>
@endsection

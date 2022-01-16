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
                    {{ inline_brd(['Dashboard', 'configuration', 'Cron Job Shedular Route']) }}
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
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Order</h4>
                            <small>Save time to order ~ 1-3 second while user order</small>
                            <div class="form-group">
                                <div class="input-group">
                                  <input type="text" class="form-control" value="{{ route("cron.order") }}" id="orderRoute" placeholder="Find in facebook" aria-label="Recipient's username">
                                  <div class="input-group-append">
                                    <button class="btn btn-sm btn-facebook btn-clipboard" type="button" data-clipboard-action="copy" data-clipboard-target="#orderRoute">
                                      <i class="mdi mdi-content-copy"></i>
                                    </button>
                                  </div>
                                </div>
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

    <script src="{{ asset('vendors/clipboard/js/clipboard.min.js') }}"></script>
    <script>
        (function($) {
                'use strict';
                var clipboard = new ClipboardJS('.btn-clipboard');
                clipboard.on('success', function(e) {
                    console.log(e);
                });
                clipboard.on('error', function(e) {
                    console.log(e);
                });
        })(jQuery);

        $(document).ready(function() {

            $('#table').DataTable();

            $(".fast_2_sms").change(function(){
                fast_2_smsCheck();
            })
            $(".saveF2s").click(function(){
                saveF2s();
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

                        }else{
                            toast("Please config Fast2Sms","error");
                            $(".fast_2_sms").prop('checked',false);
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
        });
    </script>
@endsection

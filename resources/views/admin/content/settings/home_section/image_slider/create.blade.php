@section('style')
    <link rel="stylesheet" href="{{ asset('vendors/awesome/4.7.0/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/media-uploader.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/admin_panal_product_page.css') }}">
@endsection
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between flex-wrap">
                    @php
                        inline_brd(['Dashboard', 'Setting', 'Image Slider', 'Create']);
                    @endphp

                    <div class="d-flex justify-content-between align-items-end flex-wrap">
                        <a href="{{ route('image.slider') }}" class="btn btn-primary mt-2 mt-xl-0"><span class="mdi mdi-keyboard-return"></span> Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create slider</h4>
                        <form method="POST" action="@if(isset($slider)){{  route('update.slider.image') }}  @else {{ route('upload.slider.image.db') }} @endif" id="choice_form">
                            @csrf
                            @if(isset($slider))
                                <input type="hidden" name="id" value="{{ $slider->id }}">
                            @endif
                            <div class="form-group ">
                                <label for="image">Slider Image</label>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        @if(isset($slider))
                                            @foreach (explode('|', $slider->image) as $item)
                                                <div class="attachment-preview">
                                                    <div class="thumbnail">
                                                        <div class="centered"><img
                                                                src="{{ get_image_by_upload_id($item) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    @if(isset($slider))
                                    <input type="hidden" name="image" value="{{ $slider->image }}">

                                    @else
                                    <input type="hidden" name="image">

                                    @endif

                                    <button type="button" class="btn btn-info media_upload_form_btn"
                                        data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal"
                                        data-mulitple="true" data-target="#media_upload_modal">
                                        More Image
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-github float-right load" > <span class="mdi mdi-cloud-upload"></span> &nbsp;&nbsp; Upload slider</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        @include('admin.layout.footer')
    </div>

    @section('script')
        <script src="{{ asset('vendors/bootstrap_tagsinput/bootstrap-tagsinput.min.js') }}"></script>
        <script src="{{ asset('vendors/dropzone/dropzone.js') }}"></script>
        <script src="{{ asset('vendors/media_controll/media.js') }}"></script>



        <script>
            function update_sku() {
                $(".loader").show();
                $.ajax({
                    type: "POST",
                    url: "{{ route('products.sku_combination') }}",
                    data: $('#choice_form').serialize(),
                    success: function(data) {
                        $(".loader").hide();
                        $('#sku_combination').html(data);
                        if (data.length > 1) {
                            $('#quantity').hide();
                        } else {
                            $('#quantity').show();
                        }
                    }
                });
            }

            $('#colors').on('change', function() {
                update_sku();
            });

            $('input[name="unit_price"]').on('keyup', function() {
                update_sku();
            });

            $('input[name="name"]').on('keyup', function() {
                update_sku();
            });

            function delete_row(em) {
                $(em).closest('.form-group').remove();
                update_sku();
            }

            function add_more_customer_choice_option(i, name) {
                $('#customer_choice_options').append(
                    '<div class="row"><div class="col-md-12"><div class="form-group row" ><div class="col-lg-2" ><input type="hidden" name="choice_no[]" value="' +
                    i +
                    '"><input type="text" style="height: 40px; text-align: center;" class="form-control" name="choice[]" value="' +
                    name +
                    '" placeholder="Choice Title" readonly></div><div class="col-lg-7"><input type="text" class="form-control" name="choice_options_' +
                    i +
                    '[]" placeholder="Enter choice values" data-role="tagsinput" onchange="update_sku()"></div></div></div></div>'
                );

                $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsInput();
            }
            $('#choice_attributes').on('change', function() {
                $('#customer_choice_options').html(null);
                $.each($("#choice_attributes option:selected"), function() {
                    //console.log($(this).val());
                    add_more_customer_choice_option($(this).val(), $(this).text());
                });
                update_sku();
            });
        </script>



    @endsection

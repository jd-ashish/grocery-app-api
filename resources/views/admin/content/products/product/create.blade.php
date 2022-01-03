@section('style')
    <link rel="stylesheet" href="{{ asset('vendors/awesome/4.7.0/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/media-uploader.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap_tagsinput/bootstrap-tagsinput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/admin_panal_product_page.css') }}">
@endsection
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between flex-wrap">
                    @php
                        inline_brd(['Dashboard', 'Products', 'Category', 'Create']);
                    @endphp

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
                        <a href="" class="btn btn-primary mt-2 mt-xl-0">Create Product</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create Product</h4>
                        <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data"
                            id="choice_form">
                            @csrf
                            <div id="accordion" class="accordion">
                                <div class="card mb-0">
                                    <div class="card-header pointer" data-toggle="collapse" href="#collapseOne"
                                        aria-expanded="true">
                                        <a class="card-title"> General information </a>
                                    </div>
                                    <div id="collapseOne" class="card-body collapse show" data-parent="#accordion">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="forms-sample">
                                                    <div class="form-group">
                                                        <label for="exampleInputUsername1">Product name</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleInputUsername1" placeholder="Product name"
                                                            name="product_name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Unit </label>
                                                        <input type="text" class="form-control"
                                                            id="exampleInputEmail1" name="unit"
                                                            placeholder="EG (KG , PCS , LIT , )">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_code">Product code
                                                            <small>(Optional)</small></label>
                                                        <input type="text" class="form-control" nmae="product_code"
                                                            id="product_code" placeholder="Product code (Optional)">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="forms-sample">
                                                    <div class="form-group">
                                                        <label for="form-tags-1">Tag</label>
                                                        <input id="form-tags-1" name="tags" type="text" value=""
                                                            placeholder="Enter tag">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Select Category</label>
                                                        <select class="select2" name="select_category">
                                                            <option selected>Select category</option>
                                                            @foreach ($category as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">&nbsp;</label>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header collapsed pointer" data-toggle="collapse"
                                        data-parent="#accordion" href="#collapseTwo">
                                        <a class="card-title"> Images </a>
                                    </div>
                                    <div id="collapseTwo" class="card-body collapse pointer" data-parent="#accordion">

                                        <div class="form-group ">
                                            <label for="image">Main Image</label>
                                            <div class="media-upload-btn-wrapper">
                                                <div class="img-wrap">
                                                </div>
                                                <input type="hidden" name="image_gallery">
                                                <button type="button" class="btn btn-info media_upload_form_btn"
                                                    data-btntitle="Select Image" data-modaltitle="Upload Image"
                                                    data-toggle="modal" data-mulitple="true"
                                                    data-target="#media_upload_modal">
                                                    Main Image
                                                </button>
                                            </div>
                                        </div>

                                        <label for="image">Thumbnail Image</label>
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap">
                                            </div>
                                            <br>
                                            <input type="hidden" name="image" value="">
                                            <button type="button" class="btn btn-info media_upload_form_btn"
                                                data-btntitle="Select Image" data-modaltitle="Upload Image"
                                                data-imgid="" data-toggle="modal" data-target="#media_upload_modal">
                                                Thumbnail Image
                                            </button>
                                        </div>


                                    </div>
                                    <div class="card-header collapsed pointer" data-toggle="collapse"
                                        data-parent="#accordion" href="#collapseThree">
                                        <a class="card-title"> Customer Choice </a>
                                    </div>
                                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="col-12">
                                                <div class="forms-sample">
                                                    <div class="form-group">
                                                        <label for="product_details">Attributes</label>
                                                        <select name="choice_attributes[]" id="choice_attributes"
                                                            class="select2" multiple
                                                            data-placeholder="Choose Attributes">
                                                            <option value="1">Size</option>
                                                            <option value="2">Fabric</option>
                                                            <option value="3">KG</option>
                                                        </select>
                                                    </div>
                                                    <div class="customer_choice_options" id="customer_choice_options">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header collapsed pointer" data-toggle="collapse"
                                        data-parent="#accordion" href="#collapseFour">
                                        <a class="card-title"> Description </a>
                                    </div>
                                    <div id="collapseFour" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="col-12">
                                                <div class="forms-sample">
                                                    <div class="form-group">
                                                        <label for="product_details">Product details</label>
                                                        <textarea class="form-control" name="product_details"
                                                            id="product_details" rows="6"
                                                            placeholder="Product details"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Nutritions">Nutritions (Optionals)</label>
                                                        <textarea class="form-control" id="Nutritions"
                                                            name="Nutritions" rows="6"
                                                            placeholder="Nutritions"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Caution" class="text-danger">Caution
                                                            (Optionals)</label>
                                                        <textarea class="form-control" id="Caution" name="Caution"
                                                            rows="6" placeholder="Caution"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-header collapsed pointer" data-toggle="collapse"
                                        data-parent="#accordion" href="#collapseFive">
                                        <a class="card-title"> Price </a>
                                    </div>
                                    <div id="collapseFive" class="collapse" data-parent="#accordion">

                                        <div class="col-12">
                                            <div class="form-sample mt-5">
                                                <p class="card-description">
                                                    Price
                                                </p>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Unit price</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control"
                                                                    name="unit_price" placeholder="Unit price" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Purchase
                                                                price</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control"
                                                                    name="purchase_price"
                                                                    placeholder="Purchase price" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Discount</label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group ">
                                                                    <input type="text" class="form-control"
                                                                        name="discount" placeholder="Discount"
                                                                        aria-label="Discount"
                                                                        aria-describedby="basic-addon2">
                                                                    <div class="input-group-append "
                                                                        style="margin-top: -5px">
                                                                        <select class="select2"
                                                                            name="discount_type">
                                                                            <option value="amount">Amount</option>
                                                                            <option value="percent">Percent</option>
                                                                        </select>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row" id="quantity">
                                                            <label class="col-sm-3 col-form-label">Quantity</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control"
                                                                    name="current_stock" placeholder="Quantity" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">

                                                        <div id="sku_combination"></div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-primary btn-icon-text float-right mt-5">
                                <i class="mdi mdi-file-check btn-icon-prepend"></i>
                                Submit
                            </button>
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
    <script src="{{ asset('vendors/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendors/js/form_input_tag.js') }}"></script>

        <script>
            $(function() {
                $('.select2').select2({
                    width: '100%',
                    placeholder: 'Select an option'
                });
            })
        </script>


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

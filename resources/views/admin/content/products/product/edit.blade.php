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
                        <form method="post" action="{{ route('product.update',$product->id) }}" enctype="multipart/form-data"
                            id="choice_form">
                            @csrf
                            <input name="_method" type="hidden" value="POST">
		                    <input type="hidden" name="id" value="{{ $product->id }}">
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
                                                            name="product_name" value="{{ $product->name }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Unit </label>
                                                        <input type="text" class="form-control"
                                                            id="exampleInputEmail1" name="unit"
                                                            placeholder="EG (KG , PCS , LIT , )"
                                                            value="{{ $product->unit }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_code">Product code
                                                            <small>(Optional)</small></label>
                                                        <input type="text" class="form-control" name="product_code"
                                                            id="product_code" placeholder="Product code (Optional)"
                                                            value="{{ $product->product_code }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="forms-sample">
                                                    <div class="form-group">
                                                        <label for="form-tags-1">Tag</label>
                                                        <input id="form-tags-1" name="tags" type="text"
                                                            placeholder="Enter tag" value="{{ $product->tags }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Select Category</label>
                                                        <select class="select2" name="select_category">
                                                            <option selected>Select category</option>
                                                            @foreach ($category as $item)
                                                                <option value="{{ $item->id }}"
                                                                    @if ($product->category_id == $item->id)  selected @endif>{{ $item->name }}
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
                                                    @foreach (explode('|', $product->photos) as $item)
                                                        <div class="attachment-preview">
                                                            <div class="thumbnail">
                                                                <div class="centered"><img
                                                                        src="{{ get_image_by_upload_id($item) }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <input type="hidden" name="image_gallery" value="{{ $product->photos }}">
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
                                                <div class="attachment-preview">
                                                    <div class="thumbnail">
                                                        <div class="centered"><img
                                                                src="{{ get_image_by_upload_id($product->thumbnail_img) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <input type="hidden" name="image" value="{{ $product->thumbnail_img }}">
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
                                                            @foreach (\App\Models\Attributes::all() as $key => $attribute)
                                                                <option value="{{ $attribute->id }}"
                                                                    @if ($product->attributes != null && in_array($attribute->id, json_decode($product->attributes, true))) selected @endif>{{ $attribute->name }}
                                                                </option>
                                                            @endforeach
                                                            {{-- <option value="1">Size</option>
                                                            <option value="2">Fabric</option>
                                                            <option value="3">KG</option> --}}
                                                        </select>
                                                    </div>
                                                    <div class="customer_choice_options" id="customer_choice_options">
                                                        @foreach (json_decode($product->choice_options) as $key => $choice_option)
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group row">
                                                                        <div class="col-lg-2">
                                                                            <input type="hidden" name="choice_no[]"
                                                                                value="{{ $choice_option->attribute_id }}">
                                                                            <input type="text"
                                                                                style="height: 40px; text-align: center;"
                                                                                class="form-control" name="choice[]"
                                                                                value="{{ \App\Models\Attributes::find($choice_option->attribute_id)->name }}"
                                                                                placeholder="Choice Title" readonly>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            <input type="text" class="form-control form-tags-99"
                                                                                name="choice_options_{{ $choice_option->attribute_id }}[]"
                                                                                placeholder="Enter choice values"
                                                                                value="{{ implode(',', $choice_option->values) }}"

                                                                                onchange="update_sku()">
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <button onclick="delete_row(this)"
                                                                                class="btn btn-danger btn-icon"><i
                                                                                    class="mdi mdi-delete-variant"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
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
                                                            placeholder="Product details">{{ $product->description }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Nutritions">Nutritions (Optionals)</label>
                                                        <textarea class="form-control" id="Nutritions"
                                                            name="Nutritions" rows="6"
                                                            placeholder="Nutritions">{{ $product->nutritions }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Caution" class="text-danger">Caution
                                                            (Optionals)</label>
                                                        <textarea class="form-control" id="Caution" name="Caution"
                                                            rows="6" placeholder="Caution">{{ $product->caution }}</textarea>
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
                                                                    name="unit_price" placeholder="Unit price" value="{{ $product->unit_price }}" />
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
                                                                    placeholder="Purchase price" value="{{ $product->purchase_price }}"/>
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
                                                                        aria-describedby="basic-addon2" value="{{ $product->discount }}">
                                                                    <div class="input-group-append "
                                                                        style="margin-top: -5px">
                                                                        <select class="select2"
                                                                            name="discount_type">
                                                                            <option value="amount" @if($product->discount_type=="amount") selected @endif >Amount</option>
                                                                            <option value="percent" @if($product->discount_type=="percent") selected @endif  >Percent</option>
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
                                                                    name="current_stock" placeholder="Quantity" value="{{ $product->current_stock }}" />
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
        <!-- partial:partials/_footer.html -->
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
                    url: "{{ route('products.sku_combination_edit') }}",
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

            update_sku();
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

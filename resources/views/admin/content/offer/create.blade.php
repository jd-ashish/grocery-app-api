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
                        inline_brd(array("Dashboard","Offer","exclusive","Create"));
                    @endphp

                    <div class="d-flex justify-content-between align-items-end flex-wrap">
                        <a href="{{ route('offer.exclusive') }}" class="btn btn-primary mt-2 mt-xl-0">Back</a>
                    </div>
                </div>
            </div>
        </div>

        @php
            error($errors);
        @endphp
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create exclusive offer</h4>
                        <form class="forms-sample" action="@if(isset($offer_exclusive)){{ route('offer.exclusive.update',encrypt($offer_exclusive->id)) }}@else{{ route('offer.exclusive.store') }}@endif" method="post" >
                            @csrf
                            <div class="form-group">
                              <label for="exampleInputName1">Title</label>
                              <input type="text" class="form-control" name="title" id="exampleInputName1" placeholder="Offer title" value="@if(isset($offer_exclusive)){{ $offer_exclusive->title }}@endif">
                            </div>
                            <div class="form-group">
                                <label for="image">Thumbnail Image</label>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        @if(isset($offer_exclusive))
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered"><img
                                                            src="{{ get_image_by_upload_id($offer_exclusive->image) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <br>
                                    <input type="hidden" name="image" value="@if(isset($offer_exclusive)){{ $offer_exclusive->image }}@endif">
                                    <button type="button" class="btn btn-info media_upload_form_btn"
                                        data-btntitle="Select Image" data-modaltitle="Upload Image"
                                        data-imgid="" data-toggle="modal" data-target="#media_upload_modal">
                                        Thumbnail Image
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-12">
                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="product_details">Select products</label>
                                            <select name="select_products[]" id="choice_attributes"
                                                class="select2" multiple
                                                data-placeholder="Select products">
                                                @foreach ($product as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if(isset($offer_exclusive))
                                                            @if ($offer_exclusive->products != null && in_array($item->id, json_decode($offer_exclusive->products, true))) selected @endif
                                                        @endif

                                                        >{{ $item->category->name }} -> {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="customer_choice_options" id="customer_choice_options">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2 load">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                          </form>
                    </div>
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
@endsection

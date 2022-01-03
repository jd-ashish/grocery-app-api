<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between flex-wrap">
                    {{ inline_brd(array("Dashboard","Products","product list")) }}
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
                        <a href="{{ route('product.create') }}" class="btn btn-primary mt-2 mt-xl-0">Create products</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Product list</h4>
                        <div class="table-responsive pt-3">
                            <table id="table" class="display" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Added by</th>
                                        <th>Name</th>
                                        <th>Exclusive offer</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img src="{{ get_image_by_upload_id($item->thumbnail_img) }}" height="50" width="50"></td>
                                            <td>{{ $item->added_by }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td><div class="form-group">
                                                <div class="form-check form-check-primary">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input check_execlusive_offer" name="storage_driver1"
                                                            value="Cloudinar"  item_id="{{ $item->id }}" @if($item->exclusive_offer==1) checked @endif>
                                                            Exclusive
                                                    </label>
                                                </div>
                                            </div></td>
                                            <td>{{ $item->created_at->diffForHumans() }}</td>
                                            <td style="cursor: pointer">
                                                @php
                                                    $arr = array();
                                                    $arr[] = array(
                                                        "route" => route('product.category.delete',$item->id),
                                                        "name" => "Delete product",
                                                        "name2" => $item->name,
                                                        "id" => $item->id,
                                                        "isLink" => false,
                                                        "isDelete" => true,
                                                        "icon" => '<i class="mdi mdi-delete-forever text-danger"></i>',
                                                    );
                                                    $arr[] = array(
                                                        "route" => route('product.product.edit',encrypt($item->id)),
                                                        "name" => "Edit product",
                                                        "name2" => $item->name,
                                                        "id" => $item->id,
                                                        "isLink" => true,
                                                        "isDelete" => false,
                                                        "icon" => '<i class="mdi mdi-tooltip-edit text-success"></i>',
                                                    );
                                                    $arr[] = array(
                                                        "route" => route('product.duplicate',encrypt($item->id)),
                                                        "name" => "Duplicate product",
                                                        "name2" => $item->name,
                                                        "id" => $item->id,
                                                        "isLink" => true,
                                                        "isDelete" => false,
                                                        "icon" => '<i class="mdi mdi-content-duplicate text-success"></i>',
                                                    );

                                                    echo table_more($arr);
                                                @endphp

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

    @include('admin.layout.footer')
</div>

@section('script')
    <script>
        $(document).ready(function() {

            $(".check_execlusive_offer").change(function(){
                $(".loader").show();
                var id = $(this).attr('item_id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('product.execlusive.offer') }}",
                    data: {id:id,_token: $(".token").val(),},
                    success: function(data) {
                        $(".loader").hide();
                        toast(data,"success");

                    }
                });
            })

        });
    </script>
@endsection

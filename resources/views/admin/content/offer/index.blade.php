<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between flex-wrap">
                    {{ inline_brd(['Dashboard', 'Offer', 'Exclusive Offer']) }}
                    <div class="d-flex justify-content-between align-items-end flex-wrap">
                        <a href="{{ route('offer.exclusive.create') }}" class="btn btn-primary mt-2 mt-xl-0">Create Exclusive Offer</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Exclusive Offer list</h4>
                        <div class="table-responsive pt-3">
                            <table id="table" class="display" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Create by</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($offer_exclusive as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>
                                                {{ $item->title }}
                                            </td>
                                            <td><img src="{{ get_image_by_upload_id($item->image) }}" width="80"></td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="form-check form-check-primary">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input check_execlusive_offer"
                                                                item_id="{{ $item->id }}" @if($item->status==1) checked @endif>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item->created_at->diffForHumans() }}</td>
                                            <td style="cursor: pointer">
                                                @php
                                                    $arr = array();
                                                    $arr[] = array(
                                                        "route" => route('offer.exclusive.delete',encrypt($item->id)),
                                                        "name" => "Delete exclusive offer",
                                                        "name2" => $item->id,
                                                        "id" => $item->id,
                                                        "isLink" => false,
                                                        "isDelete" => true,
                                                        "icon" => '<i class="mdi mdi-delete-forever text-danger"></i>',
                                                    );
                                                    $arr[] = array(
                                                        "route" => route('offer.exclusive.edit',encrypt($item->id)),
                                                        "name" => "Edit exclusive offer",
                                                        "name2" => "",
                                                        "id" => $item->id,
                                                        "isLink" => true,
                                                        "isDelete" => false,
                                                        "icon" => '<i class="mdi mdi-eye text-success"></i>',
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


    <!-- content-wrapper ends -->
    @include('admin.layout.footer')
</div>


@section('script')
    <script>
        $(document).ready(function() {
            $('#table').DataTable();


            $(".check_execlusive_offer").change(function() {
                $(".loader").show();
                var id = $(this).attr("item_id");
                var ch = $(this).is(':checked');
                // alert($(this).is(':checked'));
                $.ajax({
                    type: "POST",
                    url: "{{ route('offer.exclusive.status') }}",
                    data: {
                        _token: $(".token").val(),
                        id: id,status:ch
                    },
                    success: function(data) {
                        $(".loader").hide();
                        toast(data.message,data.status);
                    }
                });
            })
        });
    </script>
@endsection

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between flex-wrap">
                    {{ inline_brd(['Dashboard', 'Refund', 'Order cancel refund']) }}

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Refund list</h4>
                        <div class="table-responsive pt-3">
                            <table id="table" class="display" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Order details</th>
                                        <th>Refund Amount</th>
                                        <th>Refund status</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($refund as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>
                                                <a href="{{ route('order.details', encrypt($item->order->id)) }}">Open
                                                    order details</a>
                                            </td>
                                            <td>{{ single_price($item->order->grand_total) }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ $item->created_at->diffForHumans() }}</td>
                                            <td style="cursor: pointer">
                                                <div class="dropdown">
                                                    <a class="nav-link " href="#" data-toggle="dropdown"
                                                        id="profileDropdown">
                                                        <i class="mdi mdi-drag-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item <?php if ($item['isDelete'] == true) {
    echo 'cnf-del';
} else {
    echo '';
} ?> open_payment_details_view"
                                                            style="font-size: 18px; padding:11px" href="#" id="{{ $item->id }}">
                                                            <i class="mdi mdi-eye text-success"></i>
                                                            Payment details
                                                        </a>


                                                    </div>
                                                </div>
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

            $(".open_payment_details_view").click(function() {
                $(".loader").show();
                var id = $(this).attr("id");
                $.ajax({
                    type: "POST",
                    url: "{{ route('order.refund.payment.details') }}",
                    data: {
                        _token: $(".token").val(),
                        id: id,
                    },
                    success: function(data) {
                        $(".loader").hide();
                        $(".dy_content_modal").html(data);
                        $('.myModal-dynamic').modal('show');
                    }
                });
            })
        });
    </script>
@endsection

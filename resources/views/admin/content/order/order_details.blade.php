@section('style')
    <link rel="stylesheet" href="{{ asset('vendors/css/select2.min.css') }}">
    <style>
        .select2-selection__rendered {
            line-height: 45px !important;
        }

        .select2-container .select2-selection--single {
            height: 45px !important;
            margin-top: 5px;
        }

        .select2-selection__arrow {
            height: 45px !important;
            margin-top: 5px;
        }

        .pointer {
            cursor: pointer;
        }

        .select2-selection--multiple {
            overflow: hidden !important;
            height: 25px !important;
        }

    </style>
@endsection
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between flex-wrap">
                    {{ inline_brd(['Dashboard', 'Products', 'product list']) }}
                    <div class="d-flex justify-content-between align-items-end flex-wrap">


                                        <div class="row mr-5">
                                            <div class="col-lg-6" style="width: 100%;">
                                                <select class="form-control select2"
                                                    data-minimum-results-for-search="Infinity"
                                                    id="update_payment_status">
                                                    <option value="paid" @if($order->orderDetails->first()->payment_status=="paid") selected @endif>Paid</option>
                                                    <option value="unpaid" @if($order->orderDetails->first()->payment_status=="unpaid") selected @endif>Unpaid</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6" style="width: 100%;">
                                                <select class="form-control select2"
                                                    data-minimum-results-for-search="Infinity"
                                                    id="update_delivery_status">
                                                    <option value="pending" @if($order->orderDetails->first()->delivery_status=="pending") selected @endif>Pending</option>
                                                    <option value="on_review" @if($order->orderDetails->first()->delivery_status=="on_review") selected @endif>On review</option>
                                                    <option value="on_delivery" @if($order->orderDetails->first()->delivery_status=="on_delivery") selected @endif>On delivery</option>
                                                    <option value="delivered" @if($order->orderDetails->first()->delivery_status=="delivered") selected @endif>Delivered</option>
                                                    <option value="cancel" @if($order->orderDetails->first()->delivery_status=="cancel") selected @endif>Cancel</option>
                                                </select>
                                            </div>
                                        </div>
                                        <a href="{{ route('customer.invoice.download', $order->id) }}" class="btn btn-primary mt-2 mt-xl-0"><i class="mdi mdi-folder-download"></i> invoice</a>

                                        {{-- <button type="button"
                                            class="btn btn-light bg-white btn-icon mr-3 d-none d-md-block ">
                                            <i class="mdi mdi-download text-muted"></i>
                                        </button>
                                        <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
                                            <i class="mdi mdi-clock-outline text-muted"></i>
                                        </button>
                                        <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
                                            <i class="mdi mdi-plus text-muted"></i>
                                        </button> --}}
                                        {{-- <a href="{{ route('product.create') }}"
                                            class="btn btn-primary mt-2 mt-xl-0">Create
                                            products</a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="invoice-masthead">
                                            <div class="invoice-text">
                                                <h3 class="h1 text-thin mar-no text-primary">{{ __('Order Details') }}
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <address>
                                                    @php
                                                        $shipping_address = \App\Models\UserAddress::where('id',$order->shipping_address)->first();
                                                    @endphp
                                                    <strong class="text-main">{{ $order->user->name }}</strong><br>
                                                    {{ $order->user->email }}<br>
                                                    {{ $order->user->phone }}<br>
                                                    {{ $shipping_address->address }}
                                                </address>
                                                @if ($order->manual_payment && is_array(json_decode($order->manual_payment_data, true)))
                                                    <br>
                                                    <strong
                                                        class="text-main">{{ __('Payment Information') }}</strong><br>
                                                    Name: {{ json_decode($order->manual_payment_data)->name }},
                                                    Amount:
                                                    {{ single_price(json_decode($order->manual_payment_data)->amount) }},
                                                    TRX ID:
                                                    {{ json_decode($order->manual_payment_data)->trx_id }}
                                                    <br>
                                                    <a href="{{ asset(json_decode($order->manual_payment_data)->photo) }}"
                                                        target="_blank"><img
                                                            src="{{ asset(json_decode($order->manual_payment_data)->photo) }}"
                                                            alt="" height="100"></a>
                                                @endif
                                            </div>
                                            <div
                                                class="col-md-6 float-none float-sm-right d-block mt-1 mt-sm-0 text-right">
                                                <table
                                                    class="float-none float-sm-right d-block mt-1 mt-sm-0 text-right">
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-main text-bold">
                                                                {{ __('Order #') }}
                                                            </td>
                                                            <td class="text-right text-info text-bold">
                                                                {{ $order->code }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-main text-bold">
                                                                {{ __('Order Status') }}
                                                            </td>
                                                            @php
                                                                $status = $order->orderDetails->first()->delivery_status;
                                                            @endphp
                                                            <td class="text-right">
                                                                @if ($status == 'delivered')
                                                                    <span
                                                                        class="badge badge-success">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
                                                                @else
                                                                    <span
                                                                        class="badge badge-info">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-main text-bold">
                                                                {{ __('Order Date') }}
                                                            </td>
                                                            <td class="text-right">
                                                                {{ date('d-m-Y h:i A', $order->date) }} (UTC)
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-main text-bold">
                                                                {{ __('Total amount') }}
                                                            </td>
                                                            <td class="text-right">
                                                                {{ single_price($order->orderDetails->sum('price') + $order->orderDetails->sum('tax')) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-main text-bold">
                                                                {{ __('Payment method') }}
                                                            </td>
                                                            <td class="text-right">
                                                                {{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-lg-12 table-responsive">
                                                <table id="table" class="display" style="width: 100%">
                                                    <thead>
                                                        <tr class="bg-trans-dark">
                                                            <th class="min-col">#</th>
                                                            <th width="10%">
                                                                {{ __('Photo') }}
                                                            </th>
                                                            <th class="text-uppercase">
                                                                {{ __('Description') }}
                                                            </th>
                                                            <th class="text-uppercase">
                                                                {{ __('Delivery Type') }}
                                                            </th>
                                                            <th class="min-col text-center text-uppercase">
                                                                {{ __('Qty') }}
                                                            </th>
                                                            <th class="min-col text-center text-uppercase">
                                                                {{ __('Price') }}
                                                            </th>
                                                            <th class="min-col text-right text-uppercase">
                                                                {{ __('Total') }}
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($order->orderDetails as $key => $orderDetail)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>
                                                                    @if ($orderDetail->product != null)
                                                        <img height="50" src="{{ get_image_by_upload_id($orderDetail->product->thumbnail_img) }}">
                                                    @else
                                                        <strong>{{ __('N/A') }}</strong>
                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($orderDetail->product != null)
                                                        <strong>{{ $orderDetail->product->name }}</strong>
                                                        <small>{{ $orderDetail->variation }}</small>
                                                    @else
                                                        <strong>{{ __('Product Unavailable') }}</strong>
                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($orderDetail->shipping_type != null && $orderDetail->shipping_type == 'home_delivery')
                                                                        {{ __('Home Delivery') }}
                                                                    @elseif ($orderDetail->shipping_type ==
                                                                        'pickup_point')
                                                                        @if ($orderDetail->pickup_point != null)
                                                                            {{ $orderDetail->pickup_point->name }}
                                                                            ({{ __('Pickup Point') }})
                                                                        @else
                                                                            {{ __('Pickup Point') }}
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ $orderDetail->quantity }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ single_price($orderDetail->price / $orderDetail->quantity) }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ single_price($orderDetail->price) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="clearfix">
                                            <div class="col-lg-12 table-responsive">

                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">

                                                </div>
                                                <div class="col-sm-6 table-responsive">
                                                    <table
                                                        class="table invoice-total float-none float-sm-right d-block mt-1 mt-sm-0 text-right">
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-left" style="width: 100%;">
                                                                    <strong>{{ __('Sub Total') }} :</strong>
                                                                </td>
                                                                <td style="width: 100%;">
                                                                    {{ single_price($order->orderDetails->sum('price')) }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left">
                                                                    <strong>{{ __('Tax') }} :</strong>
                                                                </td>
                                                                <td>
                                                                    {{ single_price($order->orderDetails->sum('tax')) }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left">
                                                                    <strong>{{ __('Shipping') }} :</strong>
                                                                </td>
                                                                <td>
                                                                    {{ single_price($order->orderDetails->sum('shipping_cost')) }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left">
                                                                    <strong>{{ __('TOTAL') }} :</strong>
                                                                </td>
                                                                <td class="text-bold h4">
                                                                    {{ single_price($order->grand_total) }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right no-print">
                                            <a href="{{ route('customer.invoice.download', $order->id) }}" class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @include('admin.layout.footer')
                </div>
                @section('script')
                    <script src="{{ asset('vendors/js/select2.min.js') }}"></script>
                    <script>
                        $(function() {
                            $('.select2').select2();
                        })
                        $('#table').dataTable({searching: false, paging: false, info: false});
                    </script>
                    <script type="text/javascript">
                        function sort_orders(el) {
                            $('#sort_orders').submit();
                        }
                    </script>
                        <script type="text/javascript">
                            $('#update_delivery_status').on('change', function(){
                                $(".loader").show();
                                var order_id = "{{ $order->id }}";
                                var status = $('#update_delivery_status').val();
                                var length = 0;
                                var breadth = 0;
                                var height = 0;
                                var weight = 0;
                                if(status=="on_delivery"){
                                    length = prompt("Product length", "");
                                    breadth = prompt("Product breadth", "");
                                    height = prompt("Product height", "");
                                    weight = prompt("Product weight", "");
                                }

                                $.post('{{ route("order.update_delivery_status") }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status,length:length, breadth:breadth, height:height,weight:weight}, function(data){
                                    $(".loader").hide();
                                    if(data==2){
                                        toast('This order are canceled you can not placed to delevery!','error');
                                    }else{
                                        toast('Delivery status has been updated', 'success');
                                    }
                                    console.log(data);
                                });
                            });

                            $('#update_payment_status').on('change', function(){
                                $(".loader").show();
                                var order_id = "{{ $order->id }}";
                                var status = $('#update_payment_status').val();
                                $.post('{{ route('orders.update_payment_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
                                    $(".loader").hide();
                                    if(data==4){
                                        toast('This order are canceled you can not placed to delevery!' , 'error');
                                    }else{
                                        toast('Payment status has been updated' , 'success');
                                    }

                                });
                            });
                        </script>

                @endsection

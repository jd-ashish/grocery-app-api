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
                        <button type="button" class="btn btn-light bg-white btn-icon mr-3 d-none d-md-block ">
                            <i class="mdi mdi-download text-muted"></i>
                        </button>
                        <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
                            <i class="mdi mdi-clock-outline text-muted"></i>
                        </button>
                        <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
                            <i class="mdi mdi-plus text-muted"></i>
                        </button>
                        <a href="{{ route('product.create') }}" class="btn btn-primary mt-2 mt-xl-0">Create
                            products</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body dashboard-tabs p-0">
                        <ul class="nav nav-tabs px-4" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview"
                                    role="tab" aria-controls="overview" aria-selected="true"><i class="mdi mdi-filter-outline" aria-hidden="true"></i> Filter</a>
                            </li>
                        </ul>
                        <div class="tab-content py-0 px-0">
                            <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                aria-labelledby="overview-tab">
                                <div class="row">
                                    <div class="col-12 stretch-card">
                                        <div class="card">
                                          <div class="card-body">
                                            <form class="form-inline" id="sort_orders" action="" method="GET">
                                              <div class="input-group mb-2 mr-sm-2 " >
                                                    <select class="select2 form-control mb-2 mr-sm-2" name="payment_type"
                                                        id="payment_type" onchange="sort_orders()">
                                                        <option value="">{{ __('Filter by Payment Status') }}</option>
                                                        <option value="paid" @isset($payment_status)
                                                            @if ($payment_status == 'paid') selected @endif @endisset>{{ __('Paid') }}
                                                        </option>
                                                        <option value="unpaid" @isset($payment_status)
                                                            @if ($payment_status == 'unpaid') selected @endif @endisset>{{ __('Un-Paid') }}
                                                        </option>
                                                    </select>
                                              </div>
                                              <div class="input-group mb-2 mr-sm-2">
                                                    <select class="form-control mb-2 mr-sm-2 select2" name="delivery_status"
                                                    id="delivery_status" onchange="sort_orders()">
                                                    <option value="">{{ __('Filter by Deliver Status') }}</option>
                                                    <option value="pending" @isset($delivery_status)
                                                        @if ($delivery_status == 'pending') selected @endif @endisset>{{ __('Pending') }}</option>
                                                    <option value="on_review" @isset($delivery_status)
                                                        @if ($delivery_status == 'on_review') selected @endif @endisset>{{ __('On review') }}</option>
                                                    <option value="on_delivery" @isset($delivery_status)
                                                        @if ($delivery_status == 'on_delivery') selected @endif @endisset>{{ __('On delivery') }}
                                                    </option>
                                                    <option value="delivered" @isset($delivery_status)
                                                        @if ($delivery_status == 'delivered') selected @endif @endisset>{{ __('Delivered') }}</option>
                                                </select>
                                              </div>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive pt-3">
                            <table id="table" class="display" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th># </th>
                                        <th>{{ __('Order Code') }} </th>
                                        <th>{{ __('Num. of Products') }} </th>
                                        <th>{{ __('Customer') }} </th>
                                        <th>{{ __('Amount') }} </th>
                                        <th>{{ __('Delivery Status') }} </th>
                                        <th>{{ __('Payment Method') }} </th>
                                        <th>{{ __('Payment Status') }} </th>
                                        <th width="10%">{{ __('Options') }} </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $order_id)
                                        @php
                                            $order = \App\Models\Order::find($order_id->id);
                                        @endphp
                                        @if ($order != null)
                                            <tr>
                                                <td>
                                                    {{ $key + 1 + ($orders->currentPage() - 1) * $orders->perPage() }}
                                                </td>
                                                <td>
                                                    {{ $order->code }} @if ($order->viewed == 0) <span class="pull-right badge badge-info">{{ __('New') }}</span> @endif
                                                </td>
                                                <td>
                                                    {{ count($order->orderDetails->where('seller_id', $admin_user_id)) }}
                                                </td>
                                                <td>
                                                    @if ($order->user_id != null)
                                                        {{ $order->user->name }}
                                                    @else
                                                        Guest ({{ $order->guest_id }})
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        if ($order->payment_type == 'wallet') {
                                                            $ship_cst = 0;
                                                        } else {
                                                            $ship_cst = $order->orderDetails->where('seller_id', $admin_user_id)->sum('shipping_cost');
                                                        }
                                                    @endphp
                                                    {{ single_price($order->orderDetails->where('seller_id', $admin_user_id)->sum('price') + $order->orderDetails->where('seller_id', $admin_user_id)->sum('tax') + $ship_cst) }}
                                                </td>
                                                <td>
                                                    @php
                                                        $status = $order->orderDetails->first()->delivery_status;
                                                    @endphp
                                                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                                                </td>
                                                <td>
                                                    {{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}
                                                </td>
                                                <td>
                                                    <span class="badge badge--2 mr-4">
                                                        @if ($order->orderDetails->where('seller_id', $admin_user_id)->first()->payment_status == 'paid')
                                                            <i class="bg-green"></i> Paid
                                                        @else
                                                            <i class="bg-red"></i> Unpaid
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    @php
                                                    $arr = array();
                                                    // $arr[] = array(
                                                    //     "route" => route('product.category.delete',$order_id->id),
                                                    //     "name" => "Delete product",
                                                    //     "name2" => $order_id->id,
                                                    //     "id" => $order_id->id,
                                                    //     "isLink" => false,
                                                    //     "isDelete" => true,
                                                    //     "icon" => '<i class="mdi mdi-delete-forever text-danger"></i>',
                                                    // );
                                                    $arr[] = array(
                                                        "route" => route('order.details',encrypt($order_id->id)),
                                                        "name" => "View Order",
                                                        "name2" => "",
                                                        "id" => $order_id->id,
                                                        "isLink" => true,
                                                        "isDelete" => false,
                                                        "icon" => '<i class="mdi mdi-eye text-success"></i>',
                                                    );

                                                    echo table_more($arr);
                                                @endphp
                                                </td>
                                            </tr>
                                        @endif
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
    <script src="{{ asset('vendors/js/select2.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2();
        })
    </script>
<script type="text/javascript">
    function sort_orders(el){
        $('#sort_orders').submit();
    }
</script>
@endsection

{{-- <div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Orders')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_orders" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="select" style="min-width: 300px;">
                        <select class="form-control demo-select2" name="payment_type" id="payment_type" onchange="sort_orders()">
                            <option value="">{{__('Filter by Payment Status')}}</option>
                            <option value="paid"  @isset($payment_status) @if ($payment_status == 'paid') selected @endif @endisset>{{__('Paid')}}</option>
                            <option value="unpaid"  @isset($payment_status) @if ($payment_status == 'unpaid') selected @endif @endisset>{{__('Un-Paid')}}</option>
                        </select>
                    </div>
                </div>
                <div class="box-inline pad-rgt pull-left">
                    <div class="select" style="min-width: 300px;">
                        <select class="form-control demo-select2" name="delivery_status" id="delivery_status" onchange="sort_orders()">
                            <option value="">{{__('Filter by Deliver Status')}}</option>
                            <option value="pending"   @isset($delivery_status) @if ($delivery_status == 'pending') selected @endif @endisset>{{__('Pending')}}</option>
                            <option value="on_review"   @isset($delivery_status) @if ($delivery_status == 'on_review') selected @endif @endisset>{{__('On review')}}</option>
                            <option value="on_delivery"   @isset($delivery_status) @if ($delivery_status == 'on_delivery') selected @endif @endisset>{{__('On delivery')}}</option>
                            <option value="delivered"   @isset($delivery_status) @if ($delivery_status == 'delivered') selected @endif @endisset>{{__('Delivered')}}</option>
                        </select>
                    </div>
                </div>
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type & Enter">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">

        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $orders->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div> --}}

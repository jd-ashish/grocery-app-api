<!-- Modal Header -->
<div class="modal-header bg-danger text-white">
    <h4 class="modal-title">Payment Recived On {{ ucfirst($refund->order->payment_type) }}</h4>
    <button type="button" class="close" data-dismiss="modal" model-iid=".myModal-dynamic" aria-label="Close">
       <span aria-hidden="true">&times;</span>
   </button>
</div>

<!-- Modal body -->
<div class="modal-body ">
    {{-- {{ $refund->order->payment_details }} --}}
    @php
        $obj = json_decode($refund->order->payment_details);
        // print_r(json_decode(rzp_get_payments($obj->tid),true));
    @endphp
    @if ($refund->order->payment_type=="razorpay")
        <div class="row">
            <div class="col-sm-12">
                <table class="table float-none  d-block mt-1 mt-sm-0 text-right">
                    @foreach (json_decode(rzp_get_payments($obj->tid),true) as  $key => $item)
                        @if($key=="notes" || $key=="acquirer_data")

                        @else
                            @if($key=="amount")
                                <tr>
                                    <th class="text-left" style="width: 100%;"><?php print_r($key);?></th>
                                    <td style="width: 100%; white-space: nowrap;">{{ ($item/100) }}</td>
                                </tr>
                            @else
                                <tr>
                                    <th class="text-left" style="width: 100%;"><?php print_r($key);?></th>
                                    <td style="width: 100%; white-space: nowrap;"><?php print_r($item);?></td>
                                </tr>
                            @endif
                        @endif

                    @endforeach
                </table>
            </div>
        </div>

    @endif
    @if ($refund->order->payment_type=="cashfree")
    <div class="row">
        <div class="col-sm-12">
            <table class="table float-none  d-block mt-1 mt-sm-0 text-right">
                <tr>
                    <th class="text-left" style="width: 100%;">Payment Method</th>
                    <td style="width: 100%; white-space: nowrap;">{{ $obj->paymentMode }}</td>
                </tr>
                <tr>
                    <th class="text-left" style="width: 100%;">Payment Ordert ID</th>
                    <td style="width: 100%; white-space: nowrap;">{{ $obj->orderId }}</td>
                </tr>
                <tr>
                    <th class="text-left" style="width: 100%;">Transaction Time</th>
                    <td style="width: 100%; white-space: nowrap;">{{ $obj->txTime }}</td>
                </tr>
                <tr>
                    <th class="text-left" style="width: 100%;">Reference Id</th>
                    <td style="width: 100%; white-space: nowrap;">{{ $obj->referenceId }}</td>
                </tr>
                <tr>
                    <th class="text-left" style="width: 100%;">Message</th>
                    <td style="width: 100%; white-space: nowrap;">{{ $obj->txMsg }}</td>
                </tr>
                <tr>
                    <th class="text-left" style="width: 100%;">Reference Id</th>
                    <td style="width: 100%; white-space: nowrap;">{{ $obj->referenceId }}</td>
                </tr>
                <tr>
                    <th class="text-left" style="width: 100%;">OrderAmount</th>
                    <td style="width: 100%; white-space: nowrap;">{{ ($obj->orderAmount) }}</td>
                </tr>
                <tr>
                    <th class="text-left" style="width: 100%;">Tnx Status</th>
                    <td style="width: 100%; white-space: nowrap;">{{ $obj->txStatus }}</td>
                </tr>
            </table>
        </div>
    </div>
    @endif

</div>
<div class="modal-footer pb-5">
    @if ($refund->order->payment_type=="razorpay")
        @if ($refund->status==0)
        <form method="POST" action="{{ route('normal.refund') }}" class="n_refund_submit">
            @csrf
            <input type="hidden" value="{{ json_decode(rzp_get_payments($obj->tid))->id }}" name="pay_id"/>
            <input type="hidden" value="{{ json_decode(rzp_get_payments($obj->tid))->amount }}" name="amount"/>
            <input type="hidden" value="{{ $refund->id }}" name="redund_id"/>
        </form>
        <button type="button" class="btn btn-success n_refund " onclick="Refund()">Norman Refund</button>
        {{-- <button type="button" class="btn btn-light i_refund" id="i_refund">Instant Refund</button> --}}

        @else
        <button type="button" class="btn btn-success " >Refunded with in 7 day</button>
        @endif
    @endif
    @if ($refund->order->payment_type=="cashfree")
        @if ($refund->status==0)
        <form method="POST" action="{{ route('cashfree.refund') }}" class="cashfree_refund_submit">
            @csrf
            <input type="hidden" value="{{ $obj->orderId }}" name="order_id"/>
            <input type="hidden" value="{{ $obj->orderAmount }}" name="refund_amount"/>
            <input type="hidden" value="{{ $obj->orderId }}" name="refund_id"/>
            <input type="hidden" value="{{ $refund->id }}" name="id"/>
            <input type="hidden" value="order is canceled by user" name="refund_note"/>
        </form>
        <button type="button" class="btn btn-success " onclick="CashfreeRefund()">Refund</button>
        {{-- <button type="button" class="btn btn-light i_refund" id="i_refund">Instant Refund</button> --}}

        @else
        <button type="button" class="btn btn-success " >Refunded with in 7 day</button>
        @endif
    @endif
</div>

<script>
function Refund() {
  let text = "Press a button!\nEither OK or Cancel.";
  if (confirm(text) == true) {
     $(".n_refund_submit").submit();
  } else {
    text = "You canceled!";
  }
  document.getElementById("i_refund").innerHTML = text;
}
function CashfreeRefund() {
  let text = "Press a button!\nEither OK or Cancel.";
  if (confirm(text) == true) {
     $(".cashfree_refund_submit").submit();
  } else {
    text = "You canceled!";
  }
  document.getElementById("i_refund").innerHTML = text;
}
</script>

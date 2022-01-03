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
                    {{ inline_brd(['Dashboard', 'Settings', 'Currency']) }}
                    <div class="d-flex justify-content-between align-items-end flex-wrap">
                        <a onclick="currency_modal()" class="btn btn-success text-light" style="cursor: pointer"><span
                                class="mdi mdi-currency-inr"></span> {{__('Add New Currency')}}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{__('System Default Currency')}}</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <form class="" action="{{ route('global.setting.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label">{{__('System Default Currency')}}</label>
                                        <select class="form-control select2" name="system_default_currency">
                                            @foreach ($active_currencies as $key => $currency)
                                                <option value="{{ $currency->id }}" <?php if(setting('system_default_currency') == $currency->id) echo 'selected'?> >{{ $currency->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="types[]" value="system_default_currency">
                                        <div class="float-right mt-3">
                                            <button class="btn btn-success" type="submit"><span
                                                class="mdi mdi-currency-inr"></span> {{__('Save')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{__('Currency fornat')}}</h4>
                        <form class="form-horizontal" action="{{ route('global.setting.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="types[]" value="symbol_format">
                                <div class="col-lg-3">
                                    <label class="control-label">{{__('Symbol Format')}}</label>
                                </div>
                                <div class="col-lg-6">
                                    <select class="form-control select2" name="symbol_format">
                                        <option value="1" @if(setting('symbol_format') == 1) selected @endif>[Symbol] [Amount]</option>
                                        <option value="2" @if(setting('symbol_format') == 2) selected @endif>[Amount] [Symbol]</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="types[]" value="no_of_decimals">
                                <div class="col-lg-3">
                                    <label class="control-label">{{__('No of decimals')}}</label>
                                </div>
                                <div class="col-lg-6">
                                    <select class="form-control select2" name="no_of_decimals">
                                        <option value="0" @if(setting('no_of_decimals') == 0) selected @endif>12345</option>
                                        <option value="1" @if(setting('no_of_decimals') == 1) selected @endif>1234.5</option>
                                        <option value="2" @if(setting('no_of_decimals') == 2) selected @endif>123.45</option>
                                        <option value="3" @if(setting('no_of_decimals') == 3) selected @endif>12.345</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12 text-right">
                                    <button class="btn btn-success" type="submit"><span
                                        class="mdi mdi-currency-inr"></span> {{__('Save')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User list</h4>
                        <div class="table-responsive pt-3">
                            <table id="table" class="display" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('Currency name')}}</th>
                                        <th>{{__('Currency symbol')}}</th>
                                        <th>{{__('Currency code')}}</th>
                                        <th>{{__('Exchange rate')}}(1 USD = ?)</th>
                                        <th>{{__('Status')}}</th>
                                        <th width="10%">{{__('Options')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($currencies as $key => $currency)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$currency->name}}</td>
                                            <td>{{$currency->symbol}}</td>
                                            <td>{{$currency->code}}</td>
                                            <td>{{$currency->exchange_rate}}</td>
                                            <td>
                                                <label class="switch">
                                                    <input onchange="update_currency_status(this)" value="{{ $currency->id }}" type="checkbox" <?php if($currency->status == 1) echo "checked";?> >
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <div class="btn-group dropdown">
                                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                        {{__('Actions')}} <i class="dropdown-caret"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a onclick="edit_currency_modal('{{$currency->id}}');">{{__('Edit')}}</a></li>
                                                    </ul>
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
    <div class="modal fade" id="currency_modal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" id="modal-content">
    
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    @include('admin.layout.footer')
</div>

@section('script')
<script src="{{ asset('vendors/js/select2.min.js') }}"></script>
<script>
    $(function() {
        $('.select2').select2({
            width: '100%',
            placeholder: 'Select an option'
        });
    })
</script>
    <script type="text/javascript">

        //Updates default currencies
        // function updateCurrency(i){
        //     var exchange_rate = $('#exchange_rate_'+i).val();
        //     if($('#status_'+i).is(':checked')){
        //         var status = 1;
        //     }
        //     else{
        //         var status = 0;
        //     }
        //     $.post('{{ route('currency.update') }}', {_token:'{{ csrf_token() }}', id:i, exchange_rate:exchange_rate, status:status}, function(data){
        //         location.reload();
        //     });
        // }
        //
        // //Updates your currency
        // function updateYourCurrency(i){
        //     var name = $('#name_'+i).val();
        //     var symbol = $('#symbol_'+i).val();
        //     var code = $('#code_'+i).val();
        //     var exchange_rate = $('#exchange_rate_'+i).val();
        //     if($('#status_'+i).is(':checked')){
        //         var status = 1;
        //     }
        //     else{
        //         var status = 0;
        //     }
        //     $.post('{{ route('your_currency.update') }}', {_token:'{{ csrf_token() }}', id:i, name:name, symbol:symbol, code:code, exchange_rate:exchange_rate, status:status}, function(data){
        //         location.reload();
        //     });
        // }

        function currency_modal(){
            $(".loader").show();
            $.get('{{ route('currency.create') }}',function(data){
                $(".loader").hide();
                $('#currency_modal_edit .modal-content').html(data);
                $('#currency_modal_edit').modal('show', {backdrop: 'static'});
            });
        }

        function update_currency_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('currency.update_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Currency Status updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function edit_currency_modal(id){
            $(".loader").show();
            $.post('{{ route('currency.edit') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
                $(".loader").hide();
                $('#currency_modal_edit .modal-content').html(data);
                $('#currency_modal_edit').modal('show', {backdrop: 'static'});
            });
        }
    </script>
@endsection

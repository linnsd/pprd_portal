@extends('adminlte::page')

@section('title', 'နေ့စဉ်မှတ်တမ်းထည့်ရန်')

@section('content_header')

    <h4>နေ့စဉ်မှတ်တမ်းထည့်ရန်</h4><br>

@stop

@section('content')
   
        <form action="{{route('admin.daily_shop_reports.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf
          
            <div class="row ">
                <div class="col-md-6">
                    <div class="row" style="margin-left:10px;">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">စက်သုံးဆီအရောင်းဆိုင် *</label>
                             <div class="col-md-7">
                                <select name="f_shop_id" id="f_shop_id" class="form-control" style="width: 100%;" required> 
                                    <option value="">--စက်သုံးဆီ အရောင်းဆိုင်--</option>
                                    @foreach(App\Helper\Helpers::fuel_shops() as $fuel_shop)
                                    <option value="{{$fuel_shop->id}}">{{$fuel_shop->shopName}}</option>
                                    @endforeach
                               </select>

                                @if ($errors->has('f_shop_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('f_shop_id') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-left:10px;">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">စက်သုံးဆီအမျိုးအစား *</label>
                             <div class="col-md-7">
                                <select class="form-control" id="fuel_type" name="fuel_type" required>
                                    <option value="">စက်သုံးဆီအမျိုးအစား</option>
                                </select>

                                @if ($errors->has('fuel_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fuel_type') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>
                    </div>

                    <!-- report_times -->
                    <div class="row" style="margin-left:10px;">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">Reporting Time *</label>
                             <div class="col-md-7">
                                <select class="form-control" id="report_time" name="report_time" required>
                                    <option value="">Reporting Time</option>

                                </select>

                                @if ($errors->has('report_time'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('report_time') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>
                    </div>

                <div class="row" id="is_order" style="margin-left:10px;">  
                <div class="form-group">
                    <label for="" class="form-label col-md-4">အော်ဒါမှာယူထားခြင်း ရှိ/မရှိ</label>
                    <div class="row">
                        <div class="col-md-2">
                          <input type="radio" name="is_order" value="0" checked id="order_no"> <small>မရှိ</small>
                       </div>

                        <div class="col-md-2">
                            <input type="radio" name="is_order" value="1" id="order_yes"> <small>ရှိ</small>
                        </div>
                       
                    </div>
                   
                </div>  
                  
             </div>

             <div class="row" id="is_received" style="margin-left:10px;">  
                <div class="form-group">
                    <label for="" class="form-label col-md-4">လက်ခံထားခြင်း ရှိ/မရှိ</label>
                    <div class="row">
                        <div class="col-md-2">
                          <input type="radio" name="is_received" value="0" checked id="received_no"> <small>မရှိ</small>
                       </div>

                        <div class="col-md-2">
                            <input type="radio" name="is_received" value="1" id="received_yes"> <small>ရှိ</small>
                        </div>
                       
                    </div>
                   
                </div>  
                  
             </div>

             <div id="is_order_yes">
                 <div class="row" style="margin-left:10px;">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">Supplier Name*</label>
                             <div class="col-md-7">
                                <input type="text" name="order_company_name" class="form-control" id="company_name" placeholder="ABC Training Co.,Ltd.">
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-left:10px;">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">Terminal*</label>
                             <div class="col-md-7">
                                <input type="text" placeholder="Terminal" name="order_terminal" class="form-control" id="terminal">
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-left:10px;">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ယာဉ်အမှတ်</label>
                             <div class="col-md-7">
                                <input type="text" placeholder="5Q-3448" name="order_bowser_no" class="form-control" id="bowser_no">
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-left:10px;">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ခန့်မှန်းရောက်ရှိချိန်*</label>
                             <div class="col-md-7">
                                <input type="text" placeholder="{{date('d-m-Y')}}" name="order_arrival_date" class="form-control" id="arrival_date">
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-left:10px;">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ပမာဏ*</label>
                             <div class="col-md-7">
                                <input type="number" placeholder="1000" name="order_capacity" class="form-control" id="capacity">
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-left:10px;">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">Remark</label>
                             <div class="col-md-7">
                                <textarea class="form-control" placeholder="Remark" id="remark" name="order_remark"></textarea>
                            </div>
                        </div>
                    </div>
             </div>

             <div id="is_received_yes">
                 <div class="row" style="margin-left:10px;">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">Supplier Name*</label>
                             <div class="col-md-7">
                                <input type="text" name="received_company_name" class="form-control" id="company_name" placeholder="ABC Training Co.,Ltd.">
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-left:10px;">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">Terminal*</label>
                             <div class="col-md-7">
                                <input type="text" placeholder="Terminal" name="received_terminal" class="form-control" id="terminal">
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-left:10px;">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ယာဉ်အမှတ်</label>
                             <div class="col-md-7">
                                <input type="text" placeholder="5Q-3448" name="received_bowser_no" class="form-control" id="bowser_no">
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-left:10px;">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ရောက်ရှိချိန်*</label>
                             <div class="col-md-7">
                                <input type="text" placeholder="{{date('d-m-Y')}}" name="received_arrival_date" class="form-control" id="arrival_date">
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-left:10px;">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ပမာဏ*</label>
                             <div class="col-md-7">
                                <input type="number" placeholder="1000" name="capacity" class="form-control" id="capacity">
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-left:10px;">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">Remark</label>
                             <div class="col-md-7">
                                <textarea class="form-control" placeholder="Remark" id="remark" name="remark"></textarea>
                            </div>
                        </div>
                    </div>
             </div>

                <div class="row text-center">
                    <a class="btn btn-primary" href="{{ route('admin.daily_shop_reports.index') }}"><i  class="fa fa-fw fa-arrow-left"></i>  နောက်သို့</a>
                    <button type="submit" class="btn btn-success"><i  class="fa fa-fw fa-floppy-o"></i>သိမ်းမည်</button>
                </div>
                </div>   
                <div class="col-md-6">
                    <div class="row" style="margin-left:10px;">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4"> ယခင် စက်သုံးဆီ လက်ကျန်*</label>
                             <div class="col-md-7">
                                <input type="text" name="previous_balance" class="form-control" id="previous_balance" readonly>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="avg_sale_capacity" id="avg_sale_capacity">
                    <input type="hidden" name="max_capacity" id="max_capacity">
                    <div class="row" style="margin-left:10px;">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">လက်ကျန်ရောင်းရနိုင်မည့်ရက်*</label>
                             <div class="col-md-7">
                                <input type="text" name="remain_day" class="form-control" id="remain_day" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-left:10px;">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ယခု စက်သုံးဆီ လက်ကျန်*</label>
                             <div class="col-md-7">
                                <input type="number" name="now_balance" class="form-control" id="now_balance" readonly required>
                            </div>
                        </div>
                    </div>
                </div>           
                
            </div>
            </div>
           
        </form>
        <input type="hidden" id="ctr_token" value="{{ csrf_token()}}">

@stop



@section('css')
<link href="{{asset('file/select2/select2.min.css')}}" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.css') }}"/>
<style type="text/css" media="screen">
  .error_msg{
    color: #DD4B39;
  }
  .has-error input{
    border-color: #DD4B39;
  }

  .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 35px;
        user-select: none;
        -webkit-user-select: none; 
    }
      
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: black;
    }
</style>
   
@stop



@section('js')
    
<script src="{{asset('file/select2/select2.min.js')}}"></script>
 <script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>

<script>
$('#f_shop_id').select2({
        allowClear: true,
        placeholder: '--စက်သုံးဆီ အရောင်းဆိုင်--'
    });

var order_arrival_date=$('input[name="order_arrival_date"]').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            autoclose: true,
        });

var received_arrival_date=$('input[name="received_arrival_date"]').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            autoclose: true,
        });

$('#f_shop_id').on("change", function() {
    let val = $(this).val();

    get_report_time(val);

    var token = $("input[name='_token']").val();
    if (val != "") {

        $.ajax({
        type: "POST",
        url: '<?php echo route('admin.get_fuel_type_by_shop') ?>',
        data: {
            id: val,
            _token:token
        },
        success: function(data) {
            $("#fuel_type").html(data);
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    });
    }
});

function get_report_time(shop_id){
    var token = $("input[name='_token']").val();
        if (shop_id != "") {

            $.ajax({
            type: "POST",
            url: '<?php echo route('admin.get_report_time_by_shop') ?>',
            data: {
                shop_id: shop_id,
                _token:token
            },
            success: function(data) {
                $("#report_time").html(data);
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        });
        }
}

$('#fuel_type').on('change',function(){
    // alert($(this).val());
    var shop_id = $('#f_shop_id').val();
    var fuel_type_id = $(this).val();
    var token = $("input[name='_token']").val();
    if (fuel_type_id != "") {

        $.ajax({
        type: "POST",
        url: '<?php echo route('admin.get_prev_balance') ?>',
        data: {
            fuel_type_id: fuel_type_id,
            shop_id:shop_id,
            _token:token
        },
        success: function(data,day) {
            // console.log(data[0]);
            $('#max_capacity').val(data[0].max_capacity);
            $('#previous_balance').val(data[0].opening_balance);
            $('#avg_sale_capacity').val(data[0].avg_balance);
            $('#remain_day').val(data[1]);
            // readonly
            $("#now_balance").attr('readonly',false);
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    });
    }
});

$('#now_balance').on('change',function(){
    var prev_balance = parseInt($('#previous_balance').val());

    var now_balance = parseInt($(this).val());
    // alert(now_balance)
    if (prev_balance < now_balance) {
        alert('ယခုစက်သုံးဆီလက်ကျန် မှန်ကန်စွာထည့်ပါ');
        $('#now_balance').val("");
    }
});

$('#is_order_yes').hide();
$('#is_received_yes').hide();

$('#order_yes').on('click',function(){
    $('#is_order_yes').show();
    $('#is_received_yes').hide();
    $('#received_no').prop('checked', true);
    $('#received_yes').prop('checked',false);
});

$('#received_yes').on('click',function(){
    $('#is_received_yes').show();
    $('#is_order_yes').hide();
    $('#order_no').prop('checked', true);
    $('#order_yes').prop('checked',false);
});
</script>

@stop
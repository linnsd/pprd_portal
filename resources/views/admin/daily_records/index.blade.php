@extends('adminlte::page')

@section('title', 'နေ့စဉ်မှတ်တမ်း')

@section('content_header')

    <h1 class="unicode">နေ့စဉ်မှတ်တမ်း</h1>

@stop

@section('content')
    <div class="page_body">
        <div class="success-msg">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
        </div>

          <div class="row" style="margin-left:20px;">
            <?php
                $fuel_shop_id = (isset($_GET['fuel_shop_id']))?$_GET['fuel_shop_id']:'';
                $report_date = (isset($_GET['report_date']))?$_GET['report_date']:date('d-m-Y');
                    
                

                $current_hour = date('H') * 60 + date('i');

                $two_hour_report = (15 * 60) + 59;

                $six_hour_report = (21 * 60) + 59;

                $r_time = null;

                if ($current_hour >= 60 && $current_hour <= $two_hour_report) {
                    $r_time = "02:00 PM";
                }elseif ($current_hour >= (16 * 60) && $current_hour <= $six_hour_report) {
                    $r_time = "06:00 PM";
                }else{
                    $r_time = "10:00 PM";
                }

                $report_time = (isset($_GET['report_time']))?$_GET['report_time']:$r_time;

            ?>
            <form action="{{ url('admin/daily_shop_reports') }}" method="get" accept-charset="utf-8" class="form-horizontal">
                <div class="row">
                    <div class="col-md-2">
                       
                        <select class="form-control" id="fuel_shop_id" name="fuel_shop_id">
                            <option value="">ဆိုင်များ</option>
                            @foreach(App\Helper\Helpers::fuel_shops() as $key=>$fuel_shop)
                            <option value="{{$fuel_shop->id}}" {{$fuel_shop->id == $fuel_shop_id ? 'selected' : ''}}>{{$fuel_shop->shopName}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="report_date" id="report_date" class="form-control" value="{{ old('report_date',$report_date) }}">
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" id="report_time" name="report_time">
                            @foreach(App\Helper\Helpers::report_times(1) as $rp_time)
                            <option value="{{$rp_time->rep_time}}" {{ ($report_time==$rp_time->rep_time)?'selected':'' }}>{{$rp_time->rep_time}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-search"></i>ရှာရန်</button>
                    </div>
                    
                </div>
            </form>
            <br>
        </div>
 
        <div class="row">
             <div class="form-group" align="right" style="padding-right:10px;">
                <a class="btn btn-success" href="{{ route('admin.daily_shop_reports.create') }}"><i class="fa fa-fw fa-plus"></i> အသစ်ထည့်ရန်</a>
                
            </div>
        </div>
      
      <!-- approve_modal -->
    <div class="modal" id="approve_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-sm">
          <!-- Modal content-->
          <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title">Select Approve Date</h5>
                <button type="button" id="close_cross" data-dismiss="modal" style="float:right;">&times;</button>
             </div>
             <div class="modal-body">
                <form action="{{route('admin.dio_approve')}}" method="post" accept-charset="utf-8" class="form-horizontal unicode" enctype="multipart/form-data">
                @csrf

                 <input type="text" name="approve_date" id="approve_date" class="form-control" value="{{date('d-m-Y')}}"><br>
                 <input type="hidden" name="daily_report_id" id="daily_report_id" value="">
                 <input type="hidden" name="rep_date" id="rep_date">
                 <input type="hidden" name="approve_type" id="approve_type">
                 <div class="row text-center form-group">
                 
                  <button type="button" class="btn btn-danger my-2" data-dismiss="modal" id="close_btn">Cancel</button>
                     <button type="submit" class="btn btn-primary my-2">Save</button>
               </div>
           </form>
             </div>
             
          </div>
       </div>
    </div>

        <div class="table-responsive" style=" display: block;overflow-x: auto;white-space: nowrap;">
            <table class="table table-bordered scroll">
                <thead  style=" background-color: #605ca8;
            color: white;">
                    <tr>
                        <th>စဉ်</th>
                        <th>စိစစ်သည့်ရက်</th>
                        <th>စိစစ်သည့်အချိန်</th>
                        <th>စိစစ်သူအမည်</th>
                        <th>အရောင်းဆိုင်အမည်/မြို့နယ်</th>
                        <th>စက်သုံးဆီအမျိုးအစား</th>
                        <th>သိုလှောင်နိုင်မှု</th>
                        <th>လက်ကျန်</th>
                        <th>တစ်ရက်ပျမ်းမျှအရောင်း</th>
                        <th>ရောင်းချနိုင်မည့်ရက်</th>
                        <th>မှာယူထားရှိမှု</th>
                        <th>ခန့်မှန်းရောက်ရှိချိန်/အရောက်</th>
                        <th>မှတ်ချက်</th>
                    </tr>
                </thead>
                <tbody style="overflow-x:auto;">
                    @foreach($daily_records as $key=>$record)
                    <tr> 
                    <td rowspan="{{$record->fuel_list->count() + 1}}">{{++$key}}</td>
                    <td rowspan="{{$record->fuel_list->count() + 1}}">
                        @if($record->dio_approve_date != null)
                        {{date('d-m-Y',strtotime($record->dio_approve_date))}}
                        @endif
                    </td>
                    <td rowspan="{{$record->fuel_list->count() + 1}}">
                        {{$record->report_time}}
                    </td>
                    <td rowspan="{{$record->fuel_list->count() + 1}}">{{$record->dio_approve_name}}<br>{{$record->admin_approve_name}}</td>
                    <td rowspan="{{$record->fuel_list->count() + 1}}">
                        @if(auth()->user()->role_id==3)
                            @if($record->dio_approve == 0)
                                <a class="alert_modal" style="cursor: pointer;" data-id="{{$record->shop_id}}" data-date="{{$report_date}}" approve-type="1">{{$record->shop_name}}<br>{{$record->tsh_name_mm}}</a>
                            @else
                                {{$record->shop_name}}<br>{{$record->tsh_name_mm}}
                            @endif
                        @else
                            @if($record->admin_approve == 0)
                                <a class="alert_modal" style="cursor: pointer;" data-id="{{$record->shop_id}}" data-date="{{$report_date}}" approve-type="2">{{$record->shop_name}}<br>{{$record->tsh_name_mm}}</a>
                            @else
                                {{$record->shop_name}}<br>{{$record->tsh_name_mm}}
                            @endif
                        @endif
                         
                    </td>

                    @foreach($record->fuel_list as $fuel)
                      <tr>
                        <td style="text-align:center;">
                           {{$fuel->fuel_type_name}}
                        </td>
                        <td style="text-align: right;">
                             <a href="" data-date="" style="color:black" class="update" data-name="max_capacity" data-type="text" data-pk="" data-fuel="{{ $fuel->id}}">{{number_format($fuel->max_capacity)}}</a>
                        </td>
                        <td style="text-align:right;">
                             <a href="" data-date="" style="color:black" class="update" data-name="opening_balance" data-type="text" data-pk="" data-fuel="{{ $fuel->id}}">{{number_format($fuel->opening_balance)}}</a>

                            </td>
                        <td style="text-align:right;">
                             <a href="" data-date="" style="color:black" class="update" data-name="avg_balance" data-type="text" data-pk="" data-fuel="{{ $fuel->id}}"> {{number_format($fuel->avg_balance)}}</a>

                           </td>
                           <td style="text-align:right;">
                             <a href="" data-date="" style="color:black" class="update" data-name="day" data-type="text" data-pk="" data-fuel="{{ $fuel->id}}"> 
                                <?php 
                                if ($fuel->opening_balance != 0 && $fuel->avg_balance != 0) {
                                    $day = $fuel->opening_balance / $fuel->avg_balance;
                                }else{
                                    $day = 0;
                                }
                                    
                                 ?>
                                {{number_format($day)}}</a>

                           </td>
                           <td style="text-align:right;">
                             <a href="" data-date="" style="color:black" class="update" data-name="order_fuel" data-type="text" data-pk="" data-fuel="{{ $fuel->id}}"> {{number_format($fuel->order_fuel)}}</a>

                           </td>
                           <td>
                             <a href="" data-date="" style="color:black" class="update" data-name="arrival_date" data-type="text" data-pk="" data-fuel="{{ $fuel->id}}">@if($fuel->arrival_date != null){{date('d-m-Y',strtotime($fuel->arrival_date))}}@endif</a>

                           </td>
                           <td>
                             <a href="" data-date="" style="color:black" class="update" data-name="remark" data-type="text" data-pk="" data-fuel="{{ $fuel->id}}"> {{$fuel->remark}}</a>

                           </td>
                      </tr>
                  @endforeach
                </tr>   
               @endforeach
                </tbody>
            </table>
            {!! $daily_records->appends(request()->input())->links() !!}

       </div>
    </div>
      
@stop

@section('css')
<link href="{{asset('file/select2/select2.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.css') }}"/>
 <style type="text/css" media="screen">
    table.scroll thead {
        overflow-x: scroll;
    }

    .emp_name {
         width: 180px !important; 
         overflow: hidden;
         white-space: nowrap;
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
 <script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('file/select2/select2.min.js')}}"></script>
<script>
    $(document).ready(function(){
        
            setTimeout(function(){
                $('.success-msg').hide();
            },3000)
            
    });

    var report_date =$('input[name="report_date"]').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            autoclose: true,
        });

    var approve_date =$('input[name="approve_date"]').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            autoclose: true,
        });

    $(document).on("click", ".alert_modal", function(){
        var shop_id = $(this).attr('data-id');
        var report_date = $(this).attr('data-date');
        var approve_type = $(this).attr('approve-type');

        $('#daily_report_id').val(shop_id);
        $('#approve_type').val(approve_type);
        $('#rep_date').val(report_date);
        $('#approve_modal').show();

    });

    $('#close_cross').click(function(){
        $('#approve_modal').hide();
    });

    $('#close_btn').click(function(){
        $('#approve_modal').hide();
    });

    $('#fuel_shop_id').select2({
        allowClear: true,
        placeholder: '--စက်သုံးဆီ အရောင်းဆိုင်--'
    });
</script>

@stop

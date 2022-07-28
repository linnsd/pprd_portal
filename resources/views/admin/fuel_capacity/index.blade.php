@extends('adminlte::page')

@section('title', 'စက်သုံးဆီ သိုလှောင်နိုင်မှု')

@section('content_header')

    <h1 class="unicode">စက်သုံးဆီ သိုလှောင်နိုင်မှု</h1>

@stop

@section('content')
    <div class="page_body">
        <div class="success-msg">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif
        </div>

        <div class="row">
            <?php
                $keyword = (isset($_GET['keyword']))?$_GET['keyword']:''; 
                $sd_id = (isset($_GET['sd_id']))?$_GET['sd_id']:''; 
                $tsh_id = (isset($_GET['tsh_id']))?$_GET['tsh_id']:'';
            ?>
            <form action="{{ url('admin/shop_fuel_capacity') }}" method="get" accept-charset="utf-8" class="form-horizontal">
                <div class="row"> 
                    @if(auth()->user()->role_id==1)
                     <div class="col-md-3">
                       <select name="sd_id" class="form-control" id="sd_id">
                           <option value="">တိုင်းဒေသကြီး/ပြည်နယ် ရွေးချယ်ရန်</option>
                           @foreach(App\Helper\Helpers::state_divisions() as $sd)
                            <option value="{{ $sd->id}}" {{ ($sd_id==$sd->id)?'selected':'' }}>{{ $sd->sd_name }}</option>
                           @endforeach
                       </select>
                    </div>
                    @else
                    <div class="col-md-2">
                       <select name="sd_id" class="form-control" id="sd_id">
                          
                           @foreach(App\Helper\Helpers::state_divisions() as $sd)
                             @if(auth()->user()->sd_id==$sd->id)
                                <option value="{{ $sd->id}}" {{ (auth()->user()->sd_id==$sd->id)?'selected':'' }}>{{ $sd->sd_name }}</option>
                            @endif
                           @endforeach
                       </select>
                    </div>
                    @endif

                    <div class="col-md-2" id="tsh_div" style="display: none;">
                        <select name="tsh_id" id="tsh_id" class="form-control">
                            <option value="">---</option>
                            @foreach(App\Helper\Helpers::townships() as $township)
                            <option value="{{ $township->id }}" {{ ($township->id==$tsh_id)?'selected':'' }}>{{ $township->tsh_name_mm }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <input type="text" name="keyword" class="form-control" value="{{ old('keyword',$keyword) }}" placeholder="ဆိုင်အမည်...">
                    </div>

                    <div class="col-md-1">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-search"></i>ရှာရန်</button>
                    </div>
                    
                </div>
            </form>
             <input type="hidden" id="ctr_token" value="{{ csrf_token()}}">
            <br>
        </div>
     
       <div class="row">
            <div class="row" style="margin-left:10px;">
                @if($shops[0]->fuels[0]->lock_unlock == 0)
                <a href="{{route('admin.lock_unlock_capacity',1)}}" onclick="return confirm('Are you sure you want to unlock?')" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-lock" /></i>Lock</a>
                @else
                
                <a href="{{route('admin.lock_unlock_capacity',0)}}" onclick="return confirm('Are you sure you want to lock?')" class="btn btn-sm btn-success"><i class="fa fa-fw fa-unlock" /></i>UnLock</a>
                @endif

            </div>
            
            <div class="form-group" align="right">
                <a class="btn btn-success" href="{{ route('admin.shop_fuel_capacity.create') }}"><i class="fa fa-fw fa-plus"></i> အသစ်ထည့်ရန်</a>
            </div>
        </div>
        <div class="row">
             <div class="table-responsive">
                <table class="table table-bordered scroll">
                <thead>
                    <tr>
                        <th>စဉ်</th>
                        <th>တိုင်းဒေသကြီး/ပြည်နယ်</th>
                        <th>မြို့နယ်</th>
                        <th>အရောင်းဆိုင်အမည်</th>
                        <th style="text-align:center;">စက်သုံးဆီအမျိုးအစား</th>
                        <th>သိုလှောင်နိုင်မှု</th>
                        <th>လက်ကျန်</th>
                        <th>ပျမ်းမျှအရောင်း</th>
                    </tr>
                </thead>
              
               
                <tbody style="overflow-x:auto;">
                    @foreach($shops as $key=>$shop)
                    @if($shop->fuels->count() > 0)
                    <tr>
                    <td rowspan="{{$shop->fuels->count() + 1}}">{{++$key}}</td>
                    <td rowspan="{{$shop->fuels->count() + 1}}">{{$shop->sd_name}}</td>
                    <td rowspan="{{$shop->fuels->count() + 1}}">{{$shop->tsh_name_mm}}</td>
                    <td rowspan="{{$shop->fuels->count() + 1}}">{{$shop->shopName}}</td>
                    </tr>

                    @foreach($shop->fuels as $fuel)
                      <tr>
                        <td style="text-align:center;">
                           {{$fuel->f_type->fuel_type}}
                        </td>
                        <td style="text-align: right;">
                            @if($fuel->lock_unlock == 1)
                                {{number_format($fuel->max_capacity)}}
                            @else
                                <a href="" data-date="" style="color:black" class="update" data-name="max_capacity" data-type="text" data-pk="" data-fuel="{{ $fuel->id}}">{{number_format($fuel->max_capacity)}}</a>
                            @endif
                             

                            </td>
                        <td style="text-align:right;">
                            @if($fuel->lock_unlock == 1)
                                {{number_format($fuel->opening_balance)}}
                            @else
                                <a href="" data-date="" style="color:black" class="update" data-name="opening_balance" data-type="text" data-pk="" data-fuel="{{ $fuel->id}}">{{number_format($fuel->opening_balance)}}</a>
                            @endif
                             

                            </td>
                        <td style="text-align:right;">
                             @if($fuel->lock_unlock == 1)
                                {{number_format($fuel->avg_balance)}}
                             @else
                                <a href="" data-date="" style="color:black" class="update" data-name="avg_balance" data-type="text" data-pk="" data-fuel="{{ $fuel->id}}"> {{number_format($fuel->avg_balance)}}</a>
                             @endif
                             

                           </td>
                      </tr>
                  @endforeach
                  @endif
                 
                 @endforeach
            </tbody>
             
            </table>
            <div align="center">
                <?php 
                $count = 0;
                    foreach ($shops as $key => $record) {
                        if ($record->fuels->count() > 0) {
                            $count ++;
                        }
                    }
                 ?>
                <p style="color: black">Total - {{$count}}</p>
            </div>
            </div>
            {{ $shops->appends(request()->input())->links()}}
        </div>
       
    </div>
      
@stop



@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">

<link href="{{asset('file/bootstrap-editable.css')}}" rel="stylesheet"/>

 <style type="text/css" media="screen">
    
    .page_body{
        margin: 10px;
    }
     /* CHANGES */
    .dropdown-menu,.dropdown-toggle{
        min-width:100px;
    }
    .dropdown-menu>li>a{
      padding: 3px 5px 3px 0;
    }
    .switch {
      position: relative;
      display: inline-block;
      width: 45px;
      height: 22px;
    }

    .switch input { 
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 15px;
      width: 15px;
      left: 2px;
      bottom: 0px;
      top:3px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 36px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
 </style>
   
@stop



@section('js')
<script src="{{asset('file/bootstrap-editable.min.js')}}"></script>

<script>
    $(document).ready(function(){
        var sd_id_val  = $('#sd_id').val();

        if(sd_id_val!=''){
             $('#tsh_div').css('display','block');
             getTownshipByStateDivision(sd_id_val) 
        }else{
             $('#tsh_div').css('display','none');
        }

    });

    $('#sd_id').change(function(){
        $('#tsh_div').css('display','block');
            getTownshipByStateDivision($(this).val());
    });

    $('#export_btn').click(function(){
            $('#excel_form').submit();
        });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    }); 

    $('.update').editable({
           url: "{{ route('admin.number_update') }}",
           type: 'text',
           pk: 1,
           name: 'temp',
           title: '',

           params: function(params) {
            // console.log(params);
            // add additional params from data-attributes of trigger element

            params.fuel_id = $(this).editable().data('fuel');
            
            return params;

            },

            success: function(response, newValue) {
                console.log(response.data);
                // $('#net_pay_'+response.data.id).text(response.data.netpay);

            }
    });

   function getTownshipByStateDivision($id) {
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            $.ajax({
                url : $baseurl+'getTownshipByStateDivision',
                dataType : 'html',
                method : 'post',
                data : {
                        'state_division_id' : $id,
                        '_token': $('#ctr_token').val()
                },
                success : function(data){
                    $('#township_id').html(data);
                    if(data==""){
                        $('#township_id').html('<option value="">Select Township</option>');
                    }
                },
                error : function(error){
                    console.log(error);
                }
            });
    }

    $("document").ready(function(){
            setTimeout(function(){
                $("div.alert-success").remove();
            }, 3000 ); // 3 secs
        });
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0; 
                var shop_id = $(this).data('id'); 
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "<?php echo(route("admin.change_shop_status")) ?>",
                    data: {'status': status, 'shop_id': shop_id},
                    success: function(data){
                     console.log(data.success);
                    }
                });
            })
  })
    
</script>

@stop

@extends('adminlte::page')

@section('title', 'Report မတင်ရသေးသောဆိုင်များ')

@section('content_header')

    <h1 class="unicode">Report မတင်ရသေးသောဆိုင်များ</h1>

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
                $keyword = (isset($_GET['keyword']))?$_GET['keyword']:'';
                $sd_id = (isset($_GET['sd_id']))?$_GET['sd_id']:'';
                $tsh_id = (isset($_GET['tsh_id']))?$_GET['tsh_id']:'';
                $from_date = (isset($_GET['from_date']))?$_GET['from_date']:date('d-m-Y');
                $to_date = (isset($_GET['to_date']))?$_GET['to_date']:date('d-m-Y');
            ?>
            <form action="{{ url('admin/no_report_shops') }}" method="get" accept-charset="utf-8" class="form-horizontal">
                <div class="row">
                    <div class="col-md-2">
                        <input type="text" name="keyword" class="form-control" value="{{ old('keyword',$keyword) }}" placeholder="Search..">
                    </div>

                     <div class="col-md-2">
                     <button type="button" class="btn btn-warning "  data-toggle="modal" data-target="#filter_modal" style="font-size: 13px"><i class="fa fa-filter" aria-hidden="true"></i></button>
                  </div>
                </div>


            </form>


         
        </div>
       
       <div class="modal" id="filter_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-md">
              <!-- Modal content-->
              <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title">More Filter...</h5>
                    <button style="float:right;" type="button" id="close_cross" data-dismiss="modal">&times;</button>
                 </div>
                 <div class="modal-body">
                <form action="{{ url('admin/no_report_shops') }}" method="get" accept-charset="utf-8" class="form-horizontal">
                <div class="row form-group">
                   
                    <div class="col-md-6">
                       <label>တိုင်းဒေသကြီး/ပြည်နယ် ရွေးချယ်ရန်</label>
                       <select class="form-control" id="sd_id" name="sd_id">
                            <option value="">တိုင်းဒေသကြီး</option>
                            @foreach(App\Helper\Helpers::state_divisions() as $key=>$state_division)
                            <option value="{{$state_division->id}}" {{$state_division->id == $sd_id ? 'selected' : ''}}>{{$state_division->sd_name}}</option>
                            @endforeach
                        </select>
                    </div>
                   

                    <div class="col-md-6">
                        <label>မြို့နယ် ရွေးချယ်ရန်</label>
                        <select class="form-control" id="tsh_id" name="tsh_id" style="width:100%">
                            <option value="">မြို့နယ်များ</option>
                            @foreach(App\Helper\Helpers::townships() as $key=>$township)
                            <option value="{{$township->id}}" {{$tsh_id == $township->id ? 'selected' : ''}}>{{$township->tsh_name_mm}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <label>From Date</label>
                        <input type="text" name="from_date" id="from_date" class="form-control" value="{{ old('from_date',$from_date) }}">
                    </div>
                    <div class="col-md-6">
                        <label>To Date</label>
                        <input type="text" name="to_date" id="to_date" class="form-control" value="{{ old('to_date',$to_date) }}">
                    </div>
                </div>
               
                <div class="row form-group">
                    <div class="col-md-4"></div>
                      <div class="col-md-6">
                         <button type="button" class="btn btn-danger my-2" data-dismiss="modal" id="close_btn">Cancel</button>
                         <button type="submit" class="btn btn-primary my-2">Search</button>
                      </div>
                </div>
            </form>
        </div>
                 
              </div>
           </div>
        </div>
      <br>
        <div class="table-responsive" style=" display: block;overflow-x: auto;white-space: nowrap;">
            <table class="table table-bordered scroll">
                <thead  style=" background-color: #605ca8;
            color: white;">
                    <tr>
                        <th>စဉ်</th>
                        <th>အရောင်းဆိုင်အမည်/မြို့နယ်</th>
                        <th>စက်သုံးဆီအမျိုးအစား</th>
                        <th>သိုလှောင်နိုင်မှု</th>
                        <th>လက်ကျန်</th>
                        <th>တစ်ရက်ပျမ်းမျှအရောင်း</th>
                        <th>ရောင်းချနိုင်မည့်ရက်</th>
                    </tr>
                </thead>
                <tbody style="overflow-x:auto;">
                    @foreach($no_reports as $key=>$record)
                    <tr> 
                    <td rowspan="{{$record->fuel_list->count() + 1}}">{{++$key}}</td>
                    <td rowspan="{{$record->fuel_list->count() + 1}}">
                        @if($record->tsh_name_mm != null)
                            {{$record->shopName}}/{{$record->tsh_name_mm}}
                        @else
                            {{$record->shopName}}
                       @endif
                    </td>
                   
                    @foreach($record->fuel_list as $fuel)
                      <tr>
                        <td style="text-align:center;">
                           {{$fuel->f_type->fuel_type}}
                        </td>
                        <td style="text-align: right;">
                             {{number_format($fuel->max_capacity)}}
                        </td>
                        <td style="text-align:right;">
                            {{number_format($fuel->opening_balance)}}

                            </td>
                        <td style="text-align:right;">
                             {{number_format($fuel->avg_balance)}}

                           </td>
                           <td style="text-align:right;">
                            
                                <?php 
                                if ($fuel->opening_balance != 0 && $fuel->avg_balance != 0) {
                                    $day = $fuel->opening_balance / $fuel->avg_balance;
                                }else{
                                    $day = 0;
                                }
                                    
                                 ?>
                                {{number_format($day)}}

                           </td>
                           
                      </tr>
                  @endforeach
                </tr>   
               @endforeach
                </tbody>
            </table>
            {!! $no_reports->appends(request()->input())->links() !!}
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

    var from_date =$('input[name="from_date"]').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            autoclose: true,
        });

    var to_date =$('input[name="to_date"]').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            autoclose: true,
        });

    $('#tsh_id').select2({
        allowClear: true,
        placeholder: '--မြို့နယ်များ--'
    });
</script>

@stop

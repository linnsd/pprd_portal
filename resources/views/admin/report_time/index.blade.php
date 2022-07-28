@extends('adminlte::page')

@section('title', 'Report Time')

@section('content_header')

    <h1 class="unicode">Report Time</h1>

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

        @can('shop-create')
            @can('dio-full-permission')
            <div class="row">
                <div class="form-group" align="right">
                    <a class="btn btn-success" href="{{ route('admin.report_times.create') }}"><i class="fa fa-fw fa-plus"></i>Report Timeထည့်ရန်</a>
                </div>
            </div>
            
            @endcan
        @endcan
      <div class="row">
            <?php
                $keyword = (isset($_GET['keyword']))?$_GET['keyword']:''; 
            ?>
            <form action="{{ url('admin/report_times') }}" method="get" accept-charset="utf-8" class="form-horizontal">
                <div class="row">
                    <div class="col-md-2">
                        <input type="text" name="keyword" class="form-control" value="{{ old('keyword',$keyword) }}" placeholder="Report Time...">
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
             <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                         <tr>
                            <th>Report Time</th>
                            <th>Active Status</th>
                            <th>Minor Status</th>
                            <th style="width: 150px;"></th>
                        </tr>
                    </thead>
                   
                    
                    @foreach ($report_times as $report_time)
                    <tr >
                        <td>
                            {{$report_time->rep_time}}
                        </td>
                        <td>
                            <label class="switch">
                                <input data-id="{{$report_time->id}}" data-size ="small" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $report_time->active_status ? 'checked' : '' }}>
                              <span class="slider round"></span>
                              </label>
                        </td>
                         <td>
                            <label class="switch">
                                <input data-id="{{$report_time->id}}" data-size ="small" class="minor_status" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $report_time->shop_type ? 'checked' : '' }}>
                              <span class="slider round"></span>
                              </label>
                        </td>
                        <td>

                            <form action="{{ route('admin.report_times.destroy',$report_time->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                                @csrf
                                @method('DELETE')
                               <a href="{{route('admin.report_times.edit',$report_time->id)}}" title="ပြင်ရန်" class="btn btn-sm btn-info edit"><i class="fa fa-fw fa-edit" /></i></a>

                                <button class="btn btn-sm btn-danger" type="submit" title="ဖျက်ရန်" ><i class="fa fa-fw fa-trash" /></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div align="center">
                    <p style="color: black">Total - {{  $count }}</p>
                </div>
                
            </div>
            {{ $report_times->appends(request()->input())->links()}}
        </div>
       
    </div>
      
@stop



@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
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

<script>
    

    $("document").ready(function(){
            setTimeout(function(){
                $("div.alert-success").remove();
            }, 3000 ); // 3 secs
        });
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0; 
                var rep_time_id = $(this).data('id'); 
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "<?php echo(route("admin.report_time_status")) ?>",
                    data: {'status': status, 'rep_time_id': rep_time_id},
                    success: function(data){
                     
                    }
                });
            })
  });

        $(function() {
            $('.minor_status').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0; 
                var rep_time_id = $(this).data('id'); 
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "<?php echo(route("admin.change_minor_status")) ?>",
                    data: {'status': status, 'rep_time_id': rep_time_id},
                    success: function(data){
                     
                    }
                });
            })
  });

        
    
</script>

@stop

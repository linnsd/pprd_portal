@extends('adminlte::page')

@section('title', 'Report Time')

@section('content_header')

    <h4>Report Time ထည့်သွင်းရန်</h4><br>

@stop

@section('content')
<div class="container">
    <div class="panel-body">
        <form action="{{route('admin.report_times.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf
         
            <div class="row form-group">
                <div class="col-md-6">
                    
                    <div class="row">
                        <div class="form-group">
                            <label for="time">Report Time</label>
                              <div class="input-group date col-md-8" id="timePicker">
                                <input type="text" name="rep_time" class="form-control timePicker">
                                <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                              </div>
                        </div>
                    </div>
                 
                </div>              
                <div class="col-md-6">
                    
                </div>  
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary" href="{{ route('admin.report_times.index') }}"><i  class="fa fa-fw fa-arrow-left"></i>  နောက်သို့</a>
                        <button type="submit" class="btn btn-success"><i  class="fa fa-fw fa-floppy-o"></i>သိမ်းမည်</button>
                    </div>
                </div>
            </div>
           
        </form>
        <input type="hidden" id="ctr_token" value="{{ csrf_token()}}">
    </div>
</div>
@stop



@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('file/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('file/font-awesome.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('file/bootstrap-datetimepicker.min.css')}}">

<style type="text/css" media="screen">
  
</style>
   
@stop



@section('js')
<script type="text/javascript" src="{{asset('file/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('file/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('file/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('file/bootstrap-datetimepicker.min.js')}}"></script>
<script>
var firstOpen = true;
var time;

$('#timePicker').datetimepicker({
  useCurrent: false,
  format: "hh:mm A"
}).on('dp.show', function() {
  if(firstOpen) {
    time = moment().startOf('day');
    firstOpen = false;
  } else {
    time = "01:00 PM"
  }
  
  $(this).data('DateTimePicker').date(time);
});
</script>

@stop
@extends('adminlte::page')

@section('title', 'အကြောင်းကြားစာများ')

@section('content_header')

    <h4>အကြောင်းကြားစာများ</h4><br>

@stop

@section('content')
<div class="container">
    <div class="panel-body">
       
            <div class="row form-group">
                <div class="col-md-6">

                    <div class="row form-group">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ပုံ</label>
                             <div class="col-md-8">
                              
                                <img src="{{asset($notification->path.$notification->photo)}}" style="width:100px;height: 100px;">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">အကြောင်းကြားချက်*</label>
                             <div class="col-md-8">
                                <input type="text" placeholder="အကြောင်းကြားချက်" name="title" value="{{$notification->title}}" readonly class="form-control">

                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ဖော်ပြချက်</label>
                            <div class="col-md-8">
                                <textarea class="form-control" placeholder="ဖော်ပြချက်" id="description" name="description" readonly>{{$notification->description}}</textarea>
                            </div>
                        </div>
                        
                    </div>

                     <div class="row form-group">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">အကြောင်းကြားသည့်ရက်*</label>
                             <div class="col-md-8">
                                <input type="text" name="publish_date" id="publish_date" value="{{date('d-m-Y',strtotime($notification->publish_date))}}" class="form-control" placeholder="{{date('d-m-Y')}}" required disabled>

                            </div>
                        </div>
                    </div>

                </div>              
                <div class="col-md-6">
                    
                </div>  
            </div>
            <div class="row">
                <div class="form-group  text-center">
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary" href="{{ route('admin.notifications.index') }}"><i  class="fa fa-fw fa-arrow-left"></i>  နောက်သို့</a>
                       
                    </div>
                </div>
            </div>
         
    </div>
</div>
@stop



@section('css')
<link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.css') }}"/>
<style type="text/css" media="screen">
  .error_msg{
    color: #DD4B39;
  }
  .has-error input{
    border-color: #DD4B39;
  }
</style>
   
@stop



@section('js')
    
<script src="{{asset('js/select2.min.js')}}"></script>
 <script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>

<script>
// arrival_date
var publish_date=$('input[name="publish_date"]').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            autoclose: true,
        });

var received_date=$('input[name="received_date"]').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            autoclose: true,
        });

$('#f_shop_id').select2({
        allowClear: true,
        placeholder: '--စက်သုံးဆီ အရောင်းဆိုင်--'
    });
</script>

@stop
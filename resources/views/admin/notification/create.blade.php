@extends('adminlte::page')

@section('title', 'အကြောင်းကြားစာများ')

@section('content_header')

    <h4>အကြောင်းကြားစာများ</h4><br>

@stop

@section('content')
<div class="container">
    <div class="panel-body">
        <form action="{{route('admin.notifications.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf
         
            <div class="row form-group">
                <div class="col-md-6">
                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">Noti Type</label>
                             <div class="col-md-8">
                                <select class="form-control" id="noti_type" name="noti_type">
                                    <option value="">All</option>
                                    <option value="1">မြို့နယ်</option>
                                    <option value="2">ဆိုင်</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="township">
                        <div class="form-group">
                            <label class="form-label col-md-4">မြို့နယ်များ</label>
                            <div class="col-md-8">
                                <select class="form-control" id="tsh_id" name="tsh_id[]" multiple style="width:100%;">
                                    @foreach(App\Helper\Helpers::townships() as $key=>$township)
                                    <option value="{{$township->id}}">{{$township->tsh_name_mm}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="shops">
                        <div class="form-group">
                            <label class="form-label col-md-4">ဆိုင်များ</label>
                            <div class="col-md-8">
                                <select class="form-control" id="shop_id" name="shop_id[]" multiple style="width:100%;">
                                    @foreach(App\Helper\Helpers::fuel_shops() as $key=>$fuel_shop)
                                    <option value="{{$fuel_shop->id}}">{{$fuel_shop->shopName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ပုံ</label>
                             <div class="col-md-8">
                                <input type="file" placeholder="" name="photo" value="" class="form-control">

                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">အကြောင်းကြားချက်*</label>
                             <div class="col-md-8">
                                <input type="text" placeholder="အကြောင်းကြားချက်" name="title" value="" required class="form-control">

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ဖော်ပြချက်</label>
                            <div class="col-md-8">
                                <textarea class="form-control" placeholder="ဖော်ပြချက်" id="description" name="description"></textarea>
                            </div>
                        </div>
                        
                    </div>

                     <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">အကြောင်းကြားသည့်ရက်*</label>
                             <div class="col-md-8">
                                <input type="text" name="publish_date" id="publish_date" value="" class="form-control" placeholder="{{date('d-m-Y')}}" required>

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
                        <a class="btn btn-primary" href="{{ route('admin.pre_shops.index') }}"><i  class="fa fa-fw fa-arrow-left"></i>  နောက်သို့</a>
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
<link rel="stylesheet" href="{{ asset('select2/css/select2.min.css') }}"/>

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
   .select2-container--default .select2-selection--single .select2-selection_ {
   height: 30px;
   position: absolute;
   top: 2px;
   right: 0px;
   left: 365px;
   width: 100px; 
   }
   .select2-container--default .select2-selection--multiple .select2-selection__choice {
   color: black;
   }
</style>
   
@stop



@section('js')
    
<script type="text/javascript" src="{{ asset('select2/js/select2.min.js') }}"></script>
 <script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>

<script>
// arrival_date
var publish_date=$('input[name="publish_date"]').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            autoclose: true,
        });

$('#tsh_id').select2({
        allowClear: true,
        placeholder: '--မြို့နယ်ရွေးချယ်ရန်--',
    });

$('#shop_id').select2({
        allowClear: true,
        placeholder: '--ဆိုင်ရွေးချယ်ရန်--',
    });

$('#township').hide();
$('#shops').hide();

$('#noti_type').change(function(){
    var noti_type = $(this).val();
    if (noti_type == 1) {
        $('#township').show();
        $('#shops').hide();
    }

    if (noti_type == 2) {
        $('#township').hide();
        $('#shops').show();
    }
});
</script>

@stop
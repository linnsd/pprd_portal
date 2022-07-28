@extends('adminlte::page')

@section('title', 'ကြိုတင်မှာယူမှု ထည့်သွင်းရန်')

@section('content_header')

    <h4>ကြိုတင်မှာယူမှု ထည့်သွင်းရန်</h4><br>

@stop

@section('content')
<div class="container">
    <div class="panel-body">
        <form action="{{route('admin.pre_shops.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf
         
            <div class="row form-group">
                <div class="col-md-6">
                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">စက်သုံးဆီ အရောင်းဆိုင် *</label>
                             <div class="col-md-8">
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
                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">Terminal*</label>
                             <div class="col-md-8">
                               
                                <select class="form-control" id="terminal_id" name="terminal_id" style="width:100%;" required>
                                    <option value="">Select Terminal</option>
                                    @foreach(App\Helper\Helpers::terminals() as $terminal)
                                    <option value="{{$terminal->id}}">{{$terminal->company_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">မှာယူထားသည့် ကုမ္ပဏီ*</label>
                             <div class="col-md-8">
                                <input type="text" placeholder="ABC Co Ltd.," name="pre_company" value="" required class="form-control">

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4"> စက်သုံးဆီ အမျိုးအစား*</label>
                             <div class="col-md-8">

                                <select class="form-control" name="fuel_type">
                                    <option value="">စက်သုံးဆီ အမျိုးအစား</option>
                                    @foreach(App\Helper\Helpers::fuel_types() as $fuel_type)
                                    <option value="{{$fuel_type->id}}">{{$fuel_type->fuel_type}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">မှာယူထားသည့်ပမာဏ*</label>
                             <div class="col-md-8">
                                <input type="text" placeholder="120000" name="pre_capacity" value="" required class="form-control">

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ယာဉ်အမှတ်*</label>
                             <div class="col-md-8">
                              
                               <div class="col-md-3">
                                    <select class="form-control" id="prefix_number" name="prefix_number">
                                            <option value="">No</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                        </select>

                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" id="prefix_code" name="prefix_code">
                                            <option value="">Character</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>
                                            <option value="F">F</option>
                                            <option value="G">G</option>
                                            <option value="H">H</option>
                                            <option value="I">I</option>
                                            <option value="J">J</option>
                                            <option value="K">K</option>
                                            <option value="L">L</option>
                                            <option value="M">M</option>
                                            <option value="N">N</option>
                                            <option value="O">O</option>
                                            <option value="P">P</option>
                                            <option value="Q">Q</option>
                                            <option value="R">R</option>
                                            <option value="S">S</option>
                                            <option value="T">T</option>
                                            <option value="U">U</option>
                                            <option value="V">V</option>
                                            <option value="W">W</option>
                                            <option value="X">X</option>
                                            <option value="Y">Y</option>
                                            <option value="Z">Z</option>
                                            
                                        </select>

                                </div>
                                <div class="col-md-5">
                                  <input type="number" name="bowser_no" id="bowser_no" class="form-control" placeholder="1234">
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ရောက်ရှိမည့်ရက်*</label>
                             <div class="col-md-8">
                                <input type="text" name="arrival_date" id="arrival_date" value="" class="form-control" placeholder="{{date('d-m-Y')}}" required>

                            </div>
                        </div>
                    </div>

                    

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ရောက်ရှိနေသည့်အခြေအနေ*</label>
                             <div class="col-md-8">
                               <select class="form-control" id="pre_status" name="pre_status">
                                   <option value="">Pre Order</option>
                                   <option value="1">Received</option>
                                   <option value="2">Cancel</option>
                               </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">လက်ခံရရှိသည့်ရက်</label>
                             <div class="col-md-8">
                                <input type="text" name="received_date" placeholder="{{date('d-m-Y')}}" id="received_date" value="" class="form-control">

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">မှတ်ချက်</label>
                            <div class="col-md-8">
                                <textarea class="form-control" placeholder="remark" id="pre_remark" name="pre_remark"></textarea>
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
var arrival_date=$('input[name="arrival_date"]').datepicker({
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

$('#terminal_id').select2({
        allowClear: true,
        placeholder: '--သိုလှောင်ကန်စခန်း--'
    });

$('#bowser_no').select2({
        allowClear: true,
        placeholder: '--ဘောက်စာနံပါတ်--'
    });

</script>

@stop
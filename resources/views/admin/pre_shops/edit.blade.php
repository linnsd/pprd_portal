@extends('adminlte::page')

@section('title', 'ကြိုတင်မှာယူမှု ထည့်သွင်းရန်')

@section('content_header')

    <h4>ကြိုတင်မှာယူမှု ထည့်သွင်းရန်</h4><br>

@stop

@section('content')
<div class="container">
    <div class="panel-body">
        <form action="{{route('admin.pre_shops.update',$edit_data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row form-group">
                <div class="col-md-6">
                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">စက်သုံးဆီ အရောင်းဆိုင် *</label>
                             <div class="col-md-8">
                                <select style="width:370px;" name="f_shop_id" id="f_shop_id" class="form-control" required> 
                                    <option value="">--စက်သုံးဆီ အရောင်းဆိုင်--</option>
                                    @foreach(App\Helper\Helpers::fuel_shops() as $fuel_shop)
                                    <option value="{{$fuel_shop->id}}" {{$edit_data->pre_shop_id == $fuel_shop->id ? 'selected' : ''}}>{{$fuel_shop->shopName}}</option>
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
                                <select class="form-control" id="terminal_id" name="terminal_id" style="width:370px;" required>
                                    <option value="">Select Terminal</option>
                                    @foreach(App\Helper\Helpers::terminals() as $terminal)
                                    <option value="{{$terminal->id}}" {{$edit_data->terminal == $terminal->id ? 'selected' : ''}}>{{$terminal->company_name}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">မှာယူထားသည့် ကုမ္ပဏီ*</label>
                             <div class="col-md-8">
                                <input type="text" placeholder="ABC Co Ltd.," name="pre_company" value="{{$edit_data->pre_comp_name}}" required class="form-control">

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
                                        <option value="{{$fuel_type->id}}" {{ (old('fuel_tpye',$fuel_type->id)==$edit_data->pre_fuel_type)?'selected':'' }}>{{$fuel_type->fuel_type}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">မှာယူထားသည့်ပမာဏ*</label>
                             <div class="col-md-8">
                                <input type="text" placeholder="120000" name="pre_capacity" value="{{$edit_data->pre_capacity}}" required class="form-control">

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
                                            <option value="1" {{$edit_data->bowser_pre_no == 1 ? 'selected' : ''}}>1</option>
                                            <option value="2" {{$edit_data->bowser_pre_no == 2 ? 'selected' : ''}}>2</option>
                                            <option value="3" {{$edit_data->bowser_pre_no == 3 ? 'selected' : ''}}>3</option>
                                            <option value="4" {{$edit_data->bowser_pre_no == 4 ? 'selected' : ''}}>4</option>
                                            <option value="5" {{$edit_data->bowser_pre_no == 5 ? 'selected' : ''}}>5</option>
                                            <option value="6" {{$edit_data->bowser_pre_no == 6 ? 'selected' : ''}}>6</option>
                                            <option value="7" {{$edit_data->bowser_pre_no == 7 ? 'selected' : ''}}>7</option>
                                            <option value="8" {{$edit_data->bowser_pre_no == 8 ? 'selected' : ''}}>8</option>
                                            <option value="9" {{$edit_data->bowser_pre_no == 9 ? 'selected' : ''}}>9</option>
                                        </select>

                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" id="prefix_code" name="prefix_code">
                                            <option value="">Character</option>
                                            <option value="A" {{$edit_data->bowser_pre_char == "A" ? 'selected' : ''}}>A</option>
                                            <option value="B" {{$edit_data->bowser_pre_char == "B" ? 'selected' : ''}}>B</option>
                                            <option value="C" {{$edit_data->bowser_pre_char == "C" ? 'selected' : ''}}>C</option>
                                            <option value="D" {{$edit_data->bowser_pre_char == "D" ? 'selected' : ''}}>D</option>
                                            <option value="E" {{$edit_data->bowser_pre_char == "E" ? 'selected' : ''}}>E</option>
                                            <option value="F" {{$edit_data->bowser_pre_char == "F" ? 'selected' : ''}}>F</option>
                                            <option value="G" {{$edit_data->bowser_pre_char == "G" ? 'selected' : ''}}>G</option>
                                            <option value="H" {{$edit_data->bowser_pre_char == "H" ? 'selected' : ''}}>H</option>
                                            <option value="I" {{$edit_data->bowser_pre_char == "I" ? 'selected' : ''}}>I</option>
                                            <option value="J" {{$edit_data->bowser_pre_char == "J" ? 'selected' : ''}}>J</option>
                                            <option value="K" {{$edit_data->bowser_pre_char == "K" ? 'selected' : ''}}>K</option>
                                            <option value="L" {{$edit_data->bowser_pre_char == "L" ? 'selected' : ''}}>L</option>
                                            <option value="M" {{$edit_data->bowser_pre_char == "M" ? 'selected' : ''}}>M</option>
                                            <option value="N" {{$edit_data->bowser_pre_char == "A" ? 'selected' : ''}}>N</option>
                                            <option value="O" {{$edit_data->bowser_pre_char == "O" ? 'selected' : ''}}>O</option>
                                            <option value="P" {{$edit_data->bowser_pre_char == "P" ? 'selected' : ''}}>P</option>
                                            <option value="Q" {{$edit_data->bowser_pre_char == "Q" ? 'selected' : ''}}>Q</option>
                                            <option value="R" {{$edit_data->bowser_pre_char == "R" ? 'selected' : ''}}>R</option>
                                            <option value="S" {{$edit_data->bowser_pre_char == "S" ? 'selected' : ''}}>S</option>
                                            <option value="T" {{$edit_data->bowser_pre_char == "T" ? 'selected' : ''}}>T</option>
                                            <option value="U" {{$edit_data->bowser_pre_char == "U" ? 'selected' : ''}}>U</option>
                                            <option value="V" {{$edit_data->bowser_pre_char == "V" ? 'selected' : ''}}>V</option>
                                            <option value="W" {{$edit_data->bowser_pre_char == "W" ? 'selected' : ''}}>W</option>
                                            <option value="X" {{$edit_data->bowser_pre_char == "X" ? 'selected' : ''}}>X</option>
                                            <option value="Y" {{$edit_data->bowser_pre_char == "Y" ? 'selected' : ''}}>Y</option>
                                            <option value="Z" {{$edit_data->bowser_pre_char == "Z" ? 'selected' : ''}}>Z</option>
                                            
                                        </select>

                                </div>
                                <div class="col-md-5">
                                  <input type="number" name="bowser_no" id="bowser_no" class="form-control" value="{{$edit_data->car_no}}" placeholder="1234">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ရောက်ရှိမည့်ရက်*</label>
                             <div class="col-md-8">
                                <input type="text" name="arrival_date" id="arrival_date" value="{{date('d-m-Y',strtotime($edit_data->pre_arrival_date))}}" class="form-control" placeholder="{{date('d-m-Y')}}" required>

                            </div>
                        </div>
                    </div>

                    

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ရောက်ရှိနေသည့်အခြေအနေ*</label>
                             <div class="col-md-8">
                               <select class="form-control" id="pre_status" name="pre_status">
                                   <option value="" {{$edit_data->pre_status == "" ? 'selected' : ''}}>Pre Order</option>
                                   <option value="1"  {{$edit_data->pre_status == 1 ? 'selected' : ''}}>Received</option>
                                   <option value="2"  {{$edit_data->pre_status == 2 ? 'selected' : ''}}>Cancel</option>
                               </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">လက်ခံရရှိသည့်ရက်</label>
                             <div class="col-md-8">
                                @if($edit_data->pre_received_date != null)
                                <input type="text" name="received_date" placeholder="{{date('d-m-Y')}}" id="received_date" value="{{date('d-m-Y',strtotime($edit_data->pre_received_date))}}" class="form-control">
                                @else
                                <input type="text" name="received_date" placeholder="{{date('d-m-Y')}}" id="received_date" value="" class="form-control">
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">မှတ်ချက်</label>
                            <div class="col-md-8">
                                <textarea class="form-control" placeholder="remark" id="pre_remark" name="pre_remark">{{$edit_data->pre_remark}}</textarea>
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

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
    
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
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
</script>

@stop
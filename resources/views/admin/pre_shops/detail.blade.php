@extends('adminlte::page')

@section('title', 'ကြိုတင်မှာယူမှု ထည့်သွင်းရန်')

@section('content_header')

    <h4>ကြိုတင်မှာယူမှု ထည့်သွင်းရန်</h4><br>

@stop

@section('content')
<div class="container">
    <div class="panel-body">
     
            <div class="row form-group">
                <div class="col-md-6">
                    <div class="row form-group">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">စက်သုံးဆီ အရောင်းဆိုင် *</label>
                             <div class="col-md-8">
                                <input type="text" name="" class="form-control" value="{{$detail_data->shopName}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">Terminal*</label>
                             <div class="col-md-8">
                                <input type="text" placeholder="Terminal" name="terminal" value="{{$detail_data->company_name}}" readonly class="form-control">

                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">မှာယူထားသည့် ကုမ္ပဏီ*</label>
                             <div class="col-md-8">
                                <input type="text" placeholder="ABC Co Ltd.," name="pre_company" value="{{$detail_data->pre_comp_name}}" readonly class="form-control">

                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4"> စက်သုံးဆီ အမျိုးအစား*</label>
                             <div class="col-md-8">

                                <select class="form-control" name="fuel_type" readonly disabled>
                                    <option value="">စက်သုံးဆီ အမျိုးအစား</option>
                                   @foreach(App\Helper\Helpers::fuel_types() as $fuel_type)
                                        <option value="{{$fuel_type->id}}" {{ (old('fuel_tpye',$fuel_type->id)==$detail_data->pre_fuel_type)?'selected':'' }}>{{$fuel_type->fuel_type}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">မှာယူထားသည့်ပမာဏ*</label>
                             <div class="col-md-8">
                                <input type="text" placeholder="120000" name="pre_capacity" value="{{$detail_data->pre_capacity}}" readonly class="form-control">

                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ယာဉ်အမှတ်*</label>
                             <div class="col-md-8">
                                <input type="text" placeholder="5Q-3448" name="bowser_no" value="{{$detail_data->bowser_no}}" readonly class="form-control">

                            </div>
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ရောက်ရှိမည့်ရက်*</label>
                             <div class="col-md-8">
                                <input type="text" name="arrival_date" id="arrival_date" value="{{date('d-m-Y',strtotime($detail_data->pre_arrival_date))}}" class="form-control" placeholder="{{date('d-m-Y')}}" readonly>

                            </div>
                        </div>
                    </div>

                    

                    <div class="row form-group">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ရောက်ရှိနေသည့်အခြေအနေ*</label>
                             <div class="col-md-8">
                               <select class="form-control" id="pre_status" name="pre_status" readonly disabled>
                                   <option value="" {{$detail_data->pre_status == "" ? 'selected' : ''}}>Pre Order</option>
                                   <option value="1"  {{$detail_data->pre_status == 1 ? 'selected' : ''}}>Received</option>
                                   <option value="2"  {{$detail_data->pre_status == 2 ? 'selected' : ''}}>Cancel</option>
                               </select>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">လက်ခံရရှိသည့်ရက်</label>
                             <div class="col-md-8">
                                @if($detail_data->pre_received_date != null)
                                <input type="text" name="received_date" placeholder="{{date('d-m-Y')}}" id="received_date" value="{{date('d-m-Y',strtotime($detail_data->pre_received_date))}}" class="form-control" readonly>
                                @else
                                <input type="text" name="received_date" placeholder="{{date('d-m-Y')}}" id="received_date" value="" class="form-control" readonly>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">မှတ်ချက်</label>
                            <div class="col-md-8">
                                <textarea class="form-control" placeholder="remark" id="pre_remark" name="pre_remark" readonly>{{$detail_data->pre_remark}}</textarea>
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
                      
                    </div>
                </div>
            </div>
        
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

$('#f_shop_id').select2({
        allowClear: true,
        placeholder: '--စက်သုံးဆီ အရောင်းဆိုင်--'
    });
</script>

@stop
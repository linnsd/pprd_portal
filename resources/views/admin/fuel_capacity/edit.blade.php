@extends('adminlte::page')

@section('title', 'စက်သုံးဆီပမာဏပြင်ဆင်ရန်')

@section('content_header')

    <h4>စက်သုံးဆီပမာဏပြင်ဆင်ရန်</h4><br>

@stop

@section('content')
<div class="container">
    <div class="panel-body">
        <form action="{{ route('admin.shop_fuel_capacity.update',$edit_data->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row form-group">
                <div class="col-md-6">
                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">စက်သုံးဆီ အရောင်းဆိုင် *</label>
                             <div class="col-md-8">
                                <input type="text" name="shop_name" value="{{$edit_data->shopName}}" readonly class="form-control">

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
                                        <option value="1" {{ (old('fuel_tpye',$fuel_type->id)==$edit_data->fuel_type)?'selected':'' }}>{{$fuel_type->fuel_type}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">သိုလှောင်နိုင်မှုပမာဏ*</label>
                             <div class="col-md-8">
                                <input type="text" name="max_capacity" value="{{$edit_data->max_capacity}}" required class="form-control">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4"> စက်သုံးဆီ လက်ကျန်*</label>
                             <div class="col-md-8">
                                <input type="text" name="opening_balance" value="{{$edit_data->opening_balance}}" class="form-control" required>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ပျမ်းမျှရောင်းအား*</label>
                             <div class="col-md-8">
                                <input type="text" name="avg_balance" value="{{$edit_data->avg_balance}}" class="form-control" required>

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
                        <a class="btn btn-primary" href="{{ route('admin.shop_fuel_capacity.index') }}"><i  class="fa fa-fw fa-arrow-left"></i>  နောက်သို့</a>
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

</script>

@stop
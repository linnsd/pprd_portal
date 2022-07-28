@extends('adminlte::page')

@section('title', 'ဆီအမျိုးအစား')

@section('content_header')

    <h4>ဆီအမျိုးအစား ထည့်သွင်းရန်</h4><br>

@stop

@section('content')
<div class="container">
    <div class="panel-body">
        <form action="{{route('admin.fuel_types.update',$fuel_type->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row form-group">
                <div class="col-md-6">
                    
                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ဆီအမျိုးအစား*</label>
                             <div class="col-md-8">
                                <input type="text" placeholder="92 RON" name="fuel_type" value="{{$fuel_type->fuel_type}}" required class="form-control">

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
                        <a class="btn btn-primary" href="{{ route('admin.fuel_types.index') }}"><i  class="fa fa-fw fa-arrow-left"></i>  နောက်သို့</a>
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

<script>

</script>

@stop
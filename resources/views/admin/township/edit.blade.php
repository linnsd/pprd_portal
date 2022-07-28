@extends('adminlte::page')

@section('title', 'မြို့နယ်')

@section('content_header')

    <h1>မြို့နယ်</h1>

@stop

@section('content')
<div class="container">
    <div class="panel-body">
        <form action="{{ route('admin.township.update',$township->id) }}" method="POST" class="form-horizontal">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="form-group {{ $errors->first('sd_id', 'has-error') }}" >
                    <label class="col-md-2">တိုင်းဒေသကြီး/ပြည်နယ်</label>
                    <div class="col-md-5">
                        <select name="sd_id" id="sd_id" class="form-control">
                           <option value="">--တိုင်းဒေသကြီး/ပြည်နယ် ရွေးရန်--</option>
                           @foreach($stdivisions as $sd)
                           <option value="{{ $sd->id }}" {{ (old('sd_id',$township->sd_id)==$sd->id)?'selected':'' }}>{{ $sd->sd_name }}</option>
                           @endforeach
                       </select>
                        {!! $errors->first('sd_id', '<span class="error_msg unicode">:message</span> ') !!}
                    </div>
                   
                </div>

                <div class="form-group {{ $errors->first('tsh_name_en', 'has-error') }}" >
                    <label class="col-md-2">မြို့နယ်အမည်(အင်္ဂလိပ်)</label>
                    <div class="col-md-5">
                         <input type="text" name="tsh_name_en"  value="{{ old('tsh_name_en',$township->tsh_name_en) }}" class="form-control"  placeholder="Pyinmana" >
                        {!! $errors->first('tsh_name_en', '<span class="error_msg unicode">:message</span> ') !!}
                    </div>
                   
                </div>

                <div class="form-group {{ $errors->first('tsh_name_mm', 'has-error') }}" >
                    <label class="col-md-2">မြို့နယ်အမည်(မြန်မာ)</label>
                    <div class="col-md-5">
                         <input type="text" name="tsh_name_mm"  value="{{ old('tsh_name_mm',$township->tsh_name_mm) }}" class="form-control"  placeholder="ပျဉ်းမနား" >
                        {!! $errors->first('tsh_name_mm', '<span class="error_msg unicode">:message</span> ') !!}
                    </div>
                   
                </div>

                <div class="form-group {{ $errors->first('tsh_code', 'has-error') }}" >
                    <label class="col-md-2">မြို့နယ်ကုဒ်</label>
                    <div class="col-md-5">
                         <input type="text" name="tsh_code"  value="{{ old('tsh_code',$township->tsh_code) }}" class="form-control"  placeholder="Example: 01" >
                        {!! $errors->first('name', '<span class="error_msg unicode">:message</span> ') !!}
                    </div>
                   
                </div>
            </div>

             <div class="row">
                <div class="form-group {{ $errors->first('tsh_color', 'has-error') }}" >
                    <label class="col-md-2">ကိုယ်စားပြုအရောင်</label>
                    <div class="col-md-5">
                         <input type="text" id="color-css" data-wcp-format="css" name="tsh_color" class="form-control unicode" placeholder=" Select Color " value="{{ $township->tsh_color }}">
                         <button type="btn" class="btn" style="background-color: {{ $township->tsh_color }}"></button>
                        {!! $errors->first('tsh_color', '<span class="error_msg unicode">:message</span> ') !!}
                    </div>
                   
                </div>
            </div>
            
            
            <div class="row">
                <div class="form-group  text-center">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary" href="{{ route('admin.township.index') }}"> Back</a>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
           
        </form>
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
        .jQWCP-wWidget{
            width: 300px !important;
            height: 200px !important;
        }
  </style>
    <link type="text/css" rel="stylesheet" href="{{ asset('colorpicker/css/wheelcolorpicker.css')}} " />
   
@stop



@section('js')
    <script type="text/javascript" src="{{ asset('colorpicker/js/jquery-2.0.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('colorpicker/js/jquery.wheelcolorpicker-3.0.5.min.js') }} "></script>
    <script type="text/javascript">
        $(function() {
          $('#color-css').wheelColorPicker();
        });
    </script>
@stop
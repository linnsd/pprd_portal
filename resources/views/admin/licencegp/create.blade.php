@extends('adminlte::page')

@section('title', 'လိုင်စင် ထည့်ရန်')

@section('content_header')

    <h4>လိုင်စင် ထည့်ရန်</h4><br>

@stop

@section('content')
<div class="container">
    <div class="panel-body">
        <form action="{{ route('admin.licence_gp.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf

                    <div class="row form-group">
                        <label for="" class="form-label col-md-2">လိုင်စင်အမည်*</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="licence_gp_name" id="licence_gp_name" placeholder="ရေနံထွက်ပစ္စည်းလုပ်ငန်းလိုင်စင်" value="{{ old('licence_gp_name') }}"  />

                            @if ($errors->has('licence_gp_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('licence_gp_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        <label for="" class="form-label col-md-2">Prefix Code*</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="prefix_code" id="prefix_code" placeholder="FS" value="{{ old('prefix_code') }}"  />

                            @if ($errors->has('prefix_code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('prefix_code') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

            <div class="row">
                <div class="form-group  text-center">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary" href="{{ route('admin.licence_gp.index') }}"><i  class="fa fa-fw fa-arrow-left"></i>နောက်သို့</a>
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
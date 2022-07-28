@extends('adminlte::page')

@section('title', 'တိုင်းဒေသကြီး/ပြည်နယ် ထည့်ရန်')

@section('content_header')

    <h4>တိုင်းဒေသကြီး/ပြည်နယ် ထည့်ရန်</h4><br>

@stop

@section('content')
<div class="container">
    <div class="panel-body">
        <form action="{{ route('admin.states-divisons.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf

        
            <div class="row">

                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">တိုင်းဒေသကြီး/ပြည်နယ် *</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="sd_name" id="sd_name" placeholder="နေပြည်တော်" value="{{ old('sd_name') }}"  />

                            @if ($errors->has('sd_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sd_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">အတိုကောက်အမည် *</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="sd_short" id="sd_short" placeholder="NPW" value="{{ old('sd_short') }}"  />

                            @if ($errors->has('sd_short'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sd_short') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">MMR Code *</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="mmr_code" id="mmr_code" placeholder="MMR001" value="{{ old('mmr_code') }}"  />

                            @if ($errors->has('mmr_code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mmr_code') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">ကိုယ်စားပြုအရောင် *</label>
                        <div class="col-md-5">
                             <input type="text" id="color-css" data-wcp-format="css" class="form-control" name="sd_color"  placeholder="#000000" value="{{ old('sd_color') }}"  />
                            @if ($errors->has('sd_color'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sd_color') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="form-group  text-center">
                    <div class="col-md-3"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary" href="{{ route('admin.cars.index') }}"><i  class="fa fa-fw fa-arrow-left"></i>  နောက်သို့</a>
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
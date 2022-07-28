@extends('adminlte::page')

@section('title', 'လိုင်စင် ထည့်ရန်')

@section('content_header')

    <h4>လိုင်စင် ထည့်ရန်</h4><br>

@stop

@section('content')
<div class="container">
    <div class="panel-body">
        <form action="{{ route('admin.licence.update',$licence->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        
            <div class="row">

                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">လိုင်စင်အမည်*</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="licence_name" id="licence_name" placeholder="ရေနံထွက်ပစ္စည်းလုပ်ငန်းလိုင်စင်" value="{{ old('licence_name',$licence->licence_name) }}"/>

                            @if ($errors->has('licence_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('licence_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">လိုင်စင်ကြေး*</label>
                        <div class="col-md-5">
                            <input type="number" class="form-control" name="licence_price" id="licence_price" placeholder="4800000" value="{{ old('licence_price',$licence->licence_price) }}" />

                            @if ($errors->has('licence_price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('licence_price') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">သက်တမ်းတိုးကြေး(၁)၏ ၆၀% *</label>
                        <div class="col-md-5">
                            <input type="number" class="form-control" name="extend_price" id="extend_price" placeholder="2800000" value="{{ old('extend_price',$licence->extend_price) }}"/>

                            @if ($errors->has('extend_price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('extend_price') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">ရက်လွန်ဒဏ်ကြေး*</label>
                        <div class="col-md-5">
                             <input type="number" id="expire_price" data-wcp-format="css" class="form-control" name="expire_price"  placeholder="96000" value="{{ old('expire_price',$licence->expire_price) }}"  />
                            @if ($errors->has('expire_price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('expire_price') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">ပျက်စီး/​ပျောက်ဆုံးမိတ္တူမှန်ကြေး*</label>
                        <div class="col-md-5">
                             <input type="number" id="destroy_price" data-wcp-format="css" class="form-control" name="destroy_price"  placeholder="4800000" value="{{ old('destroy_price',$licence->destroy_price) }}"  />
                            @if ($errors->has('destroy_price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('destroy_price') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">ပိုင်ရှင်လွှဲပြောင်းခြင်း (၁) ၏ ၃ ဆ*</label>
                        <div class="col-md-5">
                             <input type="number" id="change_owner" data-wcp-format="css" class="form-control" name="change_owner"  placeholder="14000000" value="{{ old('change_owner',$licence->change_owner) }}"  />
                            @if ($errors->has('change_owner'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('change_owner') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">သိုလှောင်ပမာဏ ပြင်ဆင်ခြင်း (၁) ၏ ၁၀% *</label>
                        <div class="col-md-5">
                             <input type="number" id="upgrade_storage" data-wcp-format="css" class="form-control" name="upgrade_storage"  placeholder="480000" value="{{ old('upgrade_storage',$licence->upgrade_storage) }}"  />
                            @if ($errors->has('upgrade_storage'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('upgrade_storage') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">အမည်ပြောင်းလဲခြင်း (၁) ၏ ၁၀% *</label>
                        <div class="col-md-5">
                             <input type="number" id="change_name" data-wcp-format="css" class="form-control" name="change_name"  placeholder="480000" value="{{ old('change_name',$licence->change_name) }}"  />
                            @if ($errors->has('change_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('change_name') }}</strong>
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
                        <a class="btn btn-primary" href="{{ route('admin.licence.index') }}"><i  class="fa fa-fw fa-arrow-left"></i>  နောက်သို့</a>
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
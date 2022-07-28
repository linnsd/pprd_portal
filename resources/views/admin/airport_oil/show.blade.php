@extends('adminlte::page')

@section('title', 'လိုင်စင်ခွဲထည့်ရန်')

@section('content_header')

    <h4>လိုင်စင်ခွဲထည့်ရန်</h4><br>

@stop

@section('content')
<div class="container">
    <div class="panel-body">
        <form action="{{ route('admin.airport_oil.update',$airport_oil->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        
            <div class="row">
                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">ကုမ္ပဏီအမည်*</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="company_name" id="company_name" placeholder="ABC Training Co.,Ltd" value="{{ old('company_name',$airport_oil->company_name) }}"  readonly="readonly" />

                            @if ($errors->has('company_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('company_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
               
                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">တိုင်းဒေသကြီး/ပြည်နယ်*</label>
                        <div class="col-md-5">
                          

                           <input type="text" name="sd_id" value="{{$airport_oil->state_division->sd_name}}" readonly="readonly" class="form-control">

                            @if ($errors->has('sd_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sd_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
              

                <div class="row">
                    <div class="form-group">
                        <h5 class="form-label col-md-2">တည်နေရာ*</h5>
                        <div class="col-md-5">
                            <textarea class="form-control" placeholder="သီလဝါဆိပ်ကမ်း အကွက်အမှတ်(၁၇/၁၈-က)
ကျောက်တန်းမြို့နယ်" id="location" name="location" readonly="readonly">{{$airport_oil->location}}</textarea>
                            @if ($errors->has('tsh_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tsh_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">ကုမ္ပဏီမှတ်ပုံတင်အမှတ်*</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="comp_licence_no" id="comp_licence_no" placeholder="0001" value="{{ old('comp_licence_no',$airport_oil->comp_lic_no) }}" readonly="readonly" />

                            @if ($errors->has('comp_licence_no'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('comp_licence_no') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <h5 class="form-label col-md-2">ထုတ်ပေးသည့်ရက်စွဲ*</h5>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="comp_issue_date" id="comp_issue_date"  value="{{ old('comp_issue_date',$airport_oil->comp_issue_date) }}"   placeholder="2020-10-29" readonly="readonly" />

                            @if ($errors->has('comp_issue_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('comp_issue_date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">လိုင်စင်အမှတ်*</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="licence_no" id="licence_no" placeholder="0001" value="{{ old('licence_no',$airport_oil->licence_no) }}" readonly="readonly"/>

                            @if ($errors->has('licence_no'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('licence_no') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <h5 class="form-label col-md-2">ထုတ်ပေးသည့်ရက်စွဲ*</h5>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="issue_date" id="issue_date"  value="{{ old('issue_date',$airport_oil->issue_date) }}"   placeholder="2020-10-29" readonly="readonly"/>

                            @if ($errors->has('issue_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('issue_date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">သိုလှောင်မှုပမာဏ*</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="capacity" id="capacity" placeholder="200" value="{{ old('capacity',$airport_oil->capacity) }}" readonly="readonly"/>

                            @if ($errors->has('capacity'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('capacity') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">အမျိုးအစား*</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="type" id="type" placeholder="200" value="{{ old('type',$airport_oil->type) }}" readonly="readonly" />

                            @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                
            </div>
           
        </form>
        <input type="hidden" id="ctr_token" value="{{ csrf_token()}}">
    </div>
</div>
@stop



@section('css')
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.css') }}"/>
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
    <script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript">
        $(function() {
          $('#color-css').wheelColorPicker();
        });
    </script>
@stop
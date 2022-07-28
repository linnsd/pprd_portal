@extends('adminlte::page')

@section('title', 'သိုလှောင်ကန်စခန်း ထည့်ရန်')

@section('content_header')

    <h4>သိုလှောင်ကန်စခန်း ထည့်ရန်</h4><br>

@stop

@section('content')
<div class="container">
    <div class="panel-body">
        <form action="{{ route('admin.terminal.update',$terminal->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        
            <div class="row">
                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">ကုမ္ပဏီအမည်*</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="company_name" id="company_name" placeholder="ABC Training Co.,Ltd" value="{{ old('company_name',$terminal->company_name) }}"  />

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
                        <label for="" class="form-label col-md-2">နိုင်ငံသားစိစစ်ရေးကဒ်ပြားအမှတ်</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="nrc" id="nrc" placeholder="9/PAMANA(N)111111" value="{{ old('nrc',$terminal->nrc) }}"  />

                            @if ($errors->has('nrc'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nrc') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">တိုင်းဒေသကြီး/ပြည်နယ်*</label>
                        <div class="col-md-5">
                           <select class="form-control" name="sd_id" id="sd_id">
                               <option value="">တိုင်းဒေသကြီး/ပြည်နယ်</option>
                               @foreach($statedivisions as $sd)
                                <option value="{{ $sd->id }}"
                                        {{ old('sd_id', $terminal->sd_id) == $sd->id ? 'selected' : '' }}>
                                        {{ $sd->sd_name }}
                                    </option>
                               @endforeach
                           </select>

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
                        <h5 class="form-label col-md-2">မြို့နယ်*</h5>
                        <div class="col-md-5">
                           <select name="tsh_id" id="tsh_id" class="form-control ctr_township">
                            
                                <option>--Select--</option>
                                @foreach($townships as $township)
                                     <option value="{{ $township->id }}"  {{ old('tsh_id', $terminal->tsh_id) == $township->id ? 'selected' : '' }}>{{ $township->tsh_name_mm }}</option>
                                @endforeach
                        
                           </select>
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
                        <h5 class="form-label col-md-2">တည်နေရာ*</h5>
                        <div class="col-md-5">
                            <textarea class="form-control" placeholder="သီလဝါဆိပ်ကမ်း အကွက်အမှတ်(၁၇/၁၈-က)
ကျောက်တန်းမြို့နယ်" id="location" name="location">{{$terminal->location}}</textarea>
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
                            <input type="text" class="form-control" name="comp_licence_no" id="comp_licence_no" placeholder="0001" value="{{ old('comp_licence_no',$terminal->comp_licence_no) }}"  />

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
                            <input type="text" class="form-control" name="comp_issue_date" id="comp_issue_date"  value="{{ old('comp_issue_date',$terminal->comp_issue_date) }}"   placeholder="2020-10-29" />

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
                            <input type="text" class="form-control" name="licence_no" id="licence_no" placeholder="0001" value="{{ old('licence_no',$terminal->lic_no) }}"  />

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
                            <input type="text" class="form-control" name="issue_date" id="issue_date"  value="{{ old('issue_date',$terminal->issue_date) }}"   placeholder="2020-10-29" />

                            @if ($errors->has('issue_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('issue_date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">ဓါတ်ဆီ*</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="gasoline" id="gasoline" placeholder="200" value="{{ old('gasoline',$terminal->gasoline) }}"  />

                            @if ($errors->has('gasoline'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('gasoline') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">ဒီဇယ်*</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="disel" id="disel" placeholder="200" value="{{ old('disel',$terminal->disel) }}"  />

                            @if ($errors->has('disel'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('disel') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">မှတ်ချက်</label>
                        <div class="col-md-5">
                           <!--  <input type="text" class="form-control" name="remark" id="remark" placeholder="ABC Training Co.,Ltd" value="{{ old('remark',$terminal->remark) }}"  /> -->

                           <textarea class="form-control" id="remark" name="remark" placeholder="Remark">{{$terminal->remark}}</textarea>
                           
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="form-group  text-center">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary" href="{{ route('admin.terminal.index') }}"><i  class="fa fa-fw fa-arrow-left"></i>  နောက်သို့</a>
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
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.css') }}"/>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript">
        $(function() {
          $('#color-css').wheelColorPicker();
        });

        $(document).ready(function(){
           var issue_date=$('input[name="issue_date"]').datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                autoclose: true,
            });
           var issue_date=$('input[name="comp_issue_date"]').datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                autoclose: true,
            });

           $('#sd_id').change(function(){
            // alert("hi");
                getSelect2Ajax($(this).val())

            });

            function getSelect2Ajax($sdid){

                $('.ctr_township').select2({
                  placeholder: 'Select township',
                  ajax: {
                    url: $baseurl +'select2-autocomplete-ajax?sd_id='+$sdid,
                    dataType: 'json',
                    // method : 'post',
                    // data : {
                    //         'state_division_id' : $('#sd_id').val(),
                    //         '_token': $('#ctr_token').val()
                    // },
                    delay: 250,
                    processResults: function (data) {
                      return {
                        results:  $.map(data, function (item) {
                              return {
                                  text: item.tsh_name_mm,
                                  id: item.id
                              }
                          })
                      };
                    },
                    cache: true
                  }
            });
            }
            
        });
    </script>
@stop
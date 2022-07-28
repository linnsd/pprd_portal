@extends('adminlte::page')

@section('title', 'လိုင်စင် ထည့်ရန်')

@section('content_header')

    <h4>လိုင်စင် ထည့်ရန်</h4><br>

@stop

@section('content')
<div class="container">
    <div class="panel-body">
        <form action="{{ route('admin.licence_fee.update',$licencefee->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        
            <div class="row">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="" class="form-label col-md-3">Licence Name*</label>
                        <div class="col-md-8">
                           <input type="text" name="" readonly="readonly" class="form-control" value="{{ old('itemName',$licencefee->viewLicenceName->lic_name) }}">
                           <input type="hidden" name="itemName" class="form-control" value="{{ old('itemName',$licencefee->lic_name_id) }}">
                            @if ($errors->has('licence_gp_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('licence_gp_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                         <label for="" class="form-label col-md-2">Licence Grade*</label>
                         <div class="col-md-8">
                           <select class="form-control" name="lic_grade_id">
                               <option value="">Licence Grade</option>
                               @foreach($lic_grades as $lic_grade)
                                    <option value="{{ $lic_grade->id }}"
                                        {{ old('lic_grade_id', $licencefee->lic_grade_id) == $lic_grade->id ? 'selected' : '' }}>
                                        {{ $lic_grade->grade }}
                                    </option>
                                  @endforeach
                           </select>
                         </div>
                         
                      </div>
                      
                    </div>
                    
                </div>
                <div class="row" id="dynamicTable">
                    <div class="col-md-6">
                        
                            <div class="form-group">
                                <label for="" class="form-label col-md-3">Key*</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="lic_key" id="lic_key" placeholder="လိုင်စင်ကြေး" value="{{ old('lic_key',$licencefee->lic_key) }}"  />

                                    @if ($errors->has('lic_key'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lic_key') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                       
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                                <label for="" class="form-label col-md-2">Value*</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="lic_value" id="lic_value" placeholder="500000" value="{{ old('lic_value',$licencefee->lic_fee_val) }}"  />

                                    @if ($errors->has('lic_value'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lic_value') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                 <!-- <a class="btn btn-success" id="addmore"><i class="fa fa-fw fa-plus"></i></a> -->
                            </div>
                    </div>
                   
                </div>

                
            </div>
            <div class="row">
                <div class="form-group  text-center">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary" href="{{ route('admin.licence_fee.index') }}"><i  class="fa fa-fw fa-arrow-left"></i>  နောက်သို့</a>
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
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
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
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js" defer></script>
     <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script> -->

    <script type="text/javascript" src="{{ asset('colorpicker/js/jquery-2.0.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('colorpicker/js/jquery.wheelcolorpicker-3.0.5.min.js') }} "></script>
    <script type="text/javascript">

        $(document).ready(function(){
                  $('.itemName').select2({

                    placeholder: 'Select an item',
                    ajax: {
                      url: '/search_ajax',
                      dataType: 'json',
                      delay: 250,
                      processResults: function (data) {
                        return {
                          results:  $.map(data, function (item) {
                                return {
                                    text: item.lic_name,
                                    id: item.id
                                }
                            })
                        };
                      },
                      cache: true
                    }
                  });
                  var i=1;
                  $("#addmore").on('click',function(){
                    
                    i++
                  $("#dynamicTable").append('<div class="row"><div class="col-md-6"><div class="form-group"><label class="form-label col-md-3"></label><div class="col-md-8"><input type="text" class="form-control" id="lic_key_id_'+i+'" placeholder="လိုင်စင်ကြေး" name="lic_key[]"/></div></div></div><div class="col-md-6"><div class="form-group"><label class="form-label col-md-2"></label><div class="col-md-8"><input type="number" class="form-control" placeholder="500000" id="lic_value_id_'+i+'"  name="lic_value[]"/></div><button class="btn btn-danger"><i class="fa fa-fw fa-times"></i></button></div></div></div>');
                  });
                
        });
        $("#dynamicTable").on("click", ".ibtnDel", function(event) {
           $(this).closest("div").remove();
        });
        $(function() {
          $('#color-css').wheelColorPicker();
        });
    </script>
@stop
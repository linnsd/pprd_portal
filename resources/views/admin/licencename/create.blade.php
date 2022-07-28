 @extends('adminlte::page')

@section('title', 'လိုင်စင်ခွဲထည့်ရန်')

@section('content_header')

    <h4>လိုင်စင်ခွဲထည့်ရန်</h4><br>

@stop

@section('content')
<div class="container">
    <div class="panel-body">
        <form action="{{ route('admin.licence_name.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf

        
            <div class="row">

                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">လိုင်စင် Group*</label>
                        <div class="col-md-5">
                           <!--  <input type="text" class="form-control" name="licence_gp_name" id="licence_gp_name" placeholder="ရေနံထွက်ပစ္စည်းလုပ်ငန်းလိုင်စင်" value="{{ old('licence_gp_name') }}"  /> -->
                           <select class="form-control" name="lic_gp_id">
                               <option value="">လိုင်စင် Group</option>
                               @foreach($licgroups as $licencegp)
                                <option value="{{$licencegp->id}}">{{$licencegp->lic_gp_name}}</option>
                               @endforeach
                           </select>

                            @if ($errors->has('licence_gp_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('licence_gp_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">လိုင်စင်ခွဲအမည်</label>
                        <div class="col-md-5">
                           <select class="form-control" name="sub_lic_id">
                               <option value="">လိုင်စင်ခွဲအမည်</option>
                               @foreach($sublicgps as $sublicgp)
                                <option value="{{$sublicgp->id}}">{{$sublicgp->lic_sub_gp_name}}</option>
                               @endforeach
                           </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="" class="form-label col-md-2">လိုင်စင်အမည်*</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="lic_name" id="lic_name" placeholder="ရေနံထွက်ပစ္စည်းလုပ်ငန်းလိုင်စင်" value="{{ old('lic_name') }}"  />

                            @if ($errors->has('lic_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('lic_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                
            </div>
            <div class="row">
                <div class="form-group  text-center">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary" href="{{ route('admin.licence_name.index') }}"><i  class="fa fa-fw fa-arrow-left"></i>  နောက်သို့</a>
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
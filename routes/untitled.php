@extends('adminlte::page')

@section('title', 'အရောင်းဆိုင်ဖြည့်သွင်းရန်')

@section('content_header')

    <h4>အရောင်းဆိုင်ဖြည့်သွင်းရန်</h4><br>

@stop

@section('content')
<div class="container">
    <div class="panel-body">
        <form action="{{ route('admin.shops.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf

        
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">တိုင်းဒေသကြီး/ပြည်နယ် *</label>
                            <div class="col-md-5">
                                @if(auth()->user()->role_id==1)
                                    <select name="sd_id" id="sd_id" class="form-control">
                                       <option value="">တိုင်းဒေသကြီး/ပြည်နယ်</option>
                                       @foreach($sdivisions as $sd)
                                       <option value="{{ $sd->id }}" {{ (old('sd_id')==$sd->id)?'selected':'' }}>{{ $sd->sd_name }}</option>
                                       @endforeach
                                   </select>
                                @else
                                    <select name="sd_id" id="sd_id" class="form-control">
                                       @foreach($sdivisions as $sd)
                                        @if(auth()->user()->sd_id==$sd->id)
                                            <option value="{{ $sd->id }}" {{ (old('sd_id',auth()->user()->sd_id)==$sd->id)?'selected':'' }}>{{ $sd->sd_name }}
                                            </option>
                                        @endif
                                       @endforeach
                                   </select>
                                @endif
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
                            <label for="" class="form-label col-md-4">မြို့နယ် *</label>
                            <div class="col-md-5">
                               <select name="tsh_id" id="township_id" class="form-control ctr_township">
                                 @if(auth()->user()->role_id==3)
                                    <option>--Select--</option>
                                    @foreach($townships as $township)
                                         <option value="{{ $township->id }}"  @if(old('tsh_id')==$township->id) selected @endif  >{{ $township->tsh_name_mm }}</option>
                                    @endforeach
                                 @endif
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
                            <label for="" class="form-label col-md-4">လိုင်စင်အမည်*</label>
                            <div class="col-md-5">
                               <select name="licence_id" id="licence_id" class="form-control">
                                <option value="">လိုင်စင်အမည်</option>
                                @foreach($licences as $licence)
                                <option value="{{$licence->id}}">
                                    {{$licence->licence_name}}
                                </option>
                                @endforeach
                               </select>
                                @if ($errors->has('licence_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('licence_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">အရောင်းဆိုင်အမည် *</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="shop_name" id="shop_name" placeholder="မြဘုရင်" value="{{ old('shop_name') }}"  />

                                @if ($errors->has('shop_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shop_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ပိုင်ရှင်/ကုမ္ပဏီ/အဖွဲ့အစည်းအမည် *</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="owner" id="owner" placeholder="ABC Trading Co.,Ltd" value="{{ old('owner') }}"  />

                                @if ($errors->has('owner'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('owner') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">လိုင်စင်အမှတ် *</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="licence_no" id="licence_no" placeholder="0023" value="{{ old('licence_no') }}"  />

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
                            <label for="" class="form-label col-md-4">Login ID</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="loginId" id="loginId"  value="{{ old('licence_no') }}"  disabled  />

                                @if ($errors->has('loginId'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('loginId') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">Password</label>
                            <div class="col-md-5">
                                <input type="password" class="form-control" name="password" id="password"  value="{{ old('password') }}"   />

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ဆိုင်ပုံ ၁</label>
                            <div class="col-md-5">
                                <input type="file" class="form-control" name="photo1" id="photo1"  value="{{ old('photo1') }}"   />

                                @if ($errors->has('photo1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                      <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ဆိုင်ပုံ</label>
                            <div class="col-md-5">
                                <input type="file" class="form-control" name="photo3" id="photo3"  value="{{ old('photo3') }}"   />

                                @if ($errors->has('photo3'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo3') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ဆိုင်ပုံ </label>
                            <div class="col-md-5">
                                <input type="file" class="form-control" name="photo4" id="photo4"  value="{{ old('photo4') }}"   />

                                @if ($errors->has('photo4'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo4') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ဆိုင်းဘုတ်ပုံ</label>
                            <div class="col-md-5">
                                <input type="file" class="form-control" name="photo2" id="photo2"  value="{{ old('photo2') }}"   />

                                @if ($errors->has('photo2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                         
                </div>
                <div class="col-md-6">

                     <div class="row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">ဆီအမျိုးအစား* </label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="fuel_type" id="fuel_type"  value="{{ old('fuel_type') }}"   placeholder="ဒီဇယ်" />

                                    @if ($errors->has('fuel_type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fuel_type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">ဓါတ်ဆီ* </label>
                                <div class="col-md-5">
                                    <input type="number" class="form-control" name="gasoline" id="gasoline"  value="{{ old('gasoline') }}"   placeholder="1000" />

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
                                <label for="" class="form-label col-md-4">ဒီဇယ်* </label>
                                <div class="col-md-5">
                                    <input type="number" class="form-control" name="diesel" id="diesel"  value="{{ old('diesel') }}"   placeholder="1000" />

                                    @if ($errors->has('diesel'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('diesel') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">သိုလှောင်မှုပမာဏ* </label>
                                <div class="col-md-5">
                                    <input type="number" class="form-control" name="storage" id="storage"  value="{{ old('storage') }}" placeholder="500" />

                                    @if ($errors->has('storage'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('storage') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">သက်တမ်းကုန်ဆုံးရက်*</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="expire_date" id="expire_date"  value="{{ old('expire_date') }}"   placeholder="2020-10-29" />

                                    @if ($errors->has('expire_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('expire_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">တည်နေရာ *</label>
                            <div class="col-md-5">
                                <textarea name="location" class="form-control" id="location" placeholder="(၀၆၇၅)၊ သာစည်ရပ်ကွက်၊ ဗန်းမော်မြို့">{{ old('location') }}</textarea>

                                @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">လတ္တီကျု</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="lat" id="lat"  value="{{ old('lat') }}"   placeholder="25.6220616" />

                                @if ($errors->has('lat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">လောင်ကျီကျု</label>
                            <div class="col-md-5">
                                 <input type="text" class="form-control" name="lng" id="lng"  value="{{ old('lng') }}"   placeholder="96.2808322" />

                                @if ($errors->has('lng'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lng') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">လိုင်စင်ပုံ </label>
                            <div class="col-md-5">
                                <input type="file" class="form-control" name="photo5" id="photo5"  value="{{ old('photo5') }}"   />

                                @if ($errors->has('photo5'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo5') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                     <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">လိုင်စင်ပုံ </label>
                            <div class="col-md-5">
                                <input type="file" class="form-control" name="photo6" id="photo6"  value="{{ old('photo6') }}"   />

                                @if ($errors->has('photo6'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo6') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">လိုင်စင်ပုံ </label>
                            <div class="col-md-5">
                                <input type="file" class="form-control" name="photo7" id="photo7"  value="{{ old('photo7') }}"   />

                                @if ($errors->has('photo7'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo7') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">လိုင်စင်ပုံ </label>
                            <div class="col-md-5">
                                <input type="file" class="form-control" name="photo8" id="photo8"  value="{{ old('photo8') }}"   />

                                @if ($errors->has('photo8'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo8') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ပုံ </label>
                            <div class="col-md-5">
                                <input type="file" class="form-control" name="photo9" id="photo9"  value="{{ old('photo9') }}"   />

                                @if ($errors->has('photo9'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo9') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ပုံ </label>
                            <div class="col-md-5">
                                <input type="file" class="form-control" name="photo10" id="photo10"  value="{{ old('photo10') }}"   />

                                @if ($errors->has('photo10'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo10') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

           

            </div>
            <div class="row">
                <div class="form-group  text-center">
                    <div class="col-md-3"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary" href="{{ route('admin.shops.index') }}"><i  class="fa fa-fw fa-arrow-left"></i>  နောက်သို့</a>
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
    $(document).ready(function(){
        var expire_date=$('input[name="expire_date"]').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
        });

        var sdid= $("#sd_id").val();
        if(sdid!=''){
            getTownshipByStateDivision(sdid);
        }


          $("#licence_no").focusout(function(){
            $('#loginId').val($(this).val());
          });

    });

    $('#sd_id').change(function(){
            getTownshipByStateDivision($(this).val());

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


   function getTownshipByStateDivision($id) {


            // $.ajaxSetup({
            //   headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //   }
            // });

            // $.ajax({
            //     url : $baseurl+'getTownshipByStateDivision',
            //     dataType : 'html',
            //     method : 'post',
            //     data : {
            //             'state_division_id' : $id,
            //             '_token': $('#ctr_token').val()
            //     },
            //     success : function(data){
            //         $('#township_id').html(data);
            //         if(data==""){
            //             $('#township_id').html('<option value="">Select Township</option>');
            //         }
            //     },
            //     error : function(error){
            //         console.log(error);
            //     }
            // });
    }

    

    


    
</script>

@stop
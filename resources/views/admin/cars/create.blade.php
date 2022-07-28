@extends('adminlte::page')

@section('title', 'ယာဉ်အချက်အလက်ဖြည့်သွင်းရန်')

@section('content_header')

    <h4>ယာဉ်အချက်အလက်ဖြည့်သွင်းရန်</h4><br>

@stop

@section('content')
<div class="container">
    <div class="panel-body">
        <form action="{{ route('admin.cars.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf

        
            <div class="row">
                <div class="col-md-6">
                     <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ဆီသယ်ယာဉ်/ဆီသယ်နောက်တွဲယာဉ် *</label>
                             <div class="col-md-5">
                                <select name="car_type" id="car_type" class="form-control"> 
                                    <option value="">--ဆီသယ်ယာဉ်/ဆီသယ်နောက်တွဲယာဉ်--</option>
                                    <option value="1" {{ (old('car_type')==1)?'selected':'' }}>ဆီသယ်ယာဉ်</option>
                                    <option value="2" {{ (old('car_type')==2)?'selected':'' }}>ဆီသယ်နောက်တွဲယာဉ်</option>
                                    <option value="3" {{ (old('car_type')==3)?'selected':'' }}>ATF</option>
                               </select>

                                @if ($errors->has('car_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('car_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">တိုင်းဒေသကြီး/ပြည်နယ် *</label>
                             <div class="col-md-5">
                                @if(auth()->user()->role_id==1)
                                   <select name="sd_id" id="sd_id" class="form-control">
                                       <option value="">တိုင်းဒေသကြီး/ပြည်နယ်ရွေးရန်</option>
                                       @foreach($state_division as $sd)
                                       <option value="{{ $sd->id }}" {{ (old('sd_id')==$sd->id)?'selected':'' }}>{{ $sd->sd_name }}</option>
                                       @endforeach
                                   </select>
                                @else
                                    <select name="sd_id" id="sd_id" class="form-control">
                                      
                                       @foreach($state_division as $sd)
                                            @if(auth()->user()->sd_id==$sd->id)
                                                <option value="{{ $sd->id }}" {{ (old('sd_id')==$sd->id)?'selected':'' }}>{{ $sd->sd_name }}</option>
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
                        <div class="row" id="plate_row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">ယာဉ်အမှတ် *</label>
                                <div class="col-md-2">
                                    <select class="form-control" id="prefix_number" name="prefix_number">
                                            <option value="">No</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                        </select>

                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="prefix_code" name="prefix_code">
                                            <option value="">Character</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>
                                            <option value="F">F</option>
                                            <option value="G">G</option>
                                            <option value="H">H</option>
                                            <option value="I">I</option>
                                            <option value="J">J</option>
                                            <option value="K">K</option>
                                            <option value="L">L</option>
                                            <option value="M">M</option>
                                            <option value="N">N</option>
                                            <option value="O">O</option>
                                            <option value="P">P</option>
                                            <option value="Q">Q</option>
                                            <option value="R">R</option>
                                            <option value="S">S</option>
                                            <option value="T">T</option>
                                            <option value="U">U</option>
                                            <option value="V">V</option>
                                            <option value="W">W</option>
                                            <option value="X">X</option>
                                            <option value="Y">Y</option>
                                            <option value="Z">Z</option>
                                            
                                        </select>

                                </div>
                                <div class="col-md-3">
                                  <input type="text" name="bowser_no" id="bowser_no" class="form-control" placeholder="1234">
                                </div>
                            </div>
                        </div>

                        
                        <div class="row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">ယာဉ်မောင်းအမည် *</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="dname" id="dname"  value="{{ old('dname') }}"   placeholder="U Mya" />

                                    @if ($errors->has('dname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('dname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
          
                        <div class="row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">ထုတ်လုပ်သည့်ကုမ္ပဏီ/မော်ဒယ် *</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="model" id="model"  value="{{ old('model') }}"   placeholder="Toyota" />

                                    @if ($errors->has('model'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('model') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                         <div class="row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">ယာဉ်အမျိုးအစား * </label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="type" id="custom1"  value="{{ old('type') }}"   placeholder="Truck" />

                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row" id="capacity_row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">ဝင်ဆံပမာဏ *</label>
                                <div class="col-md-4">
                                    <input type="number" class="form-control" name="capacity" id="capacity"  value="{{ old('capacity') }}"   placeholder="500" />

                                </div>
                                <div class="col-md-3">
                                   <select name="unit_id" id="unit_id" class="form-control">
                                       <option value="">ယူနစ်ရွေးရန်</option>
                                      
                                       <option value="1">ဂါလန်</option>
                                       <option value="2">လီတာ</option>
                                       <option value="3">KG</option>
                                       
                                   </select>
                                   
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">ယာဉ်အလေးချိန် *</label>
                                <div class="col-md-5">
                                    <input type="number" class="form-control" name="weight" id="weight"  value="{{ old('weight') }}"   placeholder="1000" />

                                    @if ($errors->has('weight'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('weight') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                         <div class="row" id="power_row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">အင်ဂျင်ပါဝါ *</label>
                                <div class="col-md-5">
                                    <input type="number" class="form-control" name="power" id="power"  value="{{ old('power') }}"  placeholder="500" />

                                    @if ($errors->has('power'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('power') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if(auth()->user()->role_id==1 && auth()->user()->loginId!='user1') 
                        <div class="row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">ထုတ်ပေးသည့်ရက်</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="issue_date" id="issue_date"  value="{{ old('issue_date') }}"   placeholder="{{date('d-m-Y')}}" />

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
                                <label for="" class="form-label col-md-4">သက်တမ်းကုန်ဆုံးရက်</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="expire_date" id="expire_date"  value="{{ old('expire_date') }}"   placeholder="{{date('d-m-Y')}}" />

                                    @if ($errors->has('expire_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('expire_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif

                         <div class="row" id="eng_no_row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">စက်အမှတ် *</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="eng_no" id="eng_no"  value="{{ old('eng_no') }}"   placeholder="VC10338" />

                                    @if ($errors->has('eng_no'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('eng_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">ဘောင်အမှတ် *</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="chassis_no" id="chassis_no"  value="{{ old('chassis_no') }}"   placeholder="5XXGN4A70" />

                                    @if ($errors->has('chassis_no'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('chassis_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
{{-- 
                        <div class="row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">ဆီသယ်ယာဉ် *</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="oil_carry" id="oil_carry"  value="{{ old('oil_carry') }}"   placeholder="2P/1254" />

                                    @if ($errors->has('oil_carry'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('oil_carry') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div> --}}
             {{--            <div class="row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">ဆီသယ်နောက်တွဲယာဉ် *</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="oil_carry_back" id="oil_carry_back"  value="{{ old('oil_carry_back') }}"   placeholder="7L/7845" />

                                    @if ($errors->has('oil_carry_back'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('oil_carry_back') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">သတ္တုတွင်းဦးစီးဌာနမှခွင့်ပြုထုတ်ပေးသည့်စက်သုံးဆီသယ်ယူခွင့်ပြုမိန့်အမှတ် *</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="mine_no" id="mine_no"  value="{{ old('mine_no') }}"   placeholder="၁၃/၂၀၁၉" />

                                    @if ($errors->has('mine_no'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('mine_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
{{-- 
                         <div class="row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">ဆေးအရောင် </label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="color" id="color"  value="{{ old('color') }}"   />

                                    @if ($errors->has('color'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('color') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div> --}}

                    
                </div>
                <div class="col-md-6">
                    <div class="row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-3">လုပ်ငန်းရှင်/ကုမ္ပဏီ/အဖွဲ့အစည်းအမည် </label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="company_name" id="company_name"  value="{{ old('company_name') }}"   placeholder='' />

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
                                <label for="" class="form-label col-md-3">သယ်ယူပို့ဆောင်သည့်ဆီအမျိုးအစား </label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="fuel_type" id="fuel_type"  value="{{ old('fuel_type') }}"   placeholder='' />

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
                                <label for="" class="form-label col-md-3">နေရပ်လိပ်စာ </label>
                                <div class="col-md-5">
                                    <textarea name="address"  id="address" class="form-control">{{ old('address') }}</textarea>
                                   
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-3">ယာဉ်မှတ်ပုံတင်စာအုပ် </label>
                            <div class="col-md-5">
                                <input type="file" class="form-control" name="owner_book_photo" id="owner_book_photo"  value="{{ old('owner_book_photo') }}"   />

                                @if ($errors->has('owner_book_photo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('owner_book_photo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-3"></label>
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
                    <label for="" class="form-label col-md-3">ယာဉ်လိုင်စင် ရှေ့ </label>
                    <div class="col-md-5">
                        <input type="file" class="form-control" name="licence_photo_f" id="licence_photo_f"  value="{{ old('licence_photo_f') }}"   />

                        @if ($errors->has('licence_photo_f'))
                            <span class="help-block">
                                <strong>{{ $errors->first('licence_photo_f') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label for="" class="form-label col-md-3">ယာဉ်လိုင်စင် နောက်</label>
                    <div class="col-md-5">
                        <input type="file" class="form-control" name="licence_photo_b" id="licence_photo_b"  value="{{ old('licence_photo_b') }}"   />

                        @if ($errors->has('licence_photo_b'))
                            <span class="help-block">
                                <strong>{{ $errors->first('licence_photo_b') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label for="" class="form-label col-md-3">ယာဉ်ရှေ့ဝဲ့ပုံ </label>
                    <div class="col-md-5">
                        <input type="file" class="form-control" name="car_f_photo" id="car_f_photo"  value="{{ old('licence_photo_f') }}"   />

                        @if ($errors->has('car_f_photo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('car_f_photo') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label for="" class="form-label col-md-3">ယာဉ်နောက်ယာပုံ</label>
                    <div class="col-md-5">
                        <input type="file" class="form-control" name="car_b_photo" id="car_b_photo"  value="{{ old('car_b_photo') }}"   />

                        @if ($errors->has('car_b_photo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('car_b_photo') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>


                        <div class="row">
                <div class="form-group">
                    <label for="" class="form-label col-md-3">အင်ဂျင်ခန်း </label>
                    <div class="col-md-5">
                        <input type="file" class="form-control" name="eng_photo" id="eng_photo"  value="{{ old('eng_photo') }}"   />

                        @if ($errors->has('eng_photo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('eng_photo') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label for="" class="form-label col-md-3">ရှေ့ခေါင်းခန်း</label>
                    <div class="col-md-5">
                        <input type="file" class="form-control" name="head_room_photo" id="head_room_photo"  value="{{ old('head_room_photo') }}"   />

                        @if ($errors->has('head_room_photo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('head_room_photo') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
{{--             <div class="row">
                <div class="form-group">
                    <label for="" class="form-label col-md-3">ကညနလိုင်စင်</label>
                    <div class="col-md-5">
                        <input type="file" class="form-control" name="ka_nya_na_photo" id="ka_nya_na_photo"  value="{{ old('ka_nya_na_photo') }}"   />

                        @if ($errors->has('ka_nya_na_photo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ka_nya_na_photo') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <div class="form-group">
                    <label for="" class="form-label col-md-3">သတ္တုတွင်းလိုင်စင်</label>
                    <div class="col-md-5">
                        <input type="file" class="form-control" name="mine_licence_photo" id="mine_licence_photo"  value="{{ old('mine_licence_photo') }}"   />

                        @if ($errors->has('mine_licence_photo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('mine_licence_photo') }}</strong>
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
    
    <script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>

    <script>
    $(document).ready(function(){

        $('#car_type').change(function(){
           if($(this).val()==2){
             $('#power_row').hide();
             $('#eng_no_row').hide();
           }
           // else if($(this).val()==3){
           //  // alert("Hi");
           //  $('#capacity_row').hide();
           // }
           else{
             $('#power_row').show();
             $('#eng_no_row').show();
             $('#capacity_row').show();
           }
        });

        var expire_date=$('input[name="expire_date"]').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            autoclose: true,
        });

        var issue_date=$('input[name="issue_date"]').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            autoclose: true,
        });


    });

    $('#state_division_id').change(function(){
            getTownshipByStateDivision($(this).val());
    });

   function getTownshipByStateDivision($id) {
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            $.ajax({
                url : $baseurl+'getTownshipByStateDivision',
                dataType : 'html',
                method : 'post',
                data : {
                        'state_division_id' : $id,
                        '_token': $('#ctr_token').val()
                },
                success : function(data){
                    $('#township_id').html(data);
                    if(data==""){
                        $('#township_id').html('<option value="">Select Township</option>');
                    }
                },
                error : function(error){
                    console.log(error);
                }
            });
    }

    
</script>

@stop
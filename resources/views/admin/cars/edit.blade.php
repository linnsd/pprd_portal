@extends('adminlte::page')

@section('title', 'ယာဉ်အချက်အလက်ဖြည့်ပြင်ဆင်ရန် ')

@section('content_header')

    <h1>ယာဉ်အချက်အလက်ဖြည့်ပြင်ဆင်ရန်</h1>

@stop

@section('content')
<div class="container">
    <div class="panel-body">
        <form action="{{ route('admin.cars.update',$car->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data"> 
            @csrf
            @method('PUT')

            
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">ဆီသယ်ယာဉ်/ဆီသယ်နောက်တွဲယာဉ် *</label>
                             <div class="col-md-5">
                                <select name="car_type" id="car_type" class="form-control"> 
                                    <option value="">--ဆီသယ်ယာဉ်/ဆီသယ်နောက်တွဲယာဉ်--</option>
                                    <option value="1" {{ (old('car_type',$car->car_type)==1)?'selected':'' }}>ဆီသယ်ယာဉ်</option>
                                    <option value="2" {{ (old('car_type',$car->car_type)==2)?'selected':'' }}>ဆီသယ်နောက်တွဲယာဉ်</option>
                                    <option value="3" {{ (old('car_type',$car->car_type)==3)?'selected':'' }}>ATF</option>
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
                                   <select name="sd_id" id="state_division_id" class="form-control">
                                       <option value="">--Select--</option>
                                       @foreach($sdivisions as $sd)
                                       <option value="{{ $sd->id }}" {{ (old('sd_id',$car->sd_id)==$sd->id)?'selected':'' }}>{{ $sd->sd_name }}</option>
                                       @endforeach
                                   </select>
                                @else
                                    <select name="sd_id" id="state_division_id" class="form-control">
                                        @foreach($sdivisions as $sd)
                                            @if(auth()->user()->sd_id==$sd->id)
                                               <option value="{{ $sd->tid }}" {{ (old('sd_id',auth()->user()->sd_id)==$sd->id)?'selected':'' }}>{{ $sd->sd_name }}
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
                    <div class="row" id="plate_row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">ယာဉ်အမှတ် *</label>
                                <div class="col-md-2">
                                    <select class="form-control" id="prefix_number" name="prefix_number">
                                            <option value="">No</option>
                                            <option value="1" {{$car->car_prefix_no == 1 ? 'selected' : ''}}>1</option>
                                            <option value="2" {{$car->car_prefix_no == 2 ? 'selected' : ''}}>2</option>
                                            <option value="3" {{$car->car_prefix_no == 3 ? 'selected' : ''}}>3</option>
                                            <option value="4" {{$car->car_prefix_no == 4 ? 'selected' : ''}}>4</option>
                                            <option value="5" {{$car->car_prefix_no == 5 ? 'selected' : ''}}>5</option>
                                            <option value="6" {{$car->car_prefix_no == 6 ? 'selected' : ''}}>6</option>
                                            <option value="7" {{$car->car_prefix_no == 7 ? 'selected' : ''}}>7</option>
                                            <option value="8" {{$car->car_prefix_no == 8 ? 'selected' : ''}}>8</option>
                                            <option value="9" {{$car->car_prefix_no == 9 ? 'selected' : ''}}>9</option>
                                        </select>

                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="prefix_code" name="prefix_code">
                                            <option value="">Character</option>
                                            <option value="A" {{$car->car_prefix_character == "A" ? 'selected' : ''}}>A</option>
                                            <option value="B" {{$car->car_prefix_character == "B" ? 'selected' : ''}}>B</option>
                                            <option value="C" {{$car->car_prefix_character == "C" ? 'selected' : ''}}>C</option>
                                            <option value="D" {{$car->car_prefix_character == "D" ? 'selected' : ''}}>D</option>
                                            <option value="E" {{$car->car_prefix_character == "E" ? 'selected' : ''}}>E</option>
                                            <option value="F" {{$car->car_prefix_character == "F" ? 'selected' : ''}}>F</option>
                                            <option value="G" {{$car->car_prefix_character == "G" ? 'selected' : ''}}>G</option>
                                            <option value="H" {{$car->car_prefix_character == "H" ? 'selected' : ''}}>H</option>
                                            <option value="I" {{$car->car_prefix_character == "I" ? 'selected' : ''}}>I</option>
                                            <option value="J" {{$car->car_prefix_character == "J" ? 'selected' : ''}}>J</option>
                                            <option value="K" {{$car->car_prefix_character == "K" ? 'selected' : ''}}>K</option>
                                            <option value="L" {{$car->car_prefix_character == "L" ? 'selected' : ''}}>L</option>
                                            <option value="M" {{$car->car_prefix_character == "M" ? 'selected' : ''}}>M</option>
                                            <option value="N" {{$car->car_prefix_character == "A" ? 'selected' : ''}}>N</option>
                                            <option value="O" {{$car->car_prefix_character == "O" ? 'selected' : ''}}>O</option>
                                            <option value="P" {{$car->car_prefix_character == "P" ? 'selected' : ''}}>P</option>
                                            <option value="Q" {{$car->car_prefix_character == "Q" ? 'selected' : ''}}>Q</option>
                                            <option value="R" {{$car->car_prefix_character == "R" ? 'selected' : ''}}>R</option>
                                            <option value="S" {{$car->car_prefix_character == "S" ? 'selected' : ''}}>S</option>
                                            <option value="T" {{$car->car_prefix_character == "T" ? 'selected' : ''}}>T</option>
                                            <option value="U" {{$car->car_prefix_character == "U" ? 'selected' : ''}}>U</option>
                                            <option value="V" {{$car->car_prefix_character == "V" ? 'selected' : ''}}>V</option>
                                            <option value="W" {{$car->car_prefix_character == "W" ? 'selected' : ''}}>W</option>
                                            <option value="X" {{$car->car_prefix_character == "X" ? 'selected' : ''}}>X</option>
                                            <option value="Y" {{$car->car_prefix_character == "Y" ? 'selected' : ''}}>Y</option>
                                            <option value="Z" {{$car->car_prefix_character == "Z" ? 'selected' : ''}}>Z</option>
                                            
                                        </select>

                                </div>
                                <div class="col-md-3">
                                  <input type="number" name="bowser_no" id="bowser_no" class="form-control" placeholder="1234" value="{{$car->car_no}}">
                                </div>
                            </div>
                        </div>

                    <?php 
                        $array=[];
                        $driver = '';
                        $lastdriver = '';

                        foreach($car->drivers as $key => $driver) {
                            if($driver->dname!=''){
                                $driver = $driver->dname;
                            }
                                array_push($array, $driver);
                            }
                            
                            if (empty($array)) {
                                $lastdriver ='';       
                            }else{
                                $lastdriver = end($array);       
                            }  
                        
                     ?>

                    <div class="row">
                            <div class="form-group">
                                <label for="dname" class="form-label col-md-4">ယာဉ်မောင်းအမည် *</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="dname" id="dname"  value="{{ old('dname',$lastdriver )}}"   placeholder="ယာဉ်မောင်းအမည်" />

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
                                <label for="" class="form-label col-md-4">ထုတ်လုပ်သည့်ကုမ္ပဏီ/မော်ဒယ် </label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="model" id="model"  value="{{ old('model',$car->model) }}" placeholder="ထုတ်လုပ်သည့်ကုမ္ပဏီ/မော်ဒယ်" />

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
                                <label for="" class="form-label col-md-4">ယာဉ်အမျိုးအစား*</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="type" id="custom1"  value="{{ old('type',$car->type) }}" placeholder="ယာဉ်အမျိုးအစား" />

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
                                <label for="" class="form-label col-md-4">တင်ဆောင်နိုင်သည့်ပမာဏ </label>
                                <div class="col-md-4">
                                    <input type="number" class="form-control" name="capacity" id="capacity"  value="{{ old('capacity',$car->capacity) }}" placeholder="တင်ဆောင်နိုင်သည့်ပမာဏ" />

                                    @if ($errors->has('capacity'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('capacity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                   <select name="unit_id" id="unit_id" class="form-control">
                                       <option value="">ယူနစ်ရွေးရန်</option>
                                      
                                       <option value="1" {{ (old('unit_id',$car->unit_id)==1)?'selected':'' }}>ဂါလန်</option>
                                       <option value="2" {{ (old('unit_id',$car->unit_id)==2)?'selected':'' }}>လီတာ</option>
                                       <option value="3" {{ (old('unit_id',$car->unit_id)==3)?'selected':'' }}>KG</option>
                                       
                                   </select>
                                    @if ($errors->has('unit_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('unit_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">ယာဉ်အလေးချိန် </label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="weight" id="weight"  value="{{ old('weight',$car->weight) }}" placeholder="ယာဉ်အလေးချိန်" />

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
                                <label for="" class="form-label col-md-4">အင်ဂျင်ပါဝါ</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="power" id="power"  value="{{ old('power',$car->power) }}" placeholder="အင်ဂျင်ပါဝါ" />

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
                                <label for="" class="form-label col-md-4">ထုတ်ပေးသည့်ရက် *</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="issue_date" id="issue_date"  value="{{ old('issue_date',$car->issue_date) }}" placeholder="ထုတ်ပေးသည့်ရက်" />

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
                                <label for="" class="form-label col-md-4">သက်တမ်းကုန်ဆုံးရက် </label>
                                <div class="col-md-5">
                                   
                                    <input type="text" class="form-control" name="expire_date" id="expire_date"  value="{{ old('expire_date',$car->expire_date) }}" placeholder="သက်တမ်းကုန်ဆုံးရက်" />

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
                                <label for="" class="form-label col-md-4">စက်အမှတ် </label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="eng_no" id="eng_no"  value="{{ old('eng_no',$car->eng_no) }}" placeholder="စက်အမှတ်" />

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
                                <label for="" class="form-label col-md-4">ဘောင်အမှတ် </label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="chassis_no" id="chassis_no"  value="{{ old('chassis_no',$car->chassis_no) }}" placeholder="ဘောင်အမှတ်" />

                                    @if ($errors->has('chassis_no'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('chassis_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
               {{--          <div class="row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">ဆီသယ်ယာဉ် *</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="oil_carry" id="oil_carry"  value="{{ old('oil_carry',$car->oil_carry) }}"   />

                                    @if ($errors->has('oil_carry'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('oil_carry') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div> --}}
                       {{--  <div class="row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">ဆီသယ်နောက်တွဲယာဉ် *</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="oil_carry_back" id="oil_carry_back"  value="{{ old('oil_carry_back',$car->oil_carry_back) }}" placeholder="ဆီသယ်နောက်တွဲယာဉ်" />

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
                                    <input type="text" class="form-control" name="mine_no" id="mine_no"  value="{{ old('mine_no',$car->mine_no) }}"  placeholder="သတ္တုတွင်းဦးစီးဌာနမှခွင့်ပြုထုတ်ပေးသည့်စက်သုံးဆီသယ်ယူခွင့်ပြုမိန့်အမှတ်" />

                                    @if ($errors->has('mine_no'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('mine_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

 {{--                         <div class="row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">ဆေးအရောင် </label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="color" id="color"  value="{{ old('color',$car->color) }}"   />

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
                                    <input type="text" class="form-control" name="company_name" id="company_name"  value="{{ old('company_name',$car->company_name) }}"   placeholder='' />

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
                                    <input type="text" class="form-control" name="fuel_type" id="fuel_type"  value="{{ old('fuel_type',$car->fuel_type) }}"   placeholder='' />

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
                                <label for="" class="form-label col-md-3">နေရပ်လိပ်စာ</label>
                                <div class="col-md-5">
                                    <textarea name="address"  id="address" class="form-control">{{ old('address',$car->address) }}</textarea>
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

                                @if($car->owner_book_photo!='')
                                 <img src="{{ asset($car->path.'/'.$car->owner_book_photo) }}" alt="linc_front" width="50%" style="border: 1px;">

                                @else
                                    <img id="owner_book_photo"  src="{{ asset('img/noimage.jpg') }}" alt="No Photo" class="myImg" width="50%" style="border: 1px;">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-3"></label>
                            <div class="col-md-5">
                                <input type="file" class="form-control" name="photo1" id="photo1"  value="{{ old('photo1') }}"   />

                                @if($car->photo1!='')
                                 <img src="{{ asset($car->path.'/'.$car->photo1) }}" alt="photo1" width="50%" style="border: 1px;">

                                @else
                                    <img id="photo1"  src="{{ asset('img/noimage.jpg') }}" alt="No Photo" class="myImg" width="50%" style="border: 1px;">
                                @endif

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
                    <label for="" class="form-label col-md-3">ယာဉ်လိုင်စင် ရှေ့</label>
                    <div class="col-md-5">
                        <input type="file" class="form-control" name="licence_photo_f" id="licence_photo_f"  value="{{ old('licence_photo_f') }}"   />

                        @if ($errors->has('licence_photo_f'))
                            <span class="help-block">
                                <strong>{{ $errors->first('licence_photo_f') }}</strong>
                            </span>
                        @endif
                        @if($car->licence_photo_f!='')
                         <img src="{{ asset($car->path.'/'.$car->licence_photo_f) }}" alt="linc_front" width="50%" style="border: 1px;">

                        @else
                            <img id="owner_book_photo"  src="{{ asset('img/noimage.jpg') }}" alt="No Photo" class="myImg" width="50%" style="border: 1px;">
                        @endif
                        
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label for="" class="form-label col-md-3">ယာဉ်လိုင်စင် နောက် </label>
                    <div class="col-md-5">
                        <input type="file" class="form-control" name="licence_photo_b" id="licence_photo_b"  value="{{ old('licence_photo_b') }}"   />

                        @if ($errors->has('licence_photo_b'))
                            <span class="help-block">
                                <strong>{{ $errors->first('licence_photo_b') }}</strong>
                            </span>
                        @endif

                        @if($car->licence_photo_b!='')
                         <img src="{{ asset($car->path.'/'.$car->licence_photo_b) }}" alt="linc_front" width="50%" style="border: 1px;">

                        @else
                            <img id="owner_book_photo"  src="{{ asset('img/noimage.jpg') }}" alt="No Photo" class="myImg" width="50%" style="border: 1px;">
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

                        @if($car->car_f_photo!='')
                         <img src="{{ asset($car->path.'/'.$car->car_f_photo) }}" alt="linc_front" width="50%" style="border: 1px;">

                        @else
                            <img id="owner_book_photo"  src="{{ asset('img/noimage.jpg') }}" alt="No Photo" class="myImg" width="50%" style="border: 1px;">
                        @endif
                        
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label for="" class="form-label col-md-3">ယာဉ်နောက်ယာပုံ </label>
                    <div class="col-md-5">
                        <input type="file" class="form-control" name="car_b_photo" id="car_b_photo"  value="{{ old('car_b_photo') }}"   />

                        @if ($errors->has('car_b_photo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('car_b_photo') }}</strong>
                            </span>
                        @endif

                        @if($car->car_b_photo!='')
                         <img src="{{ asset($car->path.'/'.$car->car_b_photo) }}" alt="linc_front" width="50%" style="border: 1px;">

                        @else
                            <img id="owner_book_photo"  src="{{ asset('img/noimage.jpg') }}" alt="No Photo" class="myImg" width="50%" style="border: 1px;">
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

                        @if($car->eng_photo!='')
                         <img src="{{ asset($car->path.'/'.$car->eng_photo) }}" alt="linc_front" width="50%" style="border: 1px;">

                        @else
                            <img id="owner_book_photo"  src="{{ asset('img/noimage.jpg') }}" alt="No Photo" class="myImg" width="50%" style="border: 1px;">
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

                        @if($car->head_room_photo!='')
                         <img src="{{ asset($car->path.'/'.$car->head_room_photo) }}" alt="linc_front" width="50%" style="border: 1px;">

                        @else
                            <img id="owner_book_photo"  src="{{ asset('img/noimage.jpg') }}" alt="No Photo" class="myImg" width="50%" style="border: 1px;">
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

                        @if($car->ka_nya_na_photo!='')
                         <img src="{{ asset($car->path.'/'.$car->ka_nya_na_photo) }}" alt="linc_front" width="50%" style="border: 1px;">

                        @else
                            <img id="ka_nya_na_photo"  src="{{ asset('img/noimage.jpg') }}" alt="No Photo" class="myImg" width="50%" style="border: 1px;">
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

                        @if($car->mine_licence_photo!='')
                         <img src="{{ asset($car->path.'/'.$car->mine_licence_photo) }}" alt="linc_front" width="50%" style="border: 1px;">

                        @else
                            <img id="mine_licence_photo"  src="{{ asset('img/noimage.jpg') }}" alt="No Photo" class="myImg" width="50%" style="border: 1px;">
                        @endif
                       
                    </div>
                </div>
            </div>
                </div>
            </div>
                
            <div class="row">
                <div class="form-group  text-center">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary" href="{{ route('admin.cars.index') }}"><i  class="fa fa-fw fa-arrow-left"></i> နောက်သို့</a>
                        <button type="submit" class="btn btn-success"><i  class="fa fa-fw fa-floppy-o"></i> ပြင်ဆင်မည်</button>
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
        var car_type=$("#car_type").val();
        if(car_type==2){
            $('#power_row').hide();
            $('#eng_no_row').hide();
        }
        // else if(car_type == 3){
        //     $('#capacity_row').hide();
        // }
        else{
            $('#power_row').show();
            $('#eng_no_row').show();
            $('#capacity_row').show();
        }

        $('#car_type').change(function(){
           if($(this).val()==2){
             $('#power_row').hide();
             $('#eng_no_row').hide();
             $("#capacity_row").show();
           }
           // else if($(this).val()==3){
           //  $('#capacity_row').hide();
           // }
           else{
             $('#power_row').show();
             $('#eng_no_row').show();
             $("#capacity_row").show();
           }
        });


        var expire_date=$('input[name="expire_date"]').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
        });
         var issue_date=$('input[name="issue_date"]').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
        });
    });
</script>
@stop
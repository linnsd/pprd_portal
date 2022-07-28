@extends('adminlte::page')

@section('title', 'အရောင်းဆိုင်ပြင်ရန်')

@section('content_header')

    <h4>အရောင်းဆိုင်ပြင်ရန်</h4><br>

@stop

@section('content')
<div class="container">
    <div class="panel-body">
        <form action="{{ route('admin.shops.update',$shop->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="form-group">
                            <label for="" class="form-label col-md-4">တိုင်းဒေသကြီး/ပြည်နယ် *</label>
                            <div class="col-md-5">
                                @if(auth()->user()->role_id==1)
                                   <select name="sd_id" id="state_division_id" class="form-control">
                                       <option value="">--Select--</option>
                                       @foreach($sdivisions as $sd)
                                       <option value="{{ $sd->id }}" {{ (old('sd_id',$shop->sd_id)==$sd->id)?'selected':'' }}>{{ $sd->sd_name }}</option>
                                       @endforeach
                                   </select>
                                @else
                                    @can('dio-full-permission')
                                     <select name="sd_id" id="state_division_id" class="form-control" >
                                        @foreach($sdivisions as $sd)
                                           @if(auth()->user()->sd_id==$sd->id)
                                               <option value="{{ $sd->id }}" {{ (old('sd_id',auth()->user()->sd_id,$shop->sd_id)==$sd->id)?'selected':'' }}>{{ $sd->sd_name }}</option>
                                           @endif
                                          @endforeach
                                      </select>
                                    @else
                                    <select id="state_division_id" class="form-control"  disabled>
                                       @foreach($sdivisions as $sd)
                                        @if(auth()->user()->sd_id==$sd->id)
                                            <option value="{{ $sd->id }}" {{ (old('sd_id',auth()->user()->sd_id,$shop->sd_id)==$sd->id)?'selected':'' }}>{{ $sd->sd_name }}</option>
                                        @endif
                                       @endforeach
                                   </select>

                                    <input type="hidden" name="sd_id"  value="{{ $shop->sd_id }}">

                                   @endcan

                                   
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
                                 @if(auth()->user()->role_id==1)
                                   <select name="tsh_id" id="township_id" class="form-control" >
                                        @foreach($townships as $tsh)
                                        <option value="{{ $tsh->id }}" {{ (old('tsh_id',$shop->tsh_id)==$tsh->id)?'selected':'' }}>{{ $tsh->tsh_name_mm }}</option>
                                       @endforeach
                                   </select>
                                @else
                                    @can('dio-full-permission')
                                    <select name="tsh_id" id="township_id" class="form-control" >
                                    @else
                                    <select  id="township_id" class="form-control" disabled >
                                    @endcan
                                        @foreach($townships as $tsh)
                                        <option value="{{ $tsh->id }}" {{ (old('tsh_id',$shop->tsh_id)==$tsh->id)?'selected':'' }}>{{ $tsh->tsh_name_mm }}</option>
                                       @endforeach
                                   </select>
                                  <!--  <input type="hidden"  name="tsh_id" value="{{ $shop->tsh_id }}"> -->
                                @endif
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
                                 @can('dio-full-permission')
                                   <select name="licence_id" id="licence_id" class="form-control" >
                                    <option value="">လိုင်စင်အမည်</option>
                                         @foreach($licences as $licence)
                                         <option value="{{ $licence->id }}" {{ (old('licence_id',$shop->licence_id)==$licence->id)?'selected':'' }}>{{ $licence->licence_name }}</option>
                                        @endforeach
                                    </select>
                                 @else
                                    <select  id="licence_id" class="form-control" disabled>
                                     <option value="">လိုင်စင်အမည်</option>
                                         @foreach($licences as $licence)
                                         <option value="{{ $licence->id }}" {{ (old('licence_id',$shop->licence_id)==$licence->id)?'selected':'' }}>{{ $licence->licence_name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="licence_id"  value="{{ $shop->licence_id }}">
                                   @endcan


                                     
                                
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
                                @can('dio-full-permission')
                                    <input type="text" class="form-control" name="shop_name" id="shop_name" placeholder="ABC" value="{{ old('shop_name',$shop->shop_name) }}" />
                                @else
                                  <input type="text" class="form-control" name="shop_name" id="shop_name" placeholder="ABC" value="{{ old('shop_name',$shop->shop_name) }}" @if(auth()->user()->role_id!=1) readonly @endif   />
                                @endcan

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
                                @can('dio-full-permission')
                                <input type="text" class="form-control" name="owner" id="owner" placeholder="ABC Trading Co.,Ltd" value="{{ old('owner',$shop->owner) }}" />
                                @else
                                  <input type="text" class="form-control" name="owner" id="owner" placeholder="ABC Trading Co.,Ltd" value="{{ old('owner',$shop->owner) }}" @if(auth()->user()->role_id!=1) readonly @endif   />
                                @endcan

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
                                @if(auth()->user()->role_id==1)
                                <input type="text" class="form-control" name="licence_no" id="licence_no" placeholder="0023" value="{{ old('licence_no',$shop->licence_no) }}"  />
                                @else
                                  @can('dio-full-permission')
                                    <input type="text" class="form-control" name="licence_no" id="licence_no" placeholder="0023"  value="{{ old('licence_no',$shop->licence_no) }}"  />
                                  @else
                                     <input type="text" class="form-control" name="licence_no" id="licence_no" placeholder="0023"  value="{{ old('licence_no',$shop->licence_no) }}"  readonly />
                                  @endcan
                                @endif

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
                                @if($shop->user)
                                <input type="text" class="form-control" name="loginId" id="loginId"  value="{{ old('loginId',$shop->user->loginId) }}"  readonly  />
                                @else
                                <input type="text" class="form-control" name="loginId" id="loginId"  value=""  readonly  />
                                @endif
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
                                <input type="password" class="form-control" name="password" id="password"  value="{{ old('password','123456') }}"   />

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

                                @if($shop->photo1!='')
                                 <img   src="{{ asset($shop->path.'/'.$shop->photo1) }}" alt="ဓာတ်ပုံ" class="myImg" width="80%" style="border: 1px;">
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
                                @if($shop->photo3!='')
                                 <img   src="{{ asset($shop->path.'/'.$shop->photo3) }}" alt="ဓာတ်ပုံ" class="myImg" width="80%" style="border: 1px;">
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

                                @if($shop->photo4!='')
                                 <img   src="{{ asset($shop->path.'/'.$shop->photo4) }}" alt="ဓာတ်ပုံ" class="myImg" width="80%" style="border: 1px;">
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

                                @if($shop->photo2!='')
                                 <img   src="{{ asset($shop->path.'/'.$shop->photo2) }}" alt="ဓာတ်ပုံ" class="myImg" width="80%" style="border: 1px;">
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
                                    @can('dio-full-permission')
                                    <input type="text" class="form-control" name="fuel_type" id="fuel_type"  value="{{ old('fuel_type',$shop->fuel_type) }}"   />
                                    @else
                                    <input type="text" class="form-control" name="fuel_type" id="fuel_type"  value="{{ old('fuel_type',$shop->fuel_type) }}"  @if(auth()->user()->role_id!=1) readonly @endif  />
                                    @endcan

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
                                <label for="" class="form-label col-md-4">သိုလှောင်မှုပမာဏ* </label>
                                <div class="col-md-5">
                                    @can('dio-full-permission')
                                        <input type="number" class="form-control" name="storage" id="storage"  value="{{ old('storage',$shop->storage) }}"  />
                                    @else
                                        <input type="number" class="form-control" name="storage" id="storage"  value="{{ old('storage',$shop->storage) }}" @if(auth()->user()->role_id!=1) readonly @endif  />
                                    @endcan

                                    @if ($errors->has('storage'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('storage') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div><div class="row">
                            <div class="form-group">
                                <label for="" class="form-label col-md-4">ဓါတ်ဆီ* </label>
                                <div class="col-md-5">
                                  @can('dio-full-permission')
                                    <input type="number" class="form-control" name="gasoline" id="gasoline"  value="{{ old('gasoline',$shop->gasoline) }}"   placeholder="1000" />
                                   @else
                                     <input type="number" class="form-control" name="gasoline" id="gasoline"  value="{{ old('gasoline',$shop->gasoline) }}"   placeholder="1000" readonly />
                                  @endcan

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
                               @can('dio-full-permission')
                                <input type="number" class="form-control" name="diesel" id="diesel"  value="{{ old('diesel',$shop->diesel) }}"   placeholder="2000" />
                                @else
                                 <input type="number" class="form-control" name="diesel" id="diesel"  value="{{ old('diesel',$shop->diesel) }}"   placeholder="2000" readonly />

                               @endcan

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
                                <label for="" class="form-label col-md-4">သက်တမ်းကုန်ဆုံးရက်*</label>
                                <div class="col-md-5">
                                   @can('dio-full-permission')
                                      <input type="text" class="form-control"  name="expire_date" id="expire_date"  value="{{ old('expire_date',$shop->expire_date) }}"   placeholder="2020-10-29"  />
                                   @else
                                     <input type="text" class="form-control"   id="expire_date"  value="{{ old('expire_date',$shop->expire_date) }}"   placeholder="2020-10-29" readonly />

                                     <input type="hidden" name="expire_date" value="{{ old('expire_date',$shop->expire_date) }}" >
                                   @endcan
                                  
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
                                @can('dio-full-permission')
                                <textarea name="location" style="height: auto" class="form-control" id="location" placeholder="" >{{ old('location',$shop->location) }}</textarea>
                                @else
                                <textarea name="location" style="height: auto" class="form-control" id="location" placeholder="" @if(auth()->user()->role_id!=1) readonly @endif>{{ old('location',$shop->location) }}</textarea>
                                @endcan

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
                                @can('dio-full-permission')
                                <input type="text" class="form-control" name="lat" id="lat"  value="{{ old('lat',$shop->lat) }}"  />
                                @else
                                 @can('dio-edit-lat-lng')
                                  <input type="text" class="form-control" name="lat" id="lat"  value="{{ old('lat',$shop->lat) }}"  />
                                 @else
                                  <input type="text" class="form-control" name="lat" id="lat"  value="{{ old('lat',$shop->lat) }}"   @if(auth()->user()->role_id!=1) readonly @endif/>
                                 @endcan
                                  
                                @endcan

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
                                @can('dio-full-permission')
                                 <input type="text" class="form-control" name="lng" id="lng"  value="{{ old('lng',$shop->lng) }}"   />
                                @else
                                 @can('dio-edit-lat-lng')
                                  <input type="text" class="form-control" name="lng" id="lng"  value="{{ old('lng',$shop->lng) }}"   @if(auth()->user()->role_id!=1) @endif/>
                                  @else
                                  <input type="text" class="form-control" name="lng" id="lng"  value="{{ old('lng',$shop->lng) }}"   @if(auth()->user()->role_id!=1) readonly @endif/>
                                  @endcan
                                
                                @endcan

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
                                @if($shop->photo5!='')
                                 <img   src="{{ asset($shop->path.'/'.$shop->photo5) }}" alt="ဓာတ်ပုံ" class="myImg" width="80%" style="border: 1px;">
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
                                @if($shop->photo6!='')
                                 <img   src="{{ asset($shop->path.'/'.$shop->photo6) }}" alt="ဓာတ်ပုံ" class="myImg" width="80%" style="border: 1px;">
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
                                @if($shop->photo7!='')
                                 <img   src="{{ asset($shop->path.'/'.$shop->photo7) }}" alt="ဓာတ်ပုံ" class="myImg" width="80%" style="border: 1px;">
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
                                @if($shop->photo8!='')
                                 <img   src="{{ asset($shop->path.'/'.$shop->photo8) }}" alt="ဓာတ်ပုံ" class="myImg" width="80%" style="border: 1px;">
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

                                @if($shop->photo9!='')
                                 <img   src="{{ asset($shop->path.'/'.$shop->photo9) }}" alt="ဓာတ်ပုံ" class="myImg" width="80%" style="border: 1px;">
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

                                @if($shop->photo10!='')
                                 <img   src="{{ asset($shop->path.'/'.$shop->photo10) }}" alt="ဓာတ်ပုံ" class="myImg" width="80%" style="border: 1px;">
                                @endif
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


       var licence_no = '<?php echo $shop->licence_no ?>';
       $("#loginId").val(licence_no);
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

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
    <div class="tabs">
        <div class="tabby-tab" style="margin-right: 5px;">
            <input type="radio" id="tab-1" name="tabby-tabs" checked >
            <label for="tab-1">Shop Data</label>
            <div class="tabby-content">
                   <div class="row">
                       <div class="col-md-6">
                            
                            <div class="row">
                            <div class="form-group">
                            
                                <h5 class="form-label col-md-4">အရောင်းဆိုင်အမည် *</h5>
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
                                    
                                    <h5 class="form-label col-md-4">ပိုင်ရှင်/ကုမ္ပဏီ/အဖွဲ့အစည်းအမည် *</h5>
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
                                    
                                    <h5 class="form-label col-md-4">ကုမ္ပဏီမှတ်ပုံတင်နံပါတ် *</h5>
                                    <div class="col-md-5">
                                       
                                        @can('dio-full-permission')
                                            <input type="text" class="form-control" name="company_no" id="company_no" placeholder="123434" value="{{ old('company_no',$shop->company_no) }}"  />
                                            @else
                                              <input type="text" class="form-control" name="company_no" id="company_no" placeholder="1234" value="{{ old('company_no',$shop->company_no) }}" @if(auth()->user()->role_id!=1) readonly @endif   />
                                            @endcan

                                        @if ($errors->has('company_no'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('company_no') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                 </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    
                                    <h5 class="form-label col-md-4">ဖုန်းနံပါတ်*</h5>
                                    <div class="col-md-5">
                                       
                                        @can('dio-full-permission')
                                            <input type="number" class="form-control" name="ph_no" id="ph_no" placeholder="09123456789" value="{{ old('ph_no',$shop->ph_no) }}"  />
                                            @else
                                              <input type="number" class="form-control" name="ph_no" id="ph_no" placeholder="09123456789" value="{{ old('ph_no',$shop->ph_no) }}" @if(auth()->user()->role_id!=1) readonly @endif   />
                                            @endcan

                                        @if ($errors->has('ph_no'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('ph_no') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                 </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    
                                    <h5 class="form-label col-md-4">အီးမေး*</h5>
                                    <div class="col-md-5">
                                       
                                        @can('dio-full-permission')
                                            <input type="email" class="form-control" name="email" id="email" placeholder="admin@gmail.com" value="{{ old('email',$shop->email) }}"  />
                                            @else
                                              <input type="email" class="form-control" name="email" id="email" placeholder="admin@gmail.com" value="{{ old('email',$shop->email) }}" @if(auth()->user()->role_id!=1) readonly @endif   />
                                            @endcan

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                 </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <h5 class="form-label col-md-4">တိုင်းဒေသကြီး/ပြည်နယ်</h5>
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
                                   @endif

                                    <input type="hidden" name="sd_id"  value="{{ $shop->sd_id }}">

                                   @endcan
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
                                    <h5 class="form-label col-md-4">မြို့နယ်*</h5>
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
                            <h5 class="form-label col-md-4">တည်နေရာ*</h5>
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
                            <h5 class="form-label col-md-4">လတ္တီကျု</h5>
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
                            <h5 class="form-label col-md-4">လောင်ကျီကျု</h5>
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
                    
                       </div>
                       <div class="col-md-6">
                           <div class="row">
                                <div class="form-group">
                                     <h5 class="form-label col-md-4">လိုင်စင်အမည် *</h5>
                                    <div class="col-md-5">
                                       <!-- <select class="lic_name_id form-control" name="lic_name_id"></select> -->
                                       <select class="lic_name_id form-control" name="lic_name_id">
                                           @foreach ($licences as $licence)
                                                <option value="{{ $licence->id }}" {{ ( $licence->id == $shop->licence_id) ? 'selected' : '' }}> 
                                                    {{ $licence->lic_name }} 
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
                                     <h5 class="form-label col-md-4">လိုင်စင်အဆင့်သတ်မှတ်ချက်*</h5>
                                    <div class="col-md-5">
                                       <select name="lic_grade_id" id="lic_grade_id" class="form-control">
                                        <option value="">လိုင်စင်အဆင့်သတ်မှတ်ချက်</option>
                                        @foreach($lic_grades as $lic_grade)
                                        <option value="{{ $lic_grade->id }}" {{ ( $lic_grade->id == $shop->lic_grade_id) ? 'selected' : '' }}> 
                                                    {{ $lic_grade->grade }} 
                                                </option>
                                        @endforeach
                                       </select>
                                        @if ($errors->has('lic_grade_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('lic_grade_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                        <div class="form-group">
                            
                            <h5 class="form-label col-md-4">လိုင်စင်အမှတ်*</h5>
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
                                <h5 class="form-label col-md-4">ဆီအမျိုးအစား*</h5>
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
                                <h5 class="form-label col-md-4">ဓါတ်ဆီ*</h5>
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
                                <h5 class="form-label col-md-4">ဒီဇယ်*</h5>
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
                                 <h5 class="form-label col-md-4">သိုလှောင်မှုပမာဏ*</h5>
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
                        </div>
                    <div class="row">
                        <div class="form-group">
                            <h5 class="form-label col-md-4">Login ID</h5>
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
                            <h5 class="form-label col-md-4">Password</h5>
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
                                <h5 class="form-label col-md-4">ထုတ်ပေးသည့်ရက်စွဲ*</h5>
                                <div class="col-md-5">
                                    @can('dio-full-permission')
                                      <input type="text" class="form-control"  name="issue_date" id="issue_date"  value="{{ old('issue_date',$shop->issue_date) }}"   placeholder="2020-10-29"  />
                                   @else
                                     <input type="text" class="form-control"   id="issue_date"  value="{{ old('issue_date',$shop->issue_date) }}"   placeholder="2020-10-29" readonly />

                                     <input type="hidden" name="issue_date" value="{{ old('issue_date',$shop->issue_date) }}" >
                                   @endcan

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
                                <h5 class="form-label col-md-4">သက်တမ်းကုန်ဆုံးရက်*</h5>
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

                       </div>

                   </div> 
                   <div class="form-group  text-center">
                        <div class="col-md-3"></div>
                        <div class="col-md-5">
                            <a class="btn btn-primary" href="{{ route('admin.shops.index') }}"><i  class="fa fa-fw fa-arrow-left"></i>နောက်သို့</a>
                            <a class="btn btn-success" id="shop_next"><i class="fa fa-fw fas fa-arrow-right"></i>ရှေ့သို့</a>

                        </div>
                    </div>
            </div>
        </div>
        <div class="tabby-tab" style="margin-right: 5px;">
            <input type="radio" id="tab-2" name="tabby-tabs" disabled="true">
            <label for="tab-2">Shop Image</label>
            <div class="tabby-content">
              <div class="row">
                        <div class="form-group">
                            <h5 class="form-label col-md-4">ဆိုင်ပုံ ၁</h5>
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
                            <h5 class="form-label col-md-4">ဆိုင်ပုံ</h5>
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
                            <h5 class="form-label col-md-4">ဆိုင်ပုံ</h5>
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
                            <h5 class="form-label col-md-4">ဆိုင်းဘုတ်ပုံ</h5>
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
                    <div class="form-group  text-center">
                        <div class="col-md-3"></div>
                        <div class="col-md-5">
                            <a class="btn btn-primary" id="img_back"><i  class="fa fa-fw fa-arrow-left"></i>နောက်သို့</a>
                            <a class="btn btn-success" id="img_next"><i class="fa fa-fw fas fa-arrow-right"></i>ရှေ့သို့</a>

                        </div>
                    </div>
            </div>
        </div>

        <div class="tabby-tab" style="margin-right: 5px;">
            <input type="radio" id="tab-3" name="tabby-tabs" disabled="true">
            <label for="tab-3">Licence Image</label>
            <div class="tabby-content">
            <div class="row">
                        <div class="form-group">
                            <h5 class="form-label col-md-4">လိုင်စင်ပုံ</h5>
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
                            <h5 class="form-label col-md-4">လိုင်စင်ပုံ</h5>
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
                            <h5 class="form-label col-md-4">လိုင်စင်ပုံ</h5>
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
                            <h5 class="form-label col-md-4">လိုင်စင်ပုံ</h5>
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
                            <h5 class="form-label col-md-4">ပုံ</h5>
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
                            <h5 class="form-label col-md-4">ပုံ</h5>
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
                    <div class="row">
                <div class="form-group  text-center">
                    <div class="col-md-3"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary" id="lic_photo_back"><i  class="fa fa-fw fa-arrow-left"></i>  နောက်သို့</a>
                        <button type="submit" class="btn btn-success"><i  class="fa fa-fw fa-floppy-o"></i>သိမ်းမည်</button>
                    </div>
                </div>
            </div>
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.css') }}"/>
   <style type="text/css" media="screen">
    label .lbl{
        font-size: 18px;
    }
    .tabs {
            position: relative;
            display: flex;
            min-height: 650px;
            border-radius: 8px 8px 0 0;
            overflow: hidden;
        }

        .tabby-tab {
            flex: 1;
        }

        .tabby-tab label {
            display: block;
            box-sizing: border-box;
            /* tab content must clear this */
            /*height: 50px;*/
            font-weight: 300 !important;
            padding: 10px;
            font-size: 15px;
            text-align: center;
            background: #5a4080;
            color: white;
            cursor: pointer;
            /* transition: background 0.5s ease; */
        }

        .tabby-tab label:hover {
            background: white;
            color: #5a4080;
            border-bottom: 1px solid #5a4080;
        }

        .tabby-content {
            position: absolute;
            left: 0;
            bottom: 0;
            right: 0;
            /* clear the tab labels */
            top: 40px;

            padding: 20px;
            border-radius: 0 0 8px 8px;
            /* background:#efedf1; */
            /* show/hide */
            opacity: 0;
            transform: scale(0.1);
            transform-origin: top left;
            padding-bottom: 50px;
        }

        .tabby-content img {
            float: left;
            margin-right: 20px;
            border-radius: 8px;
        }

        /* MAKE IT WORK ----- */

        .tabby-tab [name="tabby-tabs"] {
            display: none;
        }

        [name="tabby-tabs"]:checked~label {
            background: white;
            z-index: 2;
            color: #5a4080;
            border-bottom: 1px solid #5a4080;
        }

        [name="tabby-tabs"]:checked~label~.tabby-content {
            z-index: 1;
            opacity: 1;
            transform: scale(1);
        }


        /* BREAKPOINTS ----- */
        @media screen and (max-width: 767px) {
            .tabs {
                min-height: 400px;

            }
        }

        @media screen and (max-width: 480px) {
            .tabs {
                min-height: 580px;
            }

            .tabby-tab label {
                height: 60px;
            }

            .tabby-content {
                top: 60px;
            }

        }
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
        $('.lic_name_id').select2({

                    placeholder: 'Select licence name',
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
        $("select[name='lic_name_id']").change(function(){
          var itemName = $(this).val();
          var token = $("input[name='_token']").val();
          $.ajax({
              url: "<?php echo route('select-lic-name') ?>",
              method: 'POST',
              dataType:'html',
              data: {lic_id:itemName, _token:token},
              success: function(data) {
                $("select[name='lic_grade_id']").html(data);
              }
          });
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

    $("#shop_next").click(function(){
        var shop_name = $("#shop_name").val();    
        var owner = $("#owner").val();
        var company_no = $("#company_no").val();
        var lic_name = $("#select2-lic_name_id-rr-container").val();
        var lic_grade_id = $("#lic_grade_id").val();
        var lic_no = $("#licence_no").val();
        var fuel_type = $("#fuel_type").val();
        var gasoline = $("#gasoline").val();
        var diesel = $("#diesel").val();
        var storage = $("#storage").val();
        var sd_id = $("#sd_id").val();
        var township_id = $("#township_id").val();
        var location = $("#location").val();
        var issue_date = $("#issue_date").val();
        var expire_date = $("#expire_date").val();

        if (!shop_name) {
            $("#shop_name").css('border-color', function(){
                return '#f00';
            });
        }
        if (!owner) {
            $("#owner").css('border-color',function(){
                return '#f00';
            });
        }
        if (!company_no) {
            $("#company_no").css('border-color',function(){
                return '#f00';
            });
        }
        if (!lic_name) {
            $("#select2-lic_name_id-rr-container").css('border-color',function(){
                return '#f00';
            });
        }
        if (!lic_no) {
            $("#licence_no").css('border-color',function(){
                return '#f00';
            });
        }
        if (!lic_grade_id) {
            $("#lic_grade_id").css('border-color',function(){
                return '#f00';
            });
        }
        if (!lic_no) {
            $("#lic_no").css('border-color',function(){
                return '#f00';
            });
        }
        if (!fuel_type) {
            $("#fuel_type").css('border-color',function(){
                return '#f00';
            });
        }
        if (!gasoline) {
            $("#gasoline").css('border-color',function(){
                return '#f00';
            });
        }
        if (!diesel) {
            $("#diesel").css('border-color',function(){
                return '#f00';
            });
        }
        if (!storage) {
            $("#storage").css('border-color',function(){
                return '#f00';
            });
        }
        if (!sd_id) {
            $("#sd_id").css('border-color',function(){
                return '#f00';
            });
        }
        if (!township_id) {
            $("#township_id").css('border-color',function(){
                return '#f00';
            });
        }
        if (!location) {
            $("#location").css('border-color',function(){
                return '#f00';
            });
        }
        if (!issue_date) {
            $("#issue_date").css('border-color',function(){
                return '#f00';
            });
        }
        if (!expire_date) {
            $("#expire_date").css('border-color',function(){
                return '#f00';
            });
        }
        if (shop_name && owner && company_no && lic_name != "Select licence name" && lic_grade_id != "Select Licence Grade" && lic_no && fuel_type && gasoline && diesel && storage && sd_id!= "တိုင်းဒေသကြီး/ပြည်နယ်" && location && issue_date && expire_date) {
            $("#tab-2").prop("checked", true);
        }

         $('#shop_name').on('change', function(){
            $("#shop_name").css('border-color', function(){
                return '#A9A9A9';
            });
        });
         $('#owner').on('change', function(){
            $("#owner").css('border-color', function(){
                return '#A9A9A9';
            });
        });
         $('#company_no').on('change', function(){
            $("#company_no").css('border-color', function(){
                return '#A9A9A9';
            });
        });
         $('#select2-lic_name_id-rr-container').on('change', function(){
            $("#select2-lic_name_id-rr-container").css('border-color', function(){
                return '#A9A9A9';
            });
        });
         $('#licence_no').on('change', function(){
            $("#licence_no").css('border-color', function(){
                return '#A9A9A9';
            });
        });
         $('#fuel_type').on('change', function(){
            $("#fuel_type").css('border-color', function(){
                return '#A9A9A9';
            });
        });
         $('#gasoline').on('change', function(){
            $("#gasoline").css('border-color', function(){
                return '#A9A9A9';
            });
        });
         $('#diesel').on('change', function(){
            $("#diesel").css('border-color', function(){
                return '#A9A9A9';
            });
        });
         $('#storage').on('change', function(){
            $("#storage").css('border-color', function(){
                return '#A9A9A9';
            });
        });
         $('#sd_id').on('change', function(){
            $("#sd_id").css('border-color', function(){
                return '#A9A9A9';
            });
        });
         $('#township_id').on('change', function(){
            $("#township_id").css('border-color', function(){
                return '#A9A9A9';
            });
        });
         $('#location').on('change', function(){
            $("#location").css('border-color', function(){
                return '#A9A9A9';
            });
        });
         $('#issue_date').on('change', function(){
            $("#issue_date").css('border-color', function(){
                return '#A9A9A9';
            });
        });
         $('#expire_date').on('change', function(){
            $("#expire_date").css('border-color', function(){
                return '#A9A9A9';
            });
        });
         $('#lic_grade_id').on('change', function(){
            $("#lic_grade_id").css('border-color', function(){
                return '#A9A9A9';
            });
        });


        
    });
    $("#img_back").click(function(){
        $("#tab-1").prop("checked", true);
    });

    $("#img_next").click(function(){
        $("#tab-3").prop("checked", true);
    });

    $("#lic_photo_back").click(function(){
        $("#tab-2").prop("checked", true);
    });
    
</script>

@stop
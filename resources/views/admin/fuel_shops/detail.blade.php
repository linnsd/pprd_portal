@extends('adminlte::page')

@section('title', 'အရောင်းဆိုင်များ')

@section('content_header')

    <h1 class="unicode">အရောင်းဆိုင်များ</h1>

@stop

@section('content')
<div class="success-msg">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
</div>

<?php
    $tab_active = isset($_GET['tab_active'])?$_GET['tab_active']:'';
      
?>
<div>
    <a class="btn btn-primary form-group" href="{{ route('admin.fuel_shops.index') }}"><i  class="fa fa-fw fa-arrow-left"></i>နောက်သို့</a>
</div>

@if($tab_active == 4)
<div class="tab" style="margin-top:10px;">
   <button class="tablinks"  id="shop" onclick="openTab(event, 'shop_tab')">Shop Data</button>
   @if($shop_photos->count()>0)
   <button class="tablinks"  id="shop_img" onclick="openTab(event, 'shop_img_tab')">Shop Image</button>
   @endif
   @if($licence_photos->count()>0)
   <button class="tablinks"  id="licence" onclick="openTab(event, 'licence_tab')">Licence Image</button>
   @endif
    <button class="tablinks"  id="fuel_type" onclick="openTab(event, 'fuel_type_tab')">စက်သုံးဆီအမျိုးအစားများ</button>

    <button class="tablinks"  id="account" onclick="openTab(event, 'account_tab')" active>Account</button>

    <button class="tablinks"  id="download" onclick="openTab(event, 'download_tab')">Download File</button>

    <button class="tablinks"  id="rep_history" onclick="openTab(event, 'rep_history_tab')">Report History</button>
</div> 
@else
<div class="tab" style="margin-top:10px;">
   <button class="tablinks"  id="shop" onclick="openTab(event, 'shop_tab')" active>Shop Data</button>
   @if($shop_photos->count()>0)
   <button class="tablinks"  id="shop_img" onclick="openTab(event, 'shop_img_tab')">Shop Image</button>
   @endif
   @if($licence_photos->count()>0)
   <button class="tablinks"  id="licence" onclick="openTab(event, 'licence_tab')">Licence Image</button>
   @endif
    <button class="tablinks"  id="fuel_type" onclick="openTab(event, 'fuel_type_tab')">စက်သုံးဆီအမျိုးအစားများ</button>

    <button class="tablinks"  id="account" onclick="openTab(event, 'account_tab')">Account</button>

    <button class="tablinks"  id="download" onclick="openTab(event, 'download_tab')">Download File</button>

    <button class="tablinks"  id="rep_history" onclick="openTab(event, 'rep_history_tab')">Report History</button>
</div> 
@endif

    <div id="shop_tab" class="tabcontent">
        <div class="row">
        <div class="col-md-6">
            <div class="row form-group">
                <h5 class="form-label col-md-4">အရောင်းဆိုင်အမည် *</h5>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="shop_name" id="shop_name" placeholder="မြဘုရင်" value="{{ old('shop_name',$detail_data->shopName) }}"  readonly />
                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-4">ပိုင်ရှင်/ကုမ္ပဏီ/အဖွဲ့အစည်းအမည် *</h5>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="owner" id="owner" placeholder="ABC Trading Co.,Ltd" value="{{ old('owner',$detail_data->owner) }}"  readonly />
                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-4">တိုင်းဒေသကြီး/ပြည်နယ်*</h5>
                <div class="col-md-5">
                    
                    <input type="text" class="form-control" name="sd_name" id="sd_name" placeholder="နေပြည်တော်" value="{{ old('sd_name',$detail_data->sd_name) }}"  readonly />
                </div> 
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-4">မြို့နယ်*</h5>
                <div class="col-md-5">
                   <input type="text" class="form-control" name="tsh_name" id="tsh_name" placeholder="ပျဉ်းမနား" value="{{ old('tsh_name',$detail_data->tsh_name_mm) }}"  readonly />
                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-4">တည်နေရာ*</h5>
                <div class="col-md-5">
                    <textarea name="location" class="form-control" id="location" placeholder="(၀၆၇၅)၊ သာစည်ရပ်ကွက်၊ ဗန်းမော်မြို့" readonly>{{ old('location',$detail_data->address) }}</textarea>

                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-4">လတ္တီတွဒ်</h5>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="lat" id="lat"  value="{{ old('lat',$detail_data->lat) }}"   placeholder="25.6220616" readonly />
                </div>
            </div>

             <div class="row form-group">
                <h5 class="form-label col-md-4">လောင်ဂျီကျု</h5>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="lng" id="lng"  value="{{ old('lng',$detail_data->lng) }}"   placeholder="25.6220616" readonly />
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="row form-group">
                <h5 class="form-label col-md-3">လိုင်စင်အမည် *</h5>
                <div class="col-md-5">
                     <!-- licence_name -->
                     <input type="text" class="form-control" name="lic_name" id="lic_name"  value="{{ old('lic_name',$detail_data->licence_name) }}" readonly />
                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-3">လိုင်စင်အမှတ်*</h5>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="licence_no" id="licence_no" placeholder="0023" value="{{ old('licence_no',$detail_data->licence_no) }}"  readonly />
                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-3">ဆိုင်အမျိုးအစား*</h5>
                <div class="col-md-5">
                   @if($detail_data->shop_type == 0)
                    <input type="text" class="form-control" name="shop_type" id="shop_type" placeholder="" value="Minor"  readonly />
                    @elseif($detail_data->shop_type == 1)
                    <input type="text" class="form-control" name="shop_type" id="shop_type" placeholder="" value="Major" readonly />
                    @else
                    <input type="text" class="form-control" name="shop_type" id="shop_type" placeholder="" value="" readonly />
                    @endif
                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-3">ထုတ်ပေးသည့်ရက်စွဲ*</h5>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="issue_date" id="issue_date"  value="{{ old('issue_date',date('d-m-Y',strtotime($detail_data->lic_issue_date))) }}"   placeholder="16-10-2021" readonly />
                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-3">သက်တမ်းကုန်ဆုံးရက်*</h5>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="expire_date" id="expire_date"  value="{{ old('expire_date',date('d-m-Y',strtotime($detail_data->lic_expire_date))) }}"   placeholder="29-10-2021" readonly />
                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-3">မှတ်ချက်</h5>
                <div class="col-md-5">
                    <textarea class="form-control" name="remark" id="remark">{{$detail_data->remark}}</textarea>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div id="shop_img_tab" class="tabcontent">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Photo Name</th>
                    <th>Photo</th>
                </tr>
                @foreach($shop_photos as $key=>$shop_photo)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$shop_photo->photo_name}}</td>
                    <td>
                        <img src="{{asset($shop_photo->path.$shop_photo->name)}}" style="width:100px;height: 100px;">
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div id="licence_tab" class="tabcontent">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Photo Name</th>
                    <th>Photo</th>
                </tr>
                @foreach($licence_photos as $key=>$licence_photo)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$licence_photo->photo_name}}</td>
                    <td>
                        <img src="{{asset($licence_photo->path.$licence_photo->name)}}" style="width:100px;height: 100px;">
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

    <div id="fuel_type_tab" class="tabcontent">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>စက်သုံးဆီအမျိုးအစားများ</th>
                    <th>သိုလှောင်နိုင်မှု</th>
                    <th>လက်ကျန်</th>
                    <th>ပျမ်းမျှအရောင်း</th>
                </tr>
                @foreach($shop_fuel_list as $key=>$list)
                <tr>
                    <td>{{$list->f_type}}</td>
                    <td>{{$list->max_capacity}}</td>
                    <td>{{$list->opening_balance}}</td>
                    <td>{{$list->avg_balance}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

    <div id="account_tab" class="tabcontent">
        <div class="row">
        <form action="{{route('admin.shop_pass_update')}}" method="POST">
            @csrf
            @method('POST')
        <div class="col-md-6">
            <div class="row form-group">
                <h5 class="form-label col-md-4">Login ID*</h5>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="shop_name" id="shop_name" placeholder="Login ID" value="{{ old('shop_name',$detail_data->licence_no) }}"  readonly />
                </div>
            </div>

            <div class="row form-group">
                <h5 class="form-label col-md-4">Password*</h5>
                <div class="col-md-5">
                    <input type="password" class="form-control" name="login_password" id="login_password" placeholder="" value=""/>
                </div>
            </div>
            <input type="hidden" name="shop_id" id="shop_id" value="{{$detail_data->id}}">
            <div class="row form-group">
                <div class="col-md-5"></div>
                <div class="col-md-5">
                    <button class="btn btn-primary" type="button" id="update_password">Update</button>
                </div>
            </div>
        </div>
        </form>
    </div>
    </div>

    <div id="download_tab" class="tabcontent">
        <br>
            <div class="row">
              <a class="btn btn-primary btn-sm" href="{{route('shop.downloadqr',$detail_data->id)}}" style="margin-left: 15px;"><i class="fa fa-fw fa-download"></i>Download QR</a>

              <button class="btn btn-success btn-sm" onClick="doCapture();"><i class="fa fa-fw fa-photo"></i>Download JPEG</button>

              <a class="btn btn-warning btn-sm" href="{{route('shop.signage.downloadpsd')}}" style="margin-left: 15px;"><i class="fa fa-fw fa-file"></i>Sample PSD</a>
            </div>  
            <br>
            <div class="row" style="margin-left:150px;">
                <p>အလျား - ၄ ပေ ၊ အနံ - ၂ ပေ</p>
              <div id="signage" style="padding:50px;">
                <div  style="margin: auto; width: 1000px; height: 500px; background: blue;border-style: solid;border-color: black; border-radius: 5px;   border-width: medium;">
                    <div style="margin: auto; ">
                        <p style="color: #ffffff; margin-top: 220px; font-size: 55px;text-align:center; ">လိုင်စင်ရအရောင်းဆိုင်</p>
                    </div>
                    <div style="position: relative;">
                      <div align="right"  style="margin-right: 10px;" >
                          <p id="p_shop_name">
                            {{ $detail_data->shopName}}
                            {!! QrCode::size(130)->generate(URL::to('/').'/shop/getdata/'.$detail_data->id); !!}
                          </p>  
                        </div>
                    </div>
                    <div class="row">
                         <input type="hidden" id="ctr_token" value="{{ csrf_token()}}">
                    </div> 
                </div>
        </div>
        </div>
    </div>

     <div id="rep_history_tab" class="tabcontent">
        
    </div>

@stop

@section('css')

<style type="text/css">
     #p_shop_name {
        color: yellow;
        font-size: 28px;
        margin-top:  30px;
      }
    .tab {
       overflow: hidden;
       border: 1px solid #4287f5;
       background-color: #605ca8;
       color: white;
       }
       /* Style the buttons inside the tab */
       .tab button {
       background-color: inherit;
       float: left;
       border: none;
       outline: none;
       cursor: pointer;
       padding: 7px 20px;
       transition: 0.3s;
       color: white;
       }
       /* Change background color of buttons on hover */
       .tab button:hover {
       background-color: white;
       color: #605ca8;
       }
       /* Create an active/current tablink class */
       .tab button.active {
       background-color: white;
       color: #605ca8;
       }
       /* Style the tab content */
       .tabcontent {
       display: none;
       padding: 6px 12px;
       border: 1px solid #ccc;
       border-top: none;
       }
</style>
@stop

@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.js"></script>


<script type="text/javascript">

    var tab_active = <?php print_r(json_encode($tab_active)) ?>;
    if (tab_active == 4) {
        $(document).ready(function(){
           document.getElementById("account_tab").style.display = "block"; 

         $("#account").addClass("active");

        });
    }else{
        $(document).ready(function(){
            document.getElementById("shop_tab").style.display = "block"; 
             $("#shop").addClass("active");
         });
    }

     

    function openTab(evt, tabName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
   
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(tabName).style.display = "block";
      evt.currentTarget.className += " active";
      
    }

    $("document").ready(function(){
            setTimeout(function(){
                $("div.alert-success").remove();
            }, 3000 ); // 3 secs
        });

    function doCapture(){
     window.scrollTo(0,0);
     html2canvas(document.getElementById("signage")).then(function(canvas){
      $.ajax({
        type:'POST',
        url: "{{ url('save-canvas')}}",
        data: { 
            "image": canvas.toDataURL("image/jpeg",1),
            "_token": $('#ctr_token').val(),
            'shop_id':{!! $detail_data->id !!}   
        },
        // cache:false,
        // contentType: false,
        // processData: false,
        success: (data) => {
          window.location="{{route('shop.signage.downloadjpg',$detail_data->id)}}";
        },
        error: function(data){
          console.log(data);
        }
      });

   })
}

 $('#update_password').click(function(){
        var pass_val = $('#login_password').val();
        // alert(pass_val);
        if (!pass_val) {
            $('#login_password').css('border-color', 'red');
        }else{
            this.form.submit();
        }
    });

 $('#login_password').keyup(function(){
            $('#login_password').css('border-color', '#dee2e6');
        });
</script>
@stop
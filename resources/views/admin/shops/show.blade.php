@extends('adminlte::page')

@section('title', 'အရောင်းဆိုင်အချက်အလက်များ')

@section('content_header')

    <h4 class="unicode">အရောင်းဆိုင်အချက်အလက်များ</h4>

@stop
 <style type="text/css" media="screen">
     td{
        width: 50%;
     }
 </style>
@section('content')

    <?php 
            $latitude = $shop->lat; 
            $longitude= $shop->lng;
    ?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
   <!--              <a class="btn btn-success btn-sm" href="{{route('shop.downloadqr',$shop->id)}}" style="margin-left: 15px;"><i class="fa fa-fw fa-download"></i>Download QR</a> -->
                <a class="btn btn-success btn-sm" target="_blank" href="{{ route('admin.shops.print',$shop->id) }}"><i  class="fa fa-fw fa-print"></i> Print</a> 
                <a class="btn btn-primary btn-sm" href="{{ route('admin.shops.index') }}"> <i  class="fa fa-fw fa-arrow-left"></i>နောက်သို့</a> 
            </div>
        </div>
    </div>
    <br>

    <div class="panel-body">
        <div class="row">
              <div class="tab">
                <button class="tablinks"  id="shop_pp" onclick="openTab(event, 'Profile')">Profile</button>
                <button class="tablinks" onclick="openTab(event, 'Photo')">Photo</button>
                <button class="tablinks" onclick="openTab(event, 'Account')">Account</button>

                <button class="tablinks" onclick="openTab(event, 'Download')">Download File</button>
              </div>

              <div id="Profile" class="tabcontent">
                  <table class="table table-bordered" style=" margin-right: auto; margin-left: auto;">
                              <tbody>
                                <tr>
                                  <th scope="row">အရောင်းဆိုင်အမည်</th>
                                  <td>{{ $shop->shop_name}}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row">ပိုင်ရှင်/ကုမ္ပဏီ/အဖွဲ့အစည်းအမည်</th>
                                  <td>{{ $shop->owner }}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row">ကုမ္ပဏီမှတ်ပုံတင်နံပါတ်</th>
                                  <td>{{ $shop->company_no}}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row">ဖုန်းနံပါတ်</th>
                                  <td>{{ $shop->ph_no}}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row">အီးမေး</th>
                                  <td>{{ $shop->email}}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row">တိုင်းဒေသကြီး/ပြည်နယ်</th>
                                  <td>{{ $shop->statedivsion->sd_name}}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row">မြို့နယ်</th>
                                  <td>{{ $shop->township->tsh_name_mm}}</td>
                                  
                                </tr>

                                <tr>
                                  <th scope="row">တည်နေရာ</th>
                                  <td>{{ $shop->location}}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row">လိုင်စင်အမည်</th>
                                  <td></td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row">လိုင်စင်အဆင့်သတ်မှတ်ချက်</th>
                                  @if($shop->grade != null)
                                  <td>{{ dd($shop->grade)}}</td>
                                  @else
                                  <td></td>
                                  @endif
                                </tr>
                               
                                <tr>
                                  <th scope="row">ဆီအမျိုးအစား</th>
                                  <td>{{ $shop->fuel_type }}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row">ဓာတ်ဆီ</th>
                                  <td>{{ ($shop->gasoline) }} ဂါလန်</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row">ဒီဇယ်</th>
                                  <td>{{ ($shop->diesel) }} ဂါလန်</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row">သိုလှောင်မှုပမာဏ</th>
                                  <td>{{ ($shop->storage) }}  ဂါလန်</td>
                                  
                                </tr>
                               <tr>
                                  <th scope="row">ထုတ်ပေးသည့်ရက်စွဲ</th>
                                  <td>
                                        {{ date('d-m-Y', strtotime($shop->issue_date ))}}
                                  </td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row">သက်တမ်းကုန်ဆုံးရက်</th>
                                  <td>
                                        {{ date('d-m-Y', strtotime($shop->expire_date ))}}
                                  </td>
                                  
                                </tr>
                                @if($latitude!='' || $longitude!='')
                                <tr >
                                  <td colspan="2">
                                     <div id="map"></div>
                                  </td>
                                </tr>
                                @endif
                               
                              </tbody>
                    </table>
              </div>

              <div id="Photo" class="tabcontent">
                  <table class="table table-bordered" style="width: 100%; margin-right: auto; margin-left: auto;">
                              <tbody>
                                @if($shop->photo1!='')
                                <tr>
                                  <th scope="row" width="20%">ဆိုင်ပုံ</th>
                                  <td>
                                    <img id="photo1"  src="{{ asset($shop->path.'/'.$shop->photo1) }}" alt="ဓာတ်ပုံ" class="myImg" width="10%" style="border: 1px;">
                                  </td>
                                  
                                </tr>
                                @endif

                                @if($shop->photo3!='')
                                <tr>
                                  <th scope="row" width="20%">ဆိုင်ပုံ</th>
                                  <td>
                                    <img id="photo3"  src="{{ asset($shop->path.'/'.$shop->photo3) }}" alt="ဓာတ်ပုံ" class="myImg" width="10%" style="border: 1px;">
                                  </td>
                                  
                                </tr>
                                @endif
                                 @if($shop->photo4!='')
                                <tr>
                                  <th scope="row" width="20%">ဆိုင်ပုံ</th>
                                  <td>
                                    <img id="photo4"  src="{{ asset($shop->path.'/'.$shop->photo4) }}" alt="ဓာတ်ပုံ" class="myImg" width="10%" style="border: 1px;">
                                  </td>
                                  
                                </tr>
                                @endif

                                @if($shop->photo2!='')
                                 <tr>
                                  <th scope="row">ဆိုင်းဘုတ်</th>
                                    <td>
                                      <img id="photo2"  src="{{ asset($shop->path.'/'.$shop->photo2) }}" alt="ဓာတ်ပုံ" class="myImg" width="30%" style="border: 1px;">
                                    </td>
                                    
                                  </tr>
                                @endif

                                @if($shop->photo5!='')
                                 <tr>
                                  <th scope="row">ပုံ</th>
                                    <td>
                                      <img id="photo5"  src="{{ asset($shop->path.'/'.$shop->photo5) }}" alt="ဓာတ်ပုံ" class="myImg" width="30%" style="border: 1px;">
                                    </td>
                                    
                                  </tr>
                                @endif

                                @if($shop->photo6!='')
                                 <tr>
                                  <th scope="row">ပုံ</th>
                                    <td>
                                      <img id="photo6"  src="{{ asset($shop->path.'/'.$shop->photo6) }}" alt="ဓာတ်ပုံ" class="myImg" width="30%" style="border: 1px;">
                                    </td>
                                    
                                  </tr>
                                @endif

                                @if($shop->photo7!='')
                                 <tr>
                                  <th scope="row">ပုံ</th>
                                    <td>
                                      <img id="photo7"  src="{{ asset($shop->path.'/'.$shop->photo7) }}" alt="ဓာတ်ပုံ" class="myImg" width="30%" style="border: 1px;">
                                    </td>
                                    
                                  </tr>
                                @endif

                              </tbody>
                        </table>
              </div>

              <div id="Account" class="tabcontent">
                @if(isset($shop->user))
                 <form action="{{ url('admin/shop/password/reset') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $shop->user->id }}"> 
                    <div class="row">
                      <br><br>
                        <div class="form-group">
                            <label for="" class="form-label col-md-1">Login ID</label>
                            <div class="col-md-2">
                                @if(isset($shop->user))
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
                        <br>
                        <div class="form-group">
                            <label for="" class="form-label col-md-1">Password</label>
                            <div class="col-md-2">
                                <input type="password" class="form-control" name="password" id="password"  value="{{ old('password','123456') }}"   />

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                                <input type="checkbox" onclick="showPassword()">Show Password
                                <br>
                                <br>
                                <button type="submit" class="btn btn-primary btn-flat">
                                  {{ trans('adminlte::adminlte.reset_password') }}
                                </button>
                            </div>
                        </div>
                        <br>
                </form>
                @else
                  <p>No User Account Created!</p>
                @endif
              </div>
      
        </div>

        <div id="Download" class="tabcontent">
          <br>
            <div class="row">
              <a class="btn btn-primary btn-sm" href="{{route('shop.downloadqr',$shop->id)}}" style="margin-left: 15px;"><i class="fa fa-fw fa-download"></i>Download QR</a>

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
                            {{ $shop->shop_name}}
                            {!! QrCode::size(130)->generate(URL::to('/').'/shop/getdata/'.$shop->id); !!}
                          </p>  
                        </div>
                    </div>
                    <div class="row">
                        
                    </div> 
                </div>
        </div>
        </div>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
      <span class="close">&times;</span>
      <img class="modal-content" id="img01">
      <div id="caption"></div>
    </div>

 <input type="hidden" id="ctr_token" value="{{ csrf_token()}}">

@stop



@section('css')
<style>

  #p_shop_name {
    color: yellow;
    font-size: 28px;
    margin-top:  30px;
  }

img {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

img:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 70px;
  right: 50px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}

#map{ 
        height: 400px;    
        width: 100%;            
      } 

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSpa7qS1H09m10Ae2_tDYjorJuSB4Fj1Q&callback=initMap"
                    async defer></script>
<script src="{{ asset('/js/html2canvas.js') }}"></script>

<script>

    //show map view
    var map;
    function initMap() {                            
        
        var lati = '<?php echo($latitude); ?>'; // YOUR LATITUDE VALUE
        var latitude =  parseFloat(lati);
        var longi = '<?php echo($longitude); ?>'; // YOUR LONGITUDE VALUE
        var longitude = parseFloat(longi); // YOUR LONGITUDE VALUE
        var myLatLng = {lat: latitude, lng: longitude};
        
        map = new google.maps.Map(document.getElementById('map'), {
          center: myLatLng,
          zoom: 14                    
        });
                
        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          // title: 'Hello World',
          
          // setting latitude & longitude as title of the marker
          // title is shown when you hover over the marker
          title: latitude + ', ' + longitude 
        });            
    }
//----------------------------------------------
  // image modal on click and close
  
  // Get the modal
  var modal = document.getElementById("myModal");

  // Get the image and insert it inside the modal - use its "alt" text as a caption
  var img1 = document.getElementById("photo1");
  var img2 = document.getElementById("photo2");
  var img3 = document.getElementById("photo3");
  var img4 = document.getElementById("photo4");
  var img5 = document.getElementById("photo5");

  var modalImg = document.getElementById("img01");
  var captionText = document.getElementById("caption");

  if(img1!=null){
    img1.onclick = function(){
      modal.style.display = "block";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;
    }
  }

  if(img2!=null){
    img2.onclick = function(){
      modal.style.display = "block";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;
    }
  }

  if(img3!=null){
    img3.onclick = function(){
      modal.style.display = "block";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;
    }
  }

  if(img4!=null){
    img4.onclick = function(){
      modal.style.display = "block";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;
    }
  }

  if(img5!=null){
    img5.onclick = function(){
      modal.style.display = "block";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;
    }
  }


  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() { 
    modal.style.display = "none";
  }


//custom tab function

$(document).ready(function(){
  document.getElementById("Profile").style.display = "block"; 
  $("#shop_pp").addClass("active");

});

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

//----------------------------------------------
//show hide password
function showPassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}


function doCapture(){
     window.scrollTo(0,0);
     html2canvas(document.getElementById("signage")).then(function(canvas){
      $.ajax({
        type:'POST',
        url: "{{ url('save-canvas')}}",
        data: { 
            "image": canvas.toDataURL("image/jpeg",1),
            "_token": $('#ctr_token').val(),
            'shop_id':{!! $shop->id !!}   
        },
        // cache:false,
        // contentType: false,
        // processData: false,
        success: (data) => {
          window.location="{{route('shop.signage.downloadjpg',$shop->id)}}";
        },
        error: function(data){
          console.log(data);
        }
      });

   })
}
</script>
   
@stop
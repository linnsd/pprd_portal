@extends('adminlte::page')

@section('title', 'ယာဉ်ဒေတာအသေးစိတ်')

@section('content_header')

    <h4 class="unicode">ယာဉ်ဒေတာအသေးစိတ်</h4>

@stop
 <style type="text/css" media="screen">
     td{
        width: 50%;
     }
 </style>
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                @if(auth()->user()->role_id==1)
                  <a class="btn btn-info btn-sm" href="{{route('admin.car.downloadqr',$car->id)}}" style="margin-left: 15px;"><i class="fa fa-fw fa-download"></i>Download QR</a>

                   <a class="btn btn-warning btn-sm" target="_blank" href="{{ route('admin.cars.print_new',$car->id) }}"><i  class="fa fa-fw fa-print"></i> Print Front</a> 

                  <a class="btn btn-success btn-sm" target="_blank" href="{{ route('admin.cars.qr_back',$car->id) }}"><i  class="fa fa-fw fa-print"></i> Print Back</a>

                   <a class="btn btn-default btn-sm" target="_blank" href="{{ route('admin.cars.print',$car->id) }}"><i  class="fa fa-fw fa-print"></i> Print Summary</a
                @elseif(auth()->user()->role_id==3)
                  <a class="btn btn-warning btn-sm" target="_blank" href="{{ route('admin.cars.print',$car->id) }}"><i  class="fa fa-fw fa-print"></i> Print</a> 
                @endif
              
                
               
                <a class="btn btn-primary btn-sm" href="{{ route('admin.cars.index') }}"> <i  class="fa fa-fw fa-arrow-left"></i>နောက်သို့</a> 
            </div>
        </div>
    </div>
    <br>

    <div class="panel-body">
        <div class="row">
              <div class="tab">
                <button class="tablinks"  id="shop_pp" onclick="openTab(event, 'car_info')">Car Info</button>
                <button class="tablinks" onclick="openTab(event, 'Photo')">Photo</button>
                <button class="tablinks" onclick="openTab(event, 'No')">No.</button>
              </div>

              <div id="car_info" class="tabcontent">
                  <table class="table table-bordered" style=" margin-right: auto; margin-left: auto;">
                              <tbody>

                                <tr>
                                  <th scope="row">တိုင်းဒေသကြီး/ပြည်နယ်</th>
                                  <td>{{ $car->statedivisions->sd_name}}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row" style="text-align: left;">ဆီသယ်ယာဥ်/ဆီသယ်နောက်တွဲယာဥ်/ATF</th>
                                  @if($car->car_type == 1)
                                  <td>ဆီသယ်ယာဥ်</td>
                                  @elseif($car->car_type == 2)
                                  <td>ဆီသယ်နောက်တွဲယာဥ်</td>
                                   @elseif($car->car_type == 3)
                                  <td>ATF</td>
                                  @endif
                                </tr>
                                
                                <tr>
                                  <th scope="row">လိုင်စင်အမှတ်</th>
                                  <td>{{ $car->plate_no}}</td>
                                  
                                </tr>
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
                                <tr>
                                  <th scope="row">ယာဉ်မောင်းအမည်</th>
                                  <td>{{$lastdriver}}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row">ထုတ်လုပ်သည့်ကုမ္ပဏီ/မော်ဒယ်</th>
                                  <td>{{ $car->model }}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row">ယာဉ်အမျိုးအစား</th>
                                  <td>{{ $car->type}}</td>
                                  
                                </tr>
                                @if($car->car_type != 3)
                                <tr>
                                  <th scope="row">တင်ဆောင်နိုင်သည့်ပမာဏ</th>
                                  @if($car->unit_id == 1)
                                  <td>{{ number_format($car->capacity) }} ဂါလန်</td>
                                  @elseif($car->unit_id == 2)
                                  <td>{{ number_format($car->capacity) }}လီတာ </td>
                                  @elseif($car->unit_id == 3)
                                  <td>{{ number_format($car->capacity) }}KG </td>
                                  @endif
                                </tr>
                                @endif
                                <tr>
                                  <th scope="row">ယာဉ်အလေးချိန်</th>
                                  <td>{{ $car->weight }}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row">အင်ဂျင်ပါဝါ</th>
                                  <td>{{ $car->power }}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row">ထုတ်ပေးသည့်ရက်</th>
                                  <td>
                                     @if($car->issud_date!=null || $car->issud_date!='')
                                        {{ date('d-m-Y', strtotime($car->issue_date ))}}
                                      @endif
                                  </td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row">သက်တမ်းကုန်ဆုံးရက်</th>
                                  <td>
                                      @if($car->expire_date!=null || $car->issud_date!='')
                                        {{ date('d-m-Y', strtotime($car->expire_date ))}}
                                      @endif
                                  </td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row">စက်အမှတ်</th>
                                  <td>{{ $car->eng_no }}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row">ဘောင်အမှတ်</th>
                                  <td>{{ $car->chassis_no }}</td>
                                  
                        {{--         </tr>
                                 <tr>
                                  <th scope="row">ဆီသယ်ယာဉ်</th>
                                  <td>{{$car->oil_carry}}</td>
                                  
                                </tr> --}}
                               {{--  <tr>
                                  <th scope="row">ဆီသယ်နောက်တွဲယာဉ်</th>
                                  <td>{{$car->oil_carry_back}}</td>
                                  
                                </tr> --}}
                                <tr>
                                  <th scope="row">သတ္တုတွင်းဦးစီးဌာနမှခွင့်ပြုထုတ်ပေးသည့်စက်သုံးဆီသယ်ယူခွင့်ပြုမိန့်အမှတ်</th>
                                  <td>{{$car->mine_no}}</td>
                                  
                                </tr>

                                 <tr>
                                  <th scope="row">လုပ်ငန်းရှင်/ကုမ္ပဏီ/အဖွဲ့အစည်းအမည်</th>
                                  <td>{{$car->company_name}}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row">သယ်ယူပို့ဆောင်သည့်ဆီအမျိုးအစား</th>
                                  <td>{{$car->fuel_type}}</td>
                                  
                                </tr>
                                 <tr>
                                  <th scope="row">နေရပ်လိပ်စာ</th>
                                  <td>{{$car->address}}</td>
                                  
                                </tr>
                               
                              </tbody>
                    </table>
              </div>

              <div id="Photo" class="tabcontent">
                  <table class="table table-bordered" style="width: 100%; margin-right: auto; margin-left: auto;">
                              <tbody>
                                <tr>
                                  <th scope="row" width="20%">ယာဉ်မှတ်ပုံတင်စာအုပ်</th>
                                  @if($car->owner_book_photo!='')
                                  <td>
                                    <img id="owner_book_photo"  src="{{ asset($car->path.'/'.$car->owner_book_photo) }}" alt="ယာဉ်မှတ်ပုံတင်စာအုပ်" class="myImg" width="25%" style="border: 1px;">

                                    <img id="owner_book_photo"  src="{{ asset($car->path.'/'.$car->photo1) }}" alt="ယာဉ်မှတ်ပုံတင်စာအုပ်" class="myImg" width="25%" style="border: 1px;">
                                  </td>
                                  @else
                                  <td>
                                     <img id="owner_book_photo"  src="{{ asset('img/noimage.jpg') }}" alt="No Photo" class="myImg" width="25%" style="border: 1px;">
                                  </td>
                                  @endif
                                </tr>
                                <tr>
                                  <th scope="row" width="20%">ယာဉ်လိုင်စင် ရှေ့</th>
                                  @if($car->licence_photo_f!='')
                                  <td>
                                    <img id="licence_photo_f"  src="{{ asset($car->path.'/'.$car->licence_photo_f) }}" alt="ယာဉ်လိုင်စင် ရှေ့" class="myImg" width="25%" style="border: 1px;">
                                  </td>
                                  @else
                                  <td>
                                    <img id="licence_photo_f"  src="{{ asset('img/noimage.jpg') }}" alt="No Photo" class="myImg" width="25%" style="border: 1px;">
                                  </td>
                                  @endif
                                </tr>
                                <tr>
                                  <th scope="row" width="20%">ယာဉ်လိုင်စင် နောက်</th>
                                   @if($car->car_b_photo!='')
                                  <td>
                                    <img id="car_b_photo"  src="{{ asset($car->path.'/'.$car->licence_photo_b) }}" alt="ယာဉ်နောက်ယာပုံ" class="myImg" width="25%" style="border: 1px;">
                                  </td>
                                  @else
                                  <td>
                                    <img id="car_b_photo"  src="{{ asset('img/noimage.jpg') }}" alt="No Photo" class="myImg" width="25%" style="border: 1px;">
                                  </td>
                                  @endif
                                </tr>
                                <tr>
                                  <th scope="row">ယာဉ်ရှေ့ဝဲ့ပုံ</th>
                                   @if($car->car_f_photo!='')
                                    <td>
                                      <img id="photo2"  src="{{ asset($car->path.'/'.$car->car_f_photo) }}" alt="ဓာတ်ပုံ" class="myImg" width="25%" style="border: 1px;">
                                    </td>
                                    @else
                                    <td>
                                      <img id="car_f_photo"  src="{{ asset('img/noimage.jpg') }}" alt="No Photo" class="myImg" width="25%" style="border: 1px;">
                                    </td>
                                    @endif
                                  </tr>
                                  <tr>
                                  <th scope="row">ယာဉ်နောက်ယာပုံ</th>
                                  @if($car->car_b_photo!='')
                                    <td>
                                      <img id="photo5"  src="{{ asset($car->path.'/'.$car->car_b_photo) }}" alt="ဓာတ်ပုံ" class="myImg" width="25%" style="border: 1px;">
                                    </td>
                                  @else
                                  <td>
                                    <img id="car_b_photo"  src="{{ asset('img/noimage.jpg') }}" alt="No Photo" class="myImg" width="25%" style="border: 1px;">
                                  </td>
                                  @endif
                                  </tr>
                                 <th scope="row">အင်ဂျင်ခန်း</th>
                                   @if($car->eng_photo!='')
                                    <td>
                                      <img id="photo6"  src="{{ asset($car->path.'/'.$car->eng_photo) }}" alt="ဓာတ်ပုံ" class="myImg" width="25%" style="border: 1px;">
                                    </td>
                                  @else
                                  <td>
                                    <img id="eng_photo"  src="{{ asset('img/noimage.jpg') }}" alt="No Photo" class="myImg" width="25%" style="border: 1px;">
                                  </td>
                                  @endif
                                  </tr>
                                  <tr>
                                  <th scope="row">ရှေ့ခေါင်းခန်း</th>
                                  @if($car->head_room_photo!='')
                                    <td>
                                      <img id="head_room_photo"  src="{{ asset($car->path.'/'.$car->head_room_photo) }}" alt="ရှေ့ခေါင်းခန်း" class="myImg" width="25%" style="border: 1px;">
                                    </td>
                                    @else
                                    <td>
                                      <img id="head_room_photo"  src="{{ asset('img/noimage.jpg') }}" alt="No Photo" class="myImg" width="25%" style="border: 1px;">
                                    </td>
                                    @endif
                                  </tr>
                                  <tr>
                                 {{--  <th scope="row">ကညနလိုင်စင်ပုံ</th>
                                  @if($car->ka_nya_na_photo!='')
                                    <td>
                                      <img id="ka_nya_na_photo"  src="{{ asset($car->path.'/'.$car->ka_nya_na_photo) }}" alt="ကညနလိုင်စင်ပုံ" class="myImg" width="25%" style="border: 1px;">
                                    </td>
                                    @else
                                    <td>
                                      <img id="ka_nya_na_photo"  src="{{ asset('img/noimage.jpg') }}" alt="No Photo" class="myImg" width="25%" style="border: 1px;">
                                    </td>
                                    @endif
                                  </tr> --}}
                                  <tr>
                                  <th scope="row">သတ္တုတွင်းလိုင်စင်ပုံ</th>
                                 @if($car->mine_licence_photo!='')
                                    <td>
                                      <img id="mine_licence_photo"  src="{{ asset($car->path.'/'.$car->mine_licence_photo) }}" alt="သတ္တုတွင်းလိုင်စင်ပုံ" class="myImg" width="25%" style="border: 1px;">
                                    </td>
                                    @else
                                    <td>
                                     <img id="mine_licence_photo"  src="{{ asset('img/noimage.jpg') }}" alt="No Photo" class="myImg" width="25%" style="border: 1px;">
                                    </td>
                                    @endif
                                  </tr>
                              </tbody>
                        </table>
              </div>
              <div id="No" class="tabcontent">
                <form action="{{ url('admin/car/no') }}" method="POST">
                    @csrf
                    <div class="row">
                      <div class="form-group">
                        <label for="" class="form-label col-md-1">No.</label>
                        <div class="col-md-2">
                          <input type="number" name="no" id="no" value="{{ old('no',$car->no) }}" class="form-control">
                          <input type="hidden" name="car_id" id="car_id" value="{{ old('car_id',$car->id) }}" class="form-control">
                          <br>
                          <button type="submit" class="btn btn-primary btn-flat">
                                Create
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
              </div>
        </div>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
      <span class="close">&times;</span>
      <img class="modal-content" id="img01">
      <div id="caption"></div>
    </div>

@stop



@section('css')
<style>
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
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img1 = document.getElementById("owner_book_photo");
var img2 = document.getElementById("licence_photo_f");
var img3 = document.getElementById("licence_photo_b");
var img4 = document.getElementById("car_f_photo");
var img5 = document.getElementById("car_b_photo");
var img6 = document.getElementById("eng_photo");
var img7 = document.getElementById("head_room_photo");
var img8 = document.getElementById("ka_nya_na_photo");
var img9 = document.getElementById("mine_licence_photo");

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

if(img6!=null){
 img6.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
} 
}

if(img7){
  img7.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  }
}

if(img8){
  img8.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  }
}

if(img9){
  img9.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  }
}


$(document).ready(function(){
   document.getElementById("car_info").style.display = "block"; 

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
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>
   
@stop
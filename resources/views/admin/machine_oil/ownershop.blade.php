@extends('adminlte::page')

@section('title', 'ဆိုင်အချက်အလက်များ')

@section('content_header')

    <h4 class="unicode">ဆိုင်အချက်အလက်များ</h4>

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
                <a class="btn btn-success btn-sm" target="_blank" href="{{ route('admin.shops.print',$shop->id) }}"><i  class="fa fa-fw fa-print"></i> Print</a> 
{{--                   <a class="btn btn-sm btn-primary" title="ပြင်ရန်" href="{{ route('admin.shops.edit',$shop->id) }}"><i class="fa fa-fw fa-edit" /></i>Edit</a> --}}
              <a class="btn btn-primary btn-sm" href="{{route('shop.downloadqr',$shop->id)}}" style="margin-left: 15px;"><i class="fa fa-fw fa-download"></i>Download QR</a>
            </div>
        </div>
    </div>
    <br>

    <div class="panel-body">
        <div class="row">
          <div class="col-md-12" align="center">
            <div class="col-md-4"></div>
            @if($shop->photo2!='')
              <div class="col-md-4">
                       <img id="photo2"  src="{{ asset($shop->path.'/'.$shop->photo2) }}" alt="ဓာတ်ပုံ" class="myImg" width="90%" style="border: 1px;">
              </div>
            @endif
            <div class="col-md-4"></div>
          </div>  
        </div>
        <br><br>

          <div class="row">
              <div class="col-md-12">
                  <table class="table table-bordered" style="width: 80%; margin-right: auto; margin-left: auto;">
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
                                <th scope="row">လိုင်စင်အမှတ်</th>
                                <td>{{ $shop->licence_no}}</td>
                                
                              </tr>
                              <tr>
                                <th scope="row">ဆီအမျိုးအစား</th>
                                <td>{{ $shop->fuel_type }}</td>
                                
                              </tr>
                              <tr>
                                <th scope="row">သိုလှောင်မှုပမာဏ</th>
                                <td>{{ number_format($shop->storage) }}  ဂါလန်</td>
                                
                              </tr>
                             
                              <tr>
                                <th scope="row">သက်တမ်းကုန်ဆုံးရက်</th>
                                <td>
                                      {{ date('d-m-Y', strtotime($shop->expire_date ))}}
                                </td>
                                
                              </tr>
                             
                            </tbody>
                  </table>
               
              </div>
              <div class="col-md-12">
                  <div class="row">
                      <div class="form-group">
                        @if($shop->photo1!='')
                          <div class="col-md-4">
                              <span>ဆိုင်ပုံ </span>
                              <br>
                                   <img id="photo1"  src="{{ asset($shop->path.'/'.$shop->photo1) }}" alt="ဆိုင်ပုံ" class="myImg" width="90%" style="border: 1px;">
                          </div>
                        @endif

                        @if($shop->photo3!='')
                          <div class="col-md-4">
                              <span>ဆိုင်ပုံ </span>
                              <br>
                                   <img id="photo3"  src="{{ asset($shop->path.'/'.$shop->photo3) }}" alt="ဆိုင်ပုံ" class="myImg" width="90%" style="border: 1px;">
                          </div>
                        @endif


                        @if($shop->photo4!='')
                          <div class="col-md-4">
                              <span>ဆိုင်ပုံ </span>
                              <br>
                                   <img id="photo4"  src="{{ asset($shop->path.'/'.$shop->photo4) }}" alt="ဆိုင်ပုံ" class="myImg" width="90%" style="border: 1px;">
                          </div>
                        @endif

                       

                      </div>
                  </div>
                  <div class="row">
                     @if($shop->photo5!='')
                          <div class="col-md-3">
                              <span>လိုင်စင်ပုံ </span>
                              <br>
                                   <img id="photo5"  src="{{ asset($shop->path.'/'.$shop->photo5) }}" alt="ဓာတ်ပုံ" class="myImg" width="90%" style="border: 1px;">
                          </div>
                        @endif

                        @if($shop->photo6!='')
                          <div class="col-md-3">
                              <span>လိုင်စင်ပုံ </span>
                              <br>
                                   <img id="photo6"  src="{{ asset($shop->path.'/'.$shop->photo6) }}" alt="ဓာတ်ပုံ" class="myImg" width="90%" style="border: 1px;">
                          </div>
                        @endif

                        @if($shop->photo7!='')
                          <div class="col-md-3">
                              <span>လိုင်စင်ပုံ </span>
                              <br>
                                   <img id="photo7"  src="{{ asset($shop->path.'/'.$shop->photo7) }}" alt="ဓာတ်ပုံ" class="myImg" width="90%" style="border: 1px;">
                          </div>
                        @endif


                        @if($shop->photo8!='')
                          <div class="col-md-3">
                              <span>လိုင်စင်ပုံ </span>
                              <br>
                                   <img id="photo8"  src="{{ asset($shop->path.'/'.$shop->photo8) }}" alt="ဓာတ်ပုံ" class="myImg" width="90%" style="border: 1px;">
                          </div>
                        @endif
                  </div>
                  <div class="row">
                    @if($shop->photo9!='')
                      <div class="col-md-4">
                          <span>ဓာတ်ပုံ </span>
                          <br>
                               <img id="photo9"  src="{{ asset($shop->path.'/'.$shop->photo9) }}" alt="ဓာတ်ပုံ" class="myImg" width="90%" style="border: 1px;">
                      </div>
                    @endif

                     @if($shop->photo10!='')
                      <div class="col-md-4">
                          <span>ဓာတ်ပုံ </span>
                          <br>
                               <img id="photo10"  src="{{ asset($shop->path.'/'.$shop->photo10) }}" alt="ဓာတ်ပုံ" class="myImg" width="90%" style="border: 1px;">
                      </div>
                    @endif
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
  color: #ffffff;
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
</style>
 
   
@stop



@section('js')
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img1 = document.getElementById("photo1");
var img2 = document.getElementById("photo2");
var img3 = document.getElementById("photo3");
var img4 = document.getElementById("photo4");
var img5 = document.getElementById("photo5");

var img6 = document.getElementById("photo6");
var img7 = document.getElementById("photo7");
var img8 = document.getElementById("photo8");
var img9 = document.getElementById("photo9");
var img10 = document.getElementById("photo10");

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


if(img7!=null){
  img7.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  }
}


if(img8!=null){
  img8.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  }
}


if(img9!=null){
  img9.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  } 
}


if(img10!=null){
  img10.onclick = function(){
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
</script>
   
@stop
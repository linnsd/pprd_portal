@extends('frontend.layout')
<style>
.owl-item {
    width: 340px !important;
    margin-right: 30px;
}
</style>

@section('content')
  <!--================Hero Banner Area Start =================-->
  <section class="hero-banner">
    <div class="container text-center">
      <br>
      <p style="color: #3b1d82;" class="unicode">Petroleum Products Regulatory Department (PPRD)</p>   
      <img src="{{ asset('img/logo.png') }}" alt="mmia-banner" width="40%">
    </div>
  </section>
  <!--================Hero Banner Area End =================-->


   <section class="" style="padding: 30px;">
    <div class="container">
      <div class="section-intro text-center">
        <h3 class="primary-text unicode"> About Us</h3>
        <img src="{{ asset('frontend/img/home/section-style.png') }}" alt="">
      </div>
      <div class="row">
        <div class="col-lg-12 align-self-center mb-5 mb-lg-0">
          <h3 class="primary-text unicode">PPRD</h3>
          <p class="unicode" style="text-align: justify;">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. ... The purpose of lorem ipsum is to create a natural looking block of text (sentence, paragraph, page, etc.) that doesn't distract from the layout.</p>
          <br/>
          <div class="innovative-wrapper">
            <h3 class="primary-text unicode">PPRD<br class="d-none d-xl-block"> 
            </h3>
             <ul style="text-align: justify;">
               <li>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. ... The purpose of lorem ipsum is to create a natural looking block of text (sentence, paragraph, page, etc.) that doesn't distract from the layout. </li>
             </ul>
            <br>
          </div>
        </div>
        {{-- <div class="col-lg-6 pl-xl-5" align="center">
          <img src="{{ asset('img/logo.png') }}" alt="logo-banner" width="90%">
        </div> --}}
      </div>
    </div>
  </section>


  <!--================ Member singup section Start =================-->
 {{--  <section class=" bg-gray"  style="padding: 20px;">
    <div class="container">
      <div class="section-intro text-center">
        <h3 class="primary-text unicode">Invitation to Membership</h3>
        <img src="{{ asset('frontend/img/home/section-style.png') }}" alt="">
      </div>


      <div class="d-lg-flex justify-content-between">
        <div class=" mb-5 mb-lg-0">
          <p class="unicode">Naeos fames quam tempor turpiset metus. Rutrumnu convall aenean quamal penatib loremnul turpisp snam enim lisis. Tortor enean eratetia tiam noninte quisut roin. Quamin mussed felisq mi litora molesti placerat blandit. Lectuss sceleris aesent ntum mauris uada. Risusm auctorcr variusma inproin egestas disse eclass. Condim morbi eleifen leocras aenean tiam volutpa. Nullam vitaenul magnaqu eunulla orper justov. Convalli egestas varius llam lacus laut nullam ger que eleifend. Faucibus vitaenu nean convalli varius roin teger loremin.</p>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-12 text-center">
          <a class="button mr-3 mb-2 unicode" style="background: #3b1d82; color:#ffffff" href="{{ route('frontend.register') }}">Membership Sign Up</a>
        </div>
      </div>
    </div>
  </section> --}}
  <!--================ Member singup section End =================-->


  

  <!--================ Event section Start =================-->
  @if(!empty($event))
  <?php
   $date_now = date("Y-m-d"); // this format is string comparable
  ?> 

    <section class="section-padding--small" style="display: none;">
      <div class="container">
        <div class="section-intro text-center">
          <h3 class="primary-text unicode"> Up  Coming Event</h3>
          <img src="{{ asset('frontend/img/home/section-style.png') }}" alt="">
        </div>
        @if($date_now>$event[0]->date)
        <div class="row" style="margin-top: 50px;">
           <div class="section-intro text-center">
            <p class=" unicode">No Up  Coming Event</p>
          </div>
        </div>
        @else
        <div class="row">
          <div class="col-lg-6 align-self-center mb-5 mb-lg-0">
            <div class="innovative-wrapper">
              <h3 class="primary-text zawgyi"> {{ $event[0]->title }} <br class="d-none d-xl-block"> 
              </h3>
              <div class="zawgyi"> {!! $event[0]->description !!} </div>
              <br>
              <p class="zawgyi">အခ်ိန္  - {{ $event[0]->start_time}} ~ {{ $event[0]->end_time }}</p>
              <p class="zawgyi">ေန့ရက္ - {{ $event[0]->date }}</p>
              <p class="zawgyi">ေနရာ  - {{ $event[0]->venue }}</p>
              <br>
              <br>
            </div>
          </div>
          <div class="col-lg-6 pl-xl-5">

            <ul class="clockdiv text-center" id="clockdiv">
              <li class="clockdiv-single clockdiv-day">
                <h1 class="days" id="days"></h1>
                <span class="smalltext unicode">Days</span>
              </li>
              <li class="clockdiv-single clockdiv-hour">
                <h1 class="hours" id="hours"></h1>
                <span class="smalltext unicode">Hours</span>
              </li>
              <li class="clockdiv-single clockdiv-minute">
                <h1 class="minutes" id="minutes"></h1>
                <span class="smalltext unicode">Mins</span>
              </li>
            </ul>
            <div>
                <h3 id="expired" class="text-center unicode"></h3>
            </div>
            <div class="clockdiv-content text-center">
              <p class="h4 primary-text2 mb-2 zawgyi">( {{ $event[0]->date }} ) ၊ {{ $event[0]->venue }}</p>
              <!-- <a class="button button-link" href="#">Register</a> -->
               <a class="button button-header unicode" title="event register link" target="_blank" id="register" href="{{ $event[0]->link }}">Register</a>
            </div>
          </div>
        </div>
        @endif
      </div>
    </section>
  @endif
  <!--================ Event section End =================-->


  <!--================ Blog section Start =================-->
  <section class="section-padding--small bg-gray"  style="padding: 30px;display: none;">
    <div class="container">
      <div class="section-intro text-center">
        <h3 class="primary-text unicode">Latest News</h3>
        <img src="{{ asset('frontend/img/home/section-style.png') }}" alt="">
      </div>
      <br>
      <div class="row">
        @foreach($latest as $post)
          <div class="col-md-4" style="padding: 5px;">
               <div class="card-blog">
                <a href="{{ url('news/'.$post->id) }}">
                  <img class="card-img" src="{{ asset('uploads/posts/'.$post->feature_photo)}}" alt="photo">
                </a>
                <div class="blog-body">
                  <a >
                    <p class="zawgyi">{{ $post->title }} </p>
                  </a>
                   <br class="d-none d-xl-block">
                  <a href="{{ url('news/'.$post->id) }}" class="zawgyi" style="float: right;">Read More</a>
                </div>
              </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  <!--================ Blog section End =================-->
@endsection
  <script>
  // Set the date we're counting down to
  var countdown = "<?php echo $countdown; ?>";
  var countDownDate = new Date(countdown).getTime();

  // Update the count down every 1 second
  var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();
      
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
      
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
      

    // Output the result in an element with id="demo"
    if (distance > 0) {
      document.getElementById("days").innerHTML = days ;
      document.getElementById("hours").innerHTML = hours;
      document.getElementById("minutes").innerHTML = minutes;

    }
    

      
    // If the count down is over, write some text 
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("clockdiv").style.display = 'none'; 
      document.getElementById("register").style.display = 'none'; 
      document.getElementById("expired").innerHTML = "EXPIRED";
      
    }
  }, 1000);

</script>

  
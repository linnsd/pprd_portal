@extends('frontend.layout')
<style>
  .bracdcurmb-div{
    background: radial-gradient(circle farthest-side at center bottom,#0085c3,#00618d 110%);
  }
  .breadcrumb{
    margin-top: 10px;
  }
  .help-block{
      color: red;
      font-size: 12px;
  }
</style>

@section('content')

<!--================Hero Banner Area Start =================-->
  <section class="bracdcurmb-div">
    <div class="container">
      <nav aria-label="breadcrumb" class="banner-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item unicode"><a href="{{ url('/')}}">Home</a></li>
          <li class="breadcrumb-item active unicode" aria-current="page">About</li>
        </ol>
      </nav>
    </div>
  </section>
  <!--================Hero Banner Area End =================-->


  <!-- ================ contact section start ================= -->
  <section class="">
    <div class="container">
      <div class="row" style="margin:10px;">
        <div class="section-intro text-center">
          <h3 class="primary-text unicode"> About Us</h3>
          <img src="{{ asset('frontend/img/home/section-style.png') }}" alt="">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-lg-6 align-self-center mb-5 mb-lg-0">
          <h3 class="primary-text unicode">About your Website</h3>
          <p class="unicode" style="text-align: justify;">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. ... The purpose of lorem ipsum is to create a natural looking block of text (sentence, paragraph, page, etc.) that doesn't distract from the layout.</p>
          <br/>
          <div class="innovative-wrapper">
            <h3 class="primary-text unicode">Detail Description<br class="d-none d-xl-block"> 
            </h3>
             <ul style="text-align: justify;">
               <li>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. ... The purpose of lorem ipsum is to create a natural looking block of text (sentence, paragraph, page, etc.) that doesn't distract from the layout.</li><br>
             
             </ul>
            <br>
          </div>
        </div>
        <div class="col-lg-6 pl-xl-5" align="center">
          <img src="{{ asset('img/logo.png') }}" alt="mmia-banner" width="90%">
        </div>
      </div>
    </div>
  </section>
  <!-- ================ contact section end ================= -->


@endsection


  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PPRD - Petroleum Products Regulatory Department</title>
	<link rel="icon" href="{{ asset('favicon/favicon.png') }}" type="image/png">

  <link rel="stylesheet" href="{{ asset('frontend/vendors/bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/vendors/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/vendors/themify-icons/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/vendors/linericon/style.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/vendors/owl-carousel/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/vendors/owl-carousel/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/vendors/flat-icon/font/flaticon.css') }}">

  <link rel="stylesheet" href="{{ asset('frontend/css/style.css')}}">
  
  <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=pyidaungsu' />

    <style type="text/css" media="screen">
        body{
            font-family:Pyidaungsu,Yunghkio,'Masterpiece Uni Sans' !important;
        }
        .unicode{
            font-family:Pyidaungsu,Yunghkio,'Masterpiece Uni Sans' !important;
        }
        .active>.nav-link {
            color: #82daa7 !important;
        }
        .active {
            color: #82daa7 !important;
        }
    </style>
</head>
<body>

  <!--================ Header Menu Area start =================-->
  <header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container box_1620">
          <a class="navbar-brand logo_h" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}" alt="mppe" width="90">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav justify-content-end">
              <li class="nav-item {{ Request::is('/') ? 'active' : ''}} "><a class="nav-link unicode" href="{{ url('/') }}">Home</a></li> 
{{-- 
              <li class="nav-item {{ (Request::route()->getName()=='frontend.news') ? 'active' : ''}} "><a class="nav-link unicode" href="{{ url('/news') }}">News</a></li>  --}}

              <li class="nav-item {{ (Request::route()->getName()=='frontend.about') ? 'active' : ''}} "><a class="nav-link unicode" href="{{ url('/about') }}">About</a></li> 


              <li class="nav-item {{ (Request::route()->getName()=='frontend.contact') ? 'active' : ''}} "><a class="nav-link unicode" href="{{ url('contact') }}">Contact</a></li>
              {{-- <li class="nav-item">&nbsp;</li> --}}
            </ul>

           {{--  <ul class="nav-right text-center text-lg-right py-4 py-lg-0">
              <li><a class="unicode" href="{{ route('frontend.register') }}">Sign Up</a></li>
            </ul> --}}
          </div> 
        </div>
      </nav>
    </div>
  </header>
  <!--================Header Menu Area =================-->

  
                @yield('content')

  <!-- ================ start footer Area ================= -->
  <footer style="background: #111429;">
     <div style="padding: 10px;">
      <div class="container">
        <div class="row align-items-center" align="center">
          <p class="col-lg-8 col-sm-12 footer-text m-0 text-center text-lg-left unicode">
              Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <a href="https://myanmarmia.org" target="_blank">PPRD</a>
          </p>
          <div class="col-lg-4 col-sm-12 footer-social text-center text-lg-right">
            <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- ================ End footer Area ================= -->




  <script src="{{ asset('frontend/vendors/jquery/jquery-3.2.1.min.js')}}"></script>
  <script src="{{ asset('frontend/vendors/bootstrap/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('frontend/vendors/owl-carousel/owl.carousel.min.js')}}"></script>
  <script src="{{ asset('frontend/vendors/Magnific-Popup/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{ asset('frontend/js/jquery.ajaxchimp.min.js')}}"></script>
  <script src="{{ asset('frontend/js/mail-script.js')}}"></script>
  <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js')}}"></script>	
  <script src="{{ asset('frontend/js/main.js')}}"></script>



</body>
</html>
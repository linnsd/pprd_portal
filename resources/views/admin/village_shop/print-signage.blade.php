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
        #p_shop_name {
          color: yellow;
          font-size: 28px;
          position: absolute;
          bottom: 0;
          margin-left: 240px;
        }
    </style>
    <script>
          window.print();
    </script>
</head>
<body>

   <div class="container">

        <div align="center">
            <br><br><br>
            <br>
            <div class="panel-body">
                <div class="row" >
                    <div style="margin: auto; width: 1000px; height: 500px; background: blue;border-style: solid;border-color: black; border-radius: 5px;   border-width: medium;">
                    <div style="margin: auto; ">
                        <p style="color: #ffffff; margin-top: 220px; font-size: 50px;text-align:center; ">လိုင်စင်ရအရောင်းဆိုင်</p>
                    </div>
                    <div style="position: relative;">
                      <div align="right"  style="margin-right: 10px; margin-top: 90px;" >
                            <p id="p_shop_name">{{ $shop->shop_name}}</p>
                            {!! QrCode::size(100)->generate(URL::to('/').'/shop/getdata/'.$shop->id); !!}
                        </div>
                    </div>
                </div>
                </div>
              </div>
            </div>
        </div>
        
    </div>




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



   

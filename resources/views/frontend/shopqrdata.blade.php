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
        label{
          font-weight: bold;
          color: black;
        }
        img {
          border-radius: 5px;
          cursor: pointer;
          transition: 0.3s;
        }
    </style>
</head>
<body>

  <div class="container">
            <div align="center">
                <img src="{{ asset('img/logo.png') }}" width="25%">
                <br>
                <label class="unicdoe" style="font-style: bold !important;" >Petroleum Products Regulatory Department (PPRD)</label><br>
              </div>
              <br>
            <div class="row">
              @if($shop!=null)
                <div class="col-md-6">
                    <table class="table table-bordered" style=" margin-right: auto; margin-left: auto;">
                              <tbody>
                                <tr>
                                  <th scope="row" style="text-align: left;">အရောင်းဆိုင်အမည်</th>
                                  <td>{{ $shop->shop_name}}</td>
                                  
                                </tr>
                                 <tr>
                                  <th scope="row" style="text-align: left;">ပိုင်ရှင်/ကုမ္ပဏီ/အဖွဲ့အစည်းအမည်</th>
                                  <td>{{ $shop->owner}}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row" style="text-align: left;">လိုင်စင်အမှတ်</th>
                                  <td>{{ $shop->licence_no}}</td>
                                  
                                </tr>

                                <tr>
                                  <th scope="row" style="text-align: left;">ဆီအမျိုးအစား</th>
                                  <td>{{ $shop->fuel_type}}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row" style="text-align: left;">သိုလှောင်မှုပမာဏ</th>
                                  <td> {{ number_format((int)$shop->storage)}} ဂါလန်</td>
                                  
                                </tr>
      
                                <tr>
                                  <th scope="row" style="text-align: left;">သက်တမ်းကုန်ဆုံးရက်</th>
                                  <td>{{ date('d-m-Y', strtotime($shop->expire_date ))}}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row" style="text-align: left;">တည်နေရာ</th>
                                  <td>{{ $shop->location }}</td>
                                  
                                </tr>
                              </tbody>
                            </table>

                   
                </div>
                <div class="col-md-6">
                    <div class="row">
                            @if($shop->photo1!='')
                            <div class="col-md-4">
                                
                                <br>
                                     <img id="photo1"  src="{{ asset($shop->path.'/'.$shop->photo1) }}" alt="ဓာတ်ပုံ" class="myImg" width="80%" style="border: 1px; margin:auto">
                            </div>
                          @endif

                          {{-- @if($shop->photo2!='')
                            <div class="col-md-4">
                                
                                <br>
                                     <img id="photo2"  src="{{ asset($shop->path.'/'.$shop->photo2) }}" alt="ဓာတ်ပုံ" class="myImg" width="80%" style="border: 1px; margin:auto">
                            </div>
                          @endif --}}

                          @if($shop->photo3!='')
                            <div class="col-md-4">
                                
                                <br>
                                     <img id="photo3"  src="{{ asset($shop->path.'/'.$shop->photo3) }}" alt="ဓာတ်ပုံ" class="myImg" width="80%" style="border: 1px; margin:auto">
                            </div>
                          @endif

                          @if($shop->photo4!='')
                            <div class="col-md-4">
                                
                                 <br>
                                     <img id="photo4"  src="{{ asset($shop->path.'/'.$shop->photo4) }}" alt="ဓာတ်ပုံ" class="myImg" width="80%" style="border: 1px; margin:auto">
                            </div>
                          @endif

                          @if($shop->photo5!='')
                            <div class="col-md-4">
                               
                                 <br>
                                     <img id="photo5"  src="{{ asset($shop->path.'/'.$shop->photo5) }}" alt="ဓာတ်ပုံ" class="myImg" width="80%" style="border: 1px; margin:auto">
                            </div>
                          @endif

                           @if($shop->photo6!='')
                            <div class="col-md-4">
                               
                                 <br>
                                     <img id="photo6"  src="{{ asset($shop->path.'/'.$shop->photo6) }}" alt="ဓာတ်ပုံ" class="myImg" width="80%" style="border: 1px; margin:auto">
                            </div>
                          @endif
                    </div>
              @else
                <div class="col-md-12">
                  <p style="text-align: center">No data found.</p>
                </div>
              @endif
    
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



   

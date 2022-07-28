<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PPRD - Petroleum Products Regulatory Department</title>
  <link rel="icon" href="{{ asset('favicon/favicon.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('frontend/vendors/bootstrap/bootstrap.min.css') }}">
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
        tr,th{
          text-align: left !important;
        }
    </style>
    <script>
          window.print();
    </script>
</head>
<body>

   <div class="container">

        <div align="center">
            <img src="{{ asset('img/logo.png') }}" width="10%"><br>
            <label style="font-style: bold !important;" >Petroleum Products Regulatory Department (PPRD)</label>
            <br>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! QrCode::size(200)->generate(URL::to('/').'/'.$hashids.'/s'); !!}
                    </div>
                    <div class="col-md-12" >
                        <div class="row" align="center">
                            <table class="table table-bordered" style="width: 50%; margin-right: auto; margin-left: auto;">
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
                                  <td>{{ number_format($shop->storage) }} ဂါလန်</td>
                                  
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
                    </div>
                    
                   
                </div>
            </div>
        </div>
        
    </div>
  <script src="{{ asset('frontend/vendors/jquery/jquery-3.2.1.min.js')}}"></script>
  <script src="{{ asset('frontend/vendors/bootstrap/bootstrap.bundle.min.js')}}"></script>
</body>
</html>



   

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
              @if($car!=null)
                <div class="col-md-6">
                    <table class="table table-bordered" style=" margin-right: auto; margin-left: auto;">
                              <tbody>
                                 <tr>
                                  <th scope="row" style="text-align: left;">ဆီသယ်ယာဥ်/ဆီသယ်နောက်တွဲယာဥ်/ATF</th>
                                  @if($car->car_type == 1)
                                  <td> ဆီသယ်ယာဥ်</td>
                                  @elseif($car->car_type == 2)
                                  <td> ဆီသယ်နောက်တွဲယာဥ်</td>
                                  @elseif($car->car_type == 3)
                                  <td> ATF</td>
                                  @endif
                                </tr>
                                {{-- <tr>
                                  <th scope="row" style="text-align: left;">တိုင်းဒေသကြီးအမည်</th>
                                  <td>{{ $car->statedivisions->sd_name}}</td>
                                  
                                </tr> --}}
                                 <tr>
                                  <th scope="row" style="text-align: left;">ယာဉ်အမှတ်</th>
                                  <td>{{ $car->plate_no}}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row" style="text-align: left;">ထုတ်လုပ်သည့်ကုမ္ပဏီ/မော်ဒယ်</th>
                                  <td>{{ $car->model}}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row" style="text-align: left;">ယာဉ်အမျိုးအစား</th>
                                  <td>{{ $car->type}}</td>
                                  
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
                                  <th scope="row" style="text-align: left;">တင်ဆောင်နိုင်သည့်ပမာဏ</th>
                                  @if($car->unit_id == 1)
                                  <td>{{ number_format($car->capacity) }} gallons</td>
                                  @elseif($car->unit_id == 2)
                                  <td>{{ number_format($car->capacity) }} liters</td>
                                  @elseif($car->unit_id == 3)
                                  <td>{{ number_format($car->capacity) }} Kg</td>
                                  @endif
                                </tr>

                                @if($car->car_type==1)
                                <tr>
                                  <th scope="row" style="text-align: left;">ယာဉ်အလေးချိန်</th>
                                  <td>{{ $car->weight }} </td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row" style="text-align: left;">အင်ဂျင်ပါဝါ</th>
                                  <td>{{$car->power }} </td>
                                  
                                </tr>
                                @endif
                                <tr>
                                  <th scope="row">ထုတ်ပေးသည့်ရက်</th>
                                  <td>
                                        {{ date('d-m-Y', strtotime($car->issue_date ))}}
                                  </td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row" style="text-align: left;">သက်တမ်းကုန်ဆုံးရက်</th>
                                  <td>{{ date('d-m-Y', strtotime($car->expire_date ))}}</td>
                                  
                                </tr>
                                @if($car->car_type==1)
                                <tr>
                                  <th scope="row" style="text-align: left;">စက်အမှတ်</th>
                                  <td>{{ $car->eng_no }}</td>
                                  
                                </tr>
                                @endif
                                <tr>
                                  <th scope="row" style="text-align: left;">ဘောင်အမှတ်</th>
                                  <td>{{ $car->chassis_no }}</td>
                                  
                                </tr>
                               
                                <tr>
                                  <th scope="row">သတ္တုတွင်းခွင့်ပြုမိန့်အမှတ်</th>
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
                <div class="col-md-6">
                    <div class="row">
                            <div class="col-md-4">
                                <span>ယာဉ်မှတ်ပုံတင်စာအုပ် </span>
                                    @if($car->owner_book_photo!='')
                                      <img src="{{ asset($car->path.'/'.$car->owner_book_photo) }}" alt="ယာဉ်မှတ်ပုံတင်စာအုပ်" width="90%" style="border: 1px;">
                                    @else
                                       <img  src="{{ asset('img/noimage.jpg') }}" alt="ယာဉ်ရှေ့ဝဲ့ပုံ" class="myImg" width="25%" style="border: 1px;">
                                    @endif
                                   <br><br>
                            </div>
                           
                            <div class="col-md-4">
                                <span>ယာဉ်လိုင်စင် ရှေ့</span><br>
                               
                                  @if($car->licence_photo_f!='')
                                       <img src="{{ asset($car->path.'/'.$car->licence_photo_f) }}" alt="ယာဉ်လိုင်စင် ရှေ့" width="90%" style="border: 1px;">
                                  @else
                                     <img  src="{{ asset('img/noimage.jpg') }}" alt="ယာဉ်ရှေ့ဝဲ့ပုံ" class="myImg" width="25%" style="border: 1px;">
                                  @endif
                                 <br> <br>
                                 
                            </div>
                           
                            <div class="col-md-4">
                                 <span>ယာဉ်လိုင်စင် နောက်</span><br>
                                  @if($car->licence_photo_b!='')
                                       <img src="{{ asset($car->path.'/'.$car->licence_photo_b) }}" alt="ယာဉ်လိုင်စင် နောက်" width="90%" style="border: 1px;">
                                  @else
                                     <img  src="{{ asset('img/noimage.jpg') }}" alt="ယာဉ်လိုင်စင် နောက်" class="myImg" width="25%" style="border: 1px;">
                                  @endif
                                 <br> <br>
                                 
                            </div>
                            <br>
                    </div>
                    <br>
                    <div class="row">
                            <div class="col-md-3">
                                <span>ယာဉ်ရှေ့ဝဲ့ပုံ</span><br>
                                  @if($car->car_f_photo!='')
                                   <img src="{{ asset($car->path.'/'.$car->car_f_photo) }}" alt="ယာဉ်ရှေ့ဝဲ့ပုံ" width="90%" style="border: 1px;">
                                  @else
                                     <img  src="{{ asset('img/noimage.jpg') }}" alt="ယာဉ်ရှေ့ဝဲ့ပုံ" class="myImg" width="25%" style="border: 1px;">
                                  @endif
                                 
                                 <br><br>
                                 
                            </div>
                            <div class="col-md-3">
                                 <span>ယာဉ်နောက်ယာပုံ</span><br>
                                  @if($car->car_b_photo!='')
                                       <img src="{{ asset($car->path.'/'.$car->car_b_photo) }}" alt="ယာဉ်နောက်ယာပုံ" width="90%" style="border: 1px;">
                                  @else
                                     <img  src="{{ asset('img/noimage.jpg') }}" alt="ယာဉ်ရှေ့ဝဲ့ပုံ" class="myImg" width="25%" style="border: 1px;">
                                  @endif
                               
                                 <br><br>
                                 
                            </div>
 
                            <div class="col-md-3">
                                <span>အင်ဂျင်ခန်း</span><br>
                                  @if($car->eng_photo!='')
                                       <img src="{{ asset($car->path.'/'.$car->eng_photo) }}" alt="အင်ဂျင်ခန်း" width="90%" style="border: 1px;">
                                  @else
                                     <img  src="{{ asset('img/noimage.jpg') }}" alt="ယာဉ်ရှေ့ဝဲ့ပုံ" class="myImg" width="25%" style="border: 1px;">
                                  @endif
                                  <br><br>
                               
                            </div>

                            <div class="col-md-3">
                                 <span>ရှေ့ခေါင်းခန်း</span><br>
                                  @if($car->head_room_photo!='')
                                       <img src="{{ asset($car->path.'/'.$car->head_room_photo) }}" alt="ရှေ့ခေါင်းခန်း" width="90%" style="border: 1px;">
                                  @else
                                     <img  src="{{ asset('img/noimage.jpg') }}" alt="ယာဉ်ရှေ့ဝဲ့ပုံ" class="myImg" width="25%" style="border: 1px;">
                                  @endif
                                  <br><br>
                            </div>
                    </div>
                    <br>
                    <div class="row">
                     
                       {{--  <div class="col-md-4">
                                <span>ကညနလိုင်စင်ပုံ</span><br>
                              
                                  @if($car->ka_nya_na_photo!='')
                                     <img id="ka_nya_na_photo"  src="{{ asset($car->path.'/'.$car->ka_nya_na_photo) }}" alt="ကညနလိုင်စင်ပုံ" class="myImg" width="90%" style="border: 1px;">
                                  @else
                                    <img id="ka_nya_na_photo"  src="{{ asset('img/noimage.jpg') }}" alt="No Photo" class="myImg" width="50%" style="border: 1px;">
                                  @endif
                                 
                            </div> --}}
                            <div class="col-md-4">
                                <span>သတ္တုတွင်းလိုင်စင်ပုံ</span><br>
                              
                                  @if($car->mine_licence_photo!='')
                                     <img id="mine_licence_photo"  src="{{ asset($car->path.'/'.$car->mine_licence_photo) }}" alt="သတ္တုတွင်းလိုင်စင်ပုံ" class="myImg" width="90%" style="border: 1px;">
                                  @else
                                    <img id="mine_licence_photo"  src="{{ asset('img/noimage.jpg') }}" alt="No Photo" class="myImg" width="50%" style="border: 1px;">
                                  @endif
                                 
                            </div>
                     
                </div>
                    <br>
              @else
                <div class="col-md-12 text-cener">
                  <p style="text-align: center">No Data found</p>
                </div>

              @endif
    
            </div>
  </div>
  @php  
  $expireddate =null;
  @endphp
  @if($car!=null)
    @php

        $now = time(); // or your date as well
        $expdate = strtotime($car->expire_date);
        $datediff = $expdate - $now;
        $days = round($datediff / (60 * 60 * 24));

        $expired = $now - $expdate;
        $expireddate = round($datediff / (60 * 60 * 24));    
         
    @endphp
  @endif   

  <script>
     if(expireddate!=null){
        var expdate = {{ json_encode($expireddate)}};
          if(expdate<60 && expdate>0){
          alert('ရေနံနှင့်ရေနံထွက်ပစ္စည်းသယ်ယူပို့ဆောင်ခြင်းကြီးကြပ်လက်မှတ် သက်တမ်း ကုန်ဆုံးတော့မည်။');
        }else if(expdate<0){
          alert('ရေနံနှင့်ရေနံထွက်ပစ္စည်းသယ်ယူပို့ဆောင်ခြင်းကြီးကြပ်လက်မှတ် သက်တမ်း ကုန်ဆုံးနေပါသည်။ ')
        }
     } 

  </script>

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



   

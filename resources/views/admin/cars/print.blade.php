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
                        {!! QrCode::size(200)->generate(URL::to('/').'/'.$hashids.'/c'); !!}
                    </div>
                    <div class="col-md-12" >
                        <div class="row" align="center">
                            <table class="table table-bordered" style="width: 50%; margin-right: auto; margin-left: auto;">
                              <tbody>
                                <tr>
                                  <th scope="row" style="text-align: left;">တိုင်းဒေသကြီး/ပြည်နယ်</th>
                                  <td>{{ $car->statedivisions->sd_name}}</td>
                                  
                                </tr>
                                
                                <tr>
                                  <th scope="row" style="text-align: left;">ဆီသယ်ယာဉ်/ဆီသယ်နောက်တွဲယာဉ်</th>
                                  @if($car->car_type == 1)
                                  <td>ဆီသယ်ယာဉ်</td>
                                  @elseif($car->car_type == 2)
                                  <td>ဆီသယ်နောက်တွဲယာဉ်</td>
                                  @elseif($car->car_type == 3)
                                  <td>ATF</td>
                                  @endif
                                </tr>

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
                                @if($car->car_type != 3)
                                <tr>
                                  <th scope="row" style="text-align: left;">တင်ဆောင်နိုင်သည့်ပမာဏ</th>
                                  @if($car->unit_id ==1)
                                  <td>{{ number_format($car->capacity) }} ဂါလန်</td>
                                  @elseif($car->unit_id ==2)
                                   <td>{{ number_format($car->capacity) }} လီတာ</td>
                                  @else
                                    <td>{{ number_format($car->capacity) }} KG</td>
                                  @endif
                                  
                                </tr>
                                @endif
                               {{--  <tr>
                                  <th scope="row" style="text-align: left;">ယာဉ်အလေးချိန်</th>
                                  <td>{{ $car->weight }}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row" style="text-align: left;">အင်ဂျင်ပါဝါ</th>
                                  <td>{{ $car->power }} </td>
                                  
                                </tr> --}}
                                <tr>
                                  <th scope="row">ထုတ်ပေးသည့်ရက်</th>
                                  <td>
                                      @if($car->issud_date!=null || $car->issud_date!='')
                                        {{ date('d-m-Y', strtotime($car->issue_date ))}}
                                      @endif
                                  </td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row" style="text-align: left;">သက်တမ်းကုန်ဆုံးရက်</th>
                                  <td>
                                    @if($car->expire_date!=null || $car->expire_date!='')
                                    {{ date('d-m-Y', strtotime($car->expire_date ))}}
                                    @endif
                                  </td>
                                  
                                </tr>
                                @if($car->car_type == 1 ||$car->car_type == 3 )
                                <tr>
                                  <th scope="row" style="text-align: left;">စက်အမှတ်</th>
                                  <td>{{ $car->eng_no }}</td>
                                  
                                </tr>
                                @endif
                                
                                <tr>
                                  <th scope="row" style="text-align: left;">ဘောင်အမှတ်</th>
                                  <td>{{ $car->chassis_no }}</td>
                                  
                                {{-- </tr>
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
                    </div>
                    
                   
                </div>
            </div>
        </div>
        
    </div>
  <script src="{{ asset('frontend/vendors/jquery/jquery-3.2.1.min.js')}}"></script>
  <script src="{{ asset('frontend/vendors/bootstrap/bootstrap.bundle.min.js')}}"></script>
</body>
</html>



   

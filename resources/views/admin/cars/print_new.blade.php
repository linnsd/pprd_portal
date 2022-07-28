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

   <style type="text/css" >

        body{
            font-family:Pyidaungsu,Yunghkio,'Masterpiece Uni Sans' !important;

        }

        .unicode{
            font-family:Pyidaungsu,Yunghkio,'Masterpiece Uni Sans' !important;
        }

        @media print {
          body {
            -webkit-print-color-adjust: exact;
            color-adjust: exact !important;  
          }
        }

        body {
          padding: 10px 0;
        }

        @page {
            size:A5 landscape;
            margin-left: 0px;
            margin-right: 0px;
            margin-top: 0px;
            margin-bottom: 0px;
            margin: 0;
            -webkit-print-color-adjust: exact;
        }



        .container {
            position: relative;
            z-index: 1;
            /*background: red;*/
          }
        .container .bg {
            visibility: visible;
            position: absolute;
            z-index:99;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: url({{asset('img/logo.png')}}) center center;
            opacity: .3;
            width: 100%;
            height: 100%;
            background-repeat: no-repeat;
            background-position: center;
            background-size: 600px 600px;
            /*background-color: rgba(255, 243, 205,1);*/
            /*background-color:rgba(255, 243, 205,  1);*/
          }

        @media print {
            * {
                -webkit-print-color-adjust: exact;
            }
        }

        #printrow::before {
            content: "";
            position: absolute;
            top: 0px;
            right: 0px;
            bottom: 0px;
            left: 0px;
        }
        input[type="text"]
          {
              background: rgba(0, 0, 0, 0);
              width:450px;outline: 0;border-width: 0 0 2px;
              border-bottom-style: dashed;
              text-align: center; 
              overflow-wrap: break-word
          }
          textarea{
            background: rgba(0, 0, 0, 0);
              width:450px;outline: 0;border-width: 0 0 2px;
              border-bottom-style: dashed;
              text-align: center; 
              overflow-wrap: break-word
          }
    </style>
    <script>
          window.print();
    </script>
</head>
<body>

  <?php 
        $mm_num = ['၀','၁', '၂', '၃', '၄', '၅', '၆','၇','၈','၉'];
        $en_num = range(0, 9);

?>

<div class="container">
   
  <div class="justify-content-center next-container" style="border-radius: 1px;border-style: groove;border-width: 10px; margin:5px;padding: 10px;width: 100%;height:670px;background-color:rgba(255, 243, 205,1) ">
   <div class="bg"></div>

    <div class="row">
      <div style="width:10%;padding-left: 10px;">
        <p>No.{{$car->no}}</p>
      </div>
      <div style="width:70%">
         <h4 style="text-align: center; color: black;margin-top: 70px;">ရေနံနှင့်ရေနံထွက်ပစ္စည်းသယ်ယူပို့ဆောင်ခြင်းကြီးကြပ်လက်မှတ်</h4>
      </div>
      <div style="width:20%">
         <div style="margin-left: 40px;">
            {!! QrCode::size(145)->backgroundColor(255, 243, 205)->generate(URL::to('/').'/'.$hashids.'/c'); !!}
         </div>
      </div>
    </div>
    <div class="row" style="margin-top: 5px; padding-left: 10px;">
      <div style="width:30%;margin-left: 10px;">
        <p>ပိုင်ရှင်/ကုမ္ပဏီ/အဖွဲ့အစည်းအမည်</p>
      </div>
      <div  style="margin-left: 150px;">
        <input type="text" value="{{ $car->company_name }}" readonly>
      </div>
    </div>
    <div class="row" style="padding-left: 10px;">
      <div style="width:30%;margin-left: 10px;">
        <p>သယ်ယူပို့ဆောင့်သည့်ဆီအမျိုးအစား</p>
      </div>
      <div style="margin-left: 150px;">
        <!-- <label>{{ $car->fuel_type }}</label> -->
        <input type="text" value="{{ $car->fuel_type }}" readonly>
      </div>
    </div>
    <div class="row" style="padding-left: 10px;">
      <div style="width:30%;margin-left: 10px;">
        <p>ယာဉ်အမှတ်</p>
      </div>
      <div style="margin-left: 150px;">
        <input type="text" value="{{ $car->plate_no }}" readonly>
        <!-- <label>{{ $car->plate_no }}</label> -->
      </div>
    </div>
    <div class="row" style="padding-left: 10px;">
      <div style="width:30%;margin-left: 10px;">
        <p>ယာဉ်အမျိုးအစား</p>
      </div>
      <div style="margin-left: 150px;">
        <input type="text" value="{{ $car->type }}" readonly>
      </div>
    </div>
    <div class="row" style="padding-left: 10px;">
      <div style="width:30%;margin-left: 10px;">
        <p>ဝင်ဆံ့ပမာဏ</p>
      </div>
      <div style="margin-left: 150px;">

        @php
          $unit = '';
          if($car->unit_id ==1){
            $unit = 'ဂါလန်';
          }else{
            $unit = 'လီတာ';
          }

          $capacity =  str_replace($en_num, $mm_num, $car->capacity);

        @endphp
        <!-- <input type="text" value="{{ $capacity }} {{ $unit }}" readonly style="width:550px;outline: 0;border-width: 0 0 2px;"> -->
        <!-- <label>{{ $capacity }} {{ $unit }}</label> -->
        <input type="text" value="{{ $capacity }}{{ $unit }}" readonly>
      </div>
    </div>
    <div class="row" style="padding-left: 10px;">
      <div style="width:30%;margin-left: 10px;">
        <p>နေရပ်လိပ်စာ</p>
      </div>
      <div style="margin-left: 150px;">
        <!-- <input type="text" value="{{ $car->address}}" readonly > -->
        <textarea >{{ $car->address}}</textarea>
        <!-- <label>{{ $car->address}}</label> -->
      </div>
    </div>
    <div class="row" style="padding-left: 10px;">
      <div style="width:30%;margin-left: 10px;">
        <p>ထုတ်ပေးသည့်ရက်</p>
      </div>
      <div style="margin-left: 150px;">
         <?php
              $issue_date =date('d-m-Y',strtotime($car->issue_date));
              $issue_date =  str_replace($en_num, $mm_num, $issue_date);
          ?> 
        <!-- <input type="text" value="{{ $issue_date }}" readonly style="width:550px;outline: 0;border-width: 0 0 2px;"> -->
        <input type="text" value="{{ $issue_date}}" readonly>
      </div>
    </div>

    <div class="row" style="padding-left: 10px;">
      <div style="width:30%;margin-left: 10px;">
        <p>သက်တမ်းကုန်ဆုံးရက်</p>
      </div>
      <div style="margin-left: 150px;">
         <?php
              $expire_date =date('d-m-Y',strtotime($car->expire_date));
              $expire_date =  str_replace($en_num, $mm_num, $expire_date);
          ?> 
        <!-- <input type="text" value="{{ $expire_date}}" readonly style="width:550px;outline: 0;border-width: 0 0 2px; color: red;"> -->
        <input type="text" value="{{ $expire_date}}" readonly>
      </div>
    </div>
    
    <br>
    <br>
    <br>
    <div class="row" style="padding-left: 10px;">
      <div style="width:60%;">
        <?php
              $issue_date =date('d-m-Y',strtotime($car->issue_date));
              $issue_date =  str_replace($en_num, $mm_num, $issue_date);
        ?>
       <!--  <p>ရက်စွဲ၊  {{ $issue_date }}</p> -->
       <div class="row" style="margin-left: 5px;">
         <p>ရက်စွဲ၊</p>
         <input type="text" value="{{ $issue_date}}" readonly style="background: rgba(0, 0, 0, 0);
              width:100px;outline: 0;border-width: 0 0 2px;
              border-bottom-style: dashed;margin-bottom: 13px;
              ">
       </div>
       
      </div>
      <div style="width:40%;text-align:center;">
        <p style="text-align:center;">ကြီးကြပ်စစ်ဆေးရေးအရာရှိချုပ်</p>
         <p style="text-align:center;">ရေနံထွက်ပစ္စည်းကြီးကြပ်စစ်ဆေးရေးဌာန</p>
      </div>
    </div>

  </div>
</div>

  <script src="{{ asset('frontend/vendors/jquery/jquery-3.2.1.min.js')}}"></script>
  <script src="{{ asset('frontend/vendors/bootstrap/bootstrap.bundle.min.js')}}"></script>
</body>
</html>



   

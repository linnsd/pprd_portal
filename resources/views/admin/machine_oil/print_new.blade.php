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
       /* #printdiv{
          margin-top: 10px;
          margin-bottom: 10px;
          background:url({{asset('img/logo.png')}});
          background-repeat: no-repeat;
          background-attachment: fixed;
          background-position: center;
          opacity: 0.3;
          background-size: 300px 300px;
        }*/

        body {
          /*background: #e3e3e3;*/
          padding: 50px 0;
        }
        .my-container {
            position: relative;
            background: #696969;
            overflow: hidden;
        }
        .my-container h1 {
            padding: 10px;
            text-align: center;
            z-index: 2;
            position: relative;
            color: #000;
        } 
        .my-container img {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: auto;
            z-index: 1;
            opacity: 0.5;
        }
    </style>
    <script>
          // window.print();
    </script>
</head>
<body>

<div class="container">
    <div class="row">
      <div class="col-md-2">
         <p>No: 00001</p>
      </div>
      <div class="col-md-8 text-center">
         <h5 style="text-align: center; margin-top: 100px;">ရေနံနှင့်ရေနံထွက်ပစ္စည်းသယ်ယူပို့ဆောင်ခြင်းကြီးကြပ်လက်မှတ်</h5>
      </div>
      <div class="col-md-2">
          {!! QrCode::size(150)->generate(URL::to('/').'/'.$hashids.'/s'); !!}
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <p>ပိုင်ရှင်/ကုမ္ပဏီ/အဖွဲ့အစည်းအမည်</p>
      </div>
      <div class="col-md-6">
        <input type="text" value="">
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <p>သယ်ယူပို့ဆောင့်သည့်ဆီအမျိုးအစား</p>
      </div>
      <div class="col-md-6"></div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <p>ယာဉ်အမှတ်</p>
      </div>
      <div class="col-md-6"></div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <p>ယာဉ်အမျိုးအစား</p>
      </div>
      <div class="col-md-6"></div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <p>ဝင်ဆံ့ပမာဏ</p>
      </div>
      <div class="col-md-6"></div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <p>နေရပ်လိပ်စာ</p>
      </div>
      <div class="col-md-6"></div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <p>ထုတ်ပေးသည့်ရက်</p>
      </div>
      <div class="col-md-6"></div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <p>သက်တမ်းကုန်ဆုံးရက်</p>
      </div>
      <div class="col-md-6"></div>
    </div>


</div>

  <script src="{{ asset('frontend/vendors/jquery/jquery-3.2.1.min.js')}}"></script>
  <script src="{{ asset('frontend/vendors/bootstrap/bootstrap.bundle.min.js')}}"></script>
</body>
</html>



   

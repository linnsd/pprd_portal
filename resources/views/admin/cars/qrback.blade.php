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
       


        
        /*#printrow { 
            position: relative; 
            height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url({{asset('img/logo.png')}});
            background-size: cover;
        }*/

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
            /*background-color: rgba(0,0,0,0.25);*/
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
  <div class="justify-content-center next-container" style="border-radius: 1px;border-style: groove;border-width: 10px; padding: 10px;width: 100%;height:670px;background: rgb(255, 243, 205);">

      
    <div class="row">
      <div style="width: 85%;">
        <h5 style="text-align: center;margin-top: 10px;">လိုက်နာရမည့်စည်းကမ်းချက်များ</h5>
        <div class="row" style="margin-left: 30px;">
            <p style="width: 30px;">၁။</p>
            <p style="font-size: 14px;">ဤလတ်မှတ်ရရှိသည့် ပုဂ္ဂလိကလုပ်ငန်းရှင်၊ကုမ္ပဏီ၊အဖွဲ့အစည်းမှအပအခြားတစ်ဦးဦးသို့ လွှဲပြောင်းခြင်းမပြုရ။</p>
        </div>
        <div class="row" style="margin-left: 30px;">
            <p style="width: 30px;">၂။</p>
            <p style="font-size: 14px;">ဤလတ်မှတ်သည် ပိုင်ဆိုင်မှုနှင့်သက်ဆိုင်မှုမရှိစေရ။</p>
        </div>
        
       
      </div>
      {!! QrCode::size(120)->backgroundColor(255, 243, 205)->generate(URL::to('/').'/'.$hashids.'/s'); !!}
    </div>
    <div style="padding-right: 20px;">
      <div class="row" style="margin-left: 15px;">
          <p style="width: 30px;">၃။</p>
          <p style="width: 96%;font-size: 15px;">ဤလတ်မှတ်ရရှိသူသည် နိုင်ငံတော်မှပြဌာန်းထုတ်ပြန်ထားသည့် တည်ဆဲဥပဒေ၊နည်းဥပဒေ၊  အမိန့်နှင့်ညွှန်ကြားချက်များကို တိကျစွာလိုက်နာရမည်။</p>
      </div>
     <div class="row" style="margin-left: 15px;">
            <p style="width: 30px;">၄။</p>
            <p style="font-size: 14px;">လုံခြုံရေးနှင့် မီးဘေးအန္တရယ်ကင်းရှင်းရေးအတွက် လိုအပ်သည့်အစီအမံများပြည့်စုံစွာစီမံဆောင်ရွက်ရမည်။</p>
        </div>
        <div class="row" style="margin-left: 15px;">
            <p style="width: 30px;">၅။</p>
            <p style="font-size: 14px;">ဤလတ်မှတ်ပါရှိမှသာရေနံနှင့်ရေနံထွက်ပစ္စည်းသယ်ယူပို့ဆောင်ခွင့်ပြုမည်။</p>
        </div>
        <div class="row" style="margin-left: 15px;">
            <p style="width: 30px;">၆။</p>
            <p style="width: 90%;font-size: 14px;">ရေနံနှင့်ရေနံထွက်ပစ္စည်းသယ်ယူပို့ဆောင်ရာတွင် ပတ်ဝန်းကျင် လေထု၊မြေထု၊ ရေထု ညစ်ညမ်းမှုမဖြစ်ပေါ်စေရန်အတွက် အထူးဂရုပြုဆောင်ရွက်ရမည်။</p>
        </div>
        <div class="row" style="margin-left: 15px;">
            <p style="width: 30px;">၇။</p>
            <p style="width: 94%;font-size: 14px;">ဤလတ်မှတ်သက်တမ်းတိုးမြှင့်ခြင်းအား သက်တမ်းကုန်ဆုံးရက်မတိုင်မီ နီးစပ်ရာ တိုင်းဒေသကြီး သို့မဟုတ် ပြည်နယ်ကြီးကြပ်စစ်ဆေးရေး အရာရှိရုံးတွင် အပြီးတင်ပြဆောင်ရွက်ရမည်။</p>
        </div>
        <div class="row" style="margin-left: 15px;">
            <p style="width: 30px;">၈။</p>
            <p style="width: 94%;font-size: 14px;">ဤလက်မှတ်ထုတ်ယူခြင်း၊ သက်တမ်းတိုးခြင်းများအတွက် သတ်မှတ်ကျသင့်နှုန်းထားများပေးဆောင်ရမည်ဖြစ်ပြီး ပျက်စီး/ပျောက်ဆုံးမှုများအတွက် လက်မှတ်အသစ်လျှောက်ထားထုတ်ယူခြင်းအားသတ်မှတ်ဒဏ်ကြေးများပေးဆောင်ရမည်။</p>
        </div>
        <div class="row" style="margin-left: 15px;">
            <p style="width: 30px;">၉။</p>
            <p style="width: 94%;font-size: 14px;">လမ်း/တံတားဖြတ်သန်းအသုံးပြုရာတွင် ဆောက်လုပ်ရေးဝန်ကြီးဌာနမှ ထုတ်ပြန်ထားသောလမ်း/တံတားဆိုင်ရာ စည်းမျဉ်း၊ စည်းကမ်းများနှင့်အညီလိုက်နာဆောင်ရွက်ရမည်။</p>
        </div>
        <div class="row" style="margin-left: 7px;">
            <p style="width: 40px;">၁၀။</p>
            <p style="width: 94%;font-size: 14px;">သက်ဆိုင်ရာ မြို့နယ်စည်ပင်သာယာရေးနယ်နမိတ်အတွင်း လူစည်ကားရာနေရာ၊ဆေးရုံ၊ စျေး၊ ကျောင်း၊ ရုပ်ရှင် စသည့်နေရာနှင့် အနီးတဝိုက်၊ မီးပ္ပိုင့်နှင့် လမ်းဆုံလမ်းခွများတွင် ယာဉ်ရပ်နားခြင်း မပြုရ။</p>
        </div>
        <div class="row" style="margin-left: 7px;">
            <p style="width: 40px;">၁၁။</p>
            <p style="width: 94%;font-size: 14px;">ရေနံနှင့်ရေနံထွက်ပစ္စည်းသယ်ယူသည့်ယာဉ်ဖြင့် မူးယစ်ဆေးဝါး၊ သစ်၊ ကျောက်မျက်ရတနာနှင့် ဥပဒေနှင့်မညီသော အလားတူကုန်ပစ္စည်းများ လုံးဝသယ်ဆောင်ခြင်းမပြုရ။</p>
        </div>
        <div class="row" style="margin-left: 7px;">
            <p style="width: 40px;">၁၂။</p>
            <p style="width: 94%;font-size: 14px;">အထက်ဖော်ပြပါ လိုက်နာရမည့်စည်းကမ်းချက်များကို လိုက်နာရန်ပျက်ကွက်ပါက ဤလက်မှတ်အားသိမ်းဆည်းခြင်းခံရမည့်အပြင်လိုအပ်ပါက တရားဥပဒေအရ အရေးယူခြင်းခံရမည်။</p>
        </div>
      </div>
  </div>
</div>

  <script src="{{ asset('frontend/vendors/jquery/jquery-3.2.1.min.js')}}"></script>
  <script src="{{ asset('frontend/vendors/bootstrap/bootstrap.bundle.min.js')}}"></script>
</body>
</html>



   

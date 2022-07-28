@extends('adminlte::page')

@section('title', 'လိုင်စင်အသေးစိတ်')
 <?php 
    $mm_num = ['၀','၁', '၂', '၃', '၄', '၅', '၆','၇','၈','၉'];
    $en_num = range(0, 9);

?>
@section('content')
 <div class="row" style="margin-left: 20px;">  
    <a class="btn btn-primary" href="{{ route('admin.licence.index') }}"><i  class="fa fa-fw fa-arrow-left"></i>  နောက်သို့</a>
  </div>
  <br>
	<div class="container">
    <div> <h4 style="text-align: center;">{{$licence->licence_name}}</h4></div>
    <br>
        <div class="row " style="width: 100%;">
            <div class="col-md-12 table-responsive">
                 <table class="table table-bordered " cellspacing="0" width="100%">
                    <thead>
                      <tr style="background-color: #f2dede;">
                        <th>စဉ်</th>
                        <th  style="text-align: center;">အကြောင်းအရာ</th>
                        <th  style="text-align: center;">နှုန်းထား</th>
                      </tr>
                    </thead>
                  
                   <tr>
                    <td>၁</td>
                    <td>လိုင်စင်ကြေး</td>
                    <td style="text-align: right;">{{number_format($licence->licence_price)}}</td>
                   </tr>

                   <tr>
                    <td>၂</td>
                     <td>သက်တမ်းတိုးကြေး(၁)၏ ၆၀%</td>
                     <td style="text-align: right;">{{number_format($licence->extend_price)}}</td>
                   </tr>
                   
                   <tr>
                    <td>၃</td>
                     <td>ရက်လွန်ဒဏ်ကြေး</td>
                     <td style="text-align: right;">{{number_format($licence->expire_price)}}</td>
                   </tr>

                   <tr>
                    <td>၄</td>
                     <td>ပျက်စီး/​ပျောက်ဆုံးမိတ္တူမှန်ကြေး</td>
                     <td style="text-align: right;">{{number_format($licence->destroy_price)}}</td>
                   </tr>

                   <tr>
                    <td>၅</td>
                     <td>ပိုင်ရှင်လွှဲပြောင်းခြင်း (၁) ၏ ၃ ဆ</td>
                     <td style="text-align: right;">{{number_format($licence->change_owner)}}</td>
                   </tr>

                   <tr>
                    <td>၆</td>
                     <td>သိုလှောင်ပမာဏ ပြင်ဆင်ခြင်း (၁) ၏ ၁၀%</td>
                     <td style="text-align: right;">{{number_format($licence->upgrade_storage)}}</td>
                   </tr>

                   <tr>
                    <td>၇</td>
                     <td>အမည်ပြောင်းလဲခြင်း (၁) ၏ ၁၀% </td>
                     <td style="text-align: right;">{{number_format($licence->change_name)}}</td>
                   </tr>

                  </table>
            </div>  
            <br>
        </div>
    </div>
       
@stop

@section('css')
<style type="text/css">
   #logo{
        width:100px;
        height:100px;
    } 
</style>

@stop

@section('js')
 <!-- Charting library -->
 	<script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>
    <!-- Your application script -->
 <script>


 </script>
@stop

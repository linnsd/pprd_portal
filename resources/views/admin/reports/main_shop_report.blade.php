@extends('adminlte::page')

@section('title', 'အဓိက အရောင်းဆိုင်များ')

@section('content_header')

    <h1 class="unicode">အဓိက အရောင်းဆိုင်များ</h1>

@stop

<?php 
        $mm_num = ['၀','၁', '၂', '၃', '၄', '၅', '၆','၇','၈','၉'];
        $en_num = range(0, 9);

?>

@section('content')
    <div class="page_body">
        <div class="success-msg">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif
        </div>

      
        <div class="table-responsive" style=" display: block;overflow-x: auto;white-space: nowrap;">
            <table class="table table-bordered scroll">
            <thead>
                <tr>
                <th>စဉ်</th>
                <th>စိစစ်သည့်ရက်</th>
                <th>တိုင်းဒေသကြီး/ပြည်နယ်</th>
                <th>ဆိုင်စုစုပေါင်း</th>
                <th>အဓိကအရောင်းဆိုင်</th>
                <th>ဆီအမျိုးအစား</th>
                <th>သိုလှောင်နိုင်မှု</th>
                <th>လက်ကျန်</th>
                <th>တစ်ရက်ပျမ်းမျှအရောင်း</th>
                <th>ရောင်းချနိုင်မည့်ရက်</th>
                <th>မှာယူထားရှိမှု</th>
               
            </tr>
            </thead>
            <tbody style="overflow-x:auto;">
                @foreach($main_reports as $key=>$main_report)
                <tr>
                  <td rowspan="{{$main_report->fuel_list->count() + 1}}">{{++$i}}</td>
                  <td rowspan="{{$main_report->fuel_list->count() + 1}}"></td>
                  <td rowspan="{{$main_report->fuel_list->count() + 1}}">{{$main_report->sd_name}}</td>
                  <td rowspan="{{$main_report->fuel_list->count() + 1}}">
                    @php
                      $total_shop_count =  str_replace($en_num, $mm_num, $main_report->total_shop_count);

                      $main_shop_count =  str_replace($en_num, $mm_num, $main_report->main_shop_count);

                    @endphp

                    {{number_format($main_report->total_shop_count)}}
                  </td>
                  <td rowspan="{{$main_report->fuel_list->count() + 1}}">{{number_format($main_report->main_shop_count)}}</td>
                  @foreach($main_report->fuel_list as $fuel_list)

                  @php
                    $storage_capacity =  str_replace($en_num, $mm_num, $fuel_list->storage_capacity);

                      $remain_capacity =  str_replace($en_num, $mm_num, $fuel_list->remain_capacity);

                      $avg_capacity =  str_replace($en_num, $mm_num, $fuel_list->avg_capacity);

                     
                      $pre_order_capacity =  str_replace($en_num, $mm_num, $fuel_list->pre_order_capacity);
                  @endphp
                  <tr>
                    <td>{{$fuel_list->fuel_type}}</td>
                    <td style="text-align:right;">{{(number_format($fuel_list->storage_capacity))}}</td>
                    <td style="text-align:right;">{{number_format($fuel_list->remain_capacity)}}</td>
                    <td style="text-align:right;">{{number_format($fuel_list->avg_capacity)}}</td>
                    <td style="text-align:right;">
                      <?php 
                      if ($fuel_list->remain_capacity != 0 && $fuel_list->avg_capacity != 0) {
                        $day = (int)($fuel_list->remain_capacity / $fuel_list->avg_capacity);
                      }else{
                        $day = 0;
                      }
                        // $day =  str_replace($en_num, $mm_num, $day);

                       ?>
                       {{$day}}
                    </td>
                    <td style="text-align:right;">{{number_format($fuel_list->pre_order_capacity)}}</td>
                   
                  </tr>
                    
                  @endforeach
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    {{ $main_reports->appends(request()->input())->links()}}
      
    </div>
      
@stop



@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
 
<style type="text/css">
   table.scroll thead {
        overflow-x: scroll;
    }

</style>
   
@stop



@section('js')

<script>
 
</script>

@stop

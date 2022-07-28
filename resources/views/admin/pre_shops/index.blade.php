@extends('adminlte::page')

@section('title', 'စက်သုံးဆီ ကြိုတင်မှာယူထားမှုစာရင်း')

@section('content_header')

    <h1 class="unicode">စက်သုံးဆီ ကြိုတင်မှာယူထားမှုစာရင်း</h1>

@stop
 
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

        <div class="row">
            <?php
                $keyword = (isset($_GET['keyword']))?$_GET['keyword']:'';
                $received_status = (isset($_GET['received_status']))?$_GET['received_status']:''; 
            ?>

            <form action="{{ url('admin/pre_shops') }}" method="get" accept-charset="utf-8" class="form-horizontal">
                <div class="row">
                    <div class="col-md-2">
                        <input type="text" name="keyword" class="form-control" value="{{ old('keyword',$keyword) }}" placeholder="Search..">
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" id="received_status" name="received_status">
                            <option value="" {{ (old('received_status',$received_status)=="")?'selected':'' }}>Pre Order</option>
                            <option value="1" {{ (old('received_status',$received_status)=="1")?'selected':'' }}>Received</option>
                        </select>
                    </div>

                    <div class="col-md-1">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-search"></i>ရှာရန်</button>
                    </div>
                    
                </div>
            </form>

             <input type="hidden" id="ctr_token" value="{{ csrf_token()}}">
            <br>
        </div>
     
       <div class="row">
            <div class="form-group" align="right">
                <a class="btn btn-success" href="{{ route('admin.pre_shops.create') }}"><i class="fa fa-fw fa-plus"></i> အသစ်ထည့်ရန်</a>
            </div>
        </div>
        <div class="row">
             <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                         <tr>
                        <th>အရောင်းဆိုင်အမည်</th>
                        <th>တိုင်းဒေသကြီး/ပြည်နယ်</th>
                        <th>မြို့နယ်</th>
                        <th>စက်သုံးဆီအမျိုးအစား</th>
                        <th>မှာယူထားမှု ပမာဏ</th>
                        <th>အခြေအနေ</th>
                        <th>ယာဉ်အမှတ်</th>
                        <th>မှတ်ချက်</th>
                        <th style="width: 150px;"></th>
                    </tr>
                    </thead>
                   
                    
                    @foreach ($pre_shops as $shop)
                    <tr>
                         <td>{{ $shop->shopName }}</td>
                        <td>{{ $shop->sd_name }}</td>
                        <td>{{$shop->tsh_name_mm}}</td>
                        <td> 
                            {{$shop->fuel_type}}
                        </td>
                        <td>
                            {{$shop->pre_capacity}}
                        </td>
                        <td>
                            @if($shop->pre_status == null)
                                Pre Order
                            @elseif($shop->pre_status == 1)
                                Received
                            @else
                                Cancel
                            @endif
                        </td>
                        <td>{{$shop->bowser_no}}</td>
                        <td>{{$shop->pre_remark}}</td>
                        
                        <td>

                            <form action="{{ route('admin.pre_shops.destroy',$shop->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                                @csrf
                                @method('DELETE')

                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-fw fa-gear" title="action" /></i>Action
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        
                                        @can('dio-full-permission')
                                            @can('shop-edit')
                                            @if($shop->pre_status != 1)
                                                <li>
                                                    <a title="ပြင်ရန်" href="{{ route('admin.pre_shops.edit',$shop->id) }}"><i class="fa fa-fw fa-edit" /></i>Edit</a>
                                                </li>
                                                 <li class="divider"></li>
                                            @endif
                                            @endcan

                                            <li> 
                                                <a href="{{ route('admin.pre_shops.show',$shop->id) }}"><i class="fa fa-fw fa-eye" title="အသေးစိတ်" /></i>Deatil</a>
                                            </li>
                                            <li class="divider"></li>

                                            @can('shop-delete')
                                            <li>
                                                 <button style="border: none;padding: 0;background: none;" type="submit" title="ဖျက်ရန်" ><i class="fa fa-fw fa-trash" /></i>  Delete</button> 
                                                   
                                            </li>
                                            @endcan
                                        @else
                                            @can('shop-edit')
                                                <li>
                                                    <a title="ပြင်ရန်" href="{{ route('admin.pre_shops.edit',$shop->id) }}"><i class="fa fa-fw fa-edit" /></i>Edit</a>
                                                </li>
                                            @endcan
                                        @endcan
                                    </ul>
                                </div>
                               
                            </form>

                          
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div align="center">
                    <p style="color: black">Total - {{  $count }}</p>
                </div>
                
            </div>
            {{ $pre_shops->appends(request()->input())->links()}}
        </div>
       
    </div>
      
@stop



@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
 <style type="text/css" media="screen">
    
    .page_body{
        margin: 10px;
    }
     /* CHANGES */
    .dropdown-menu,.dropdown-toggle{
        min-width:100px;
    }
    .dropdown-menu>li>a{
      padding: 3px 5px 3px 0;
    }
    .switch {
      position: relative;
      display: inline-block;
      width: 45px;
      height: 22px;
    }

    .switch input { 
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 15px;
      width: 15px;
      left: 2px;
      bottom: 0px;
      top:3px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 36px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
 </style>
   
@stop



@section('js')

<script>
    $(document).ready(function(){
        var sd_id_val  = $('#sd_id').val();

        if(sd_id_val!=''){
             $('#tsh_div').css('display','block');
             getTownshipByStateDivision(sd_id_val) 
        }else{
             $('#tsh_div').css('display','none');
        }

    });

    $('#sd_id').change(function(){
        $('#tsh_div').css('display','block');
            getTownshipByStateDivision($(this).val());
    });

    $('#export_btn').click(function(){
            $('#excel_form').submit();
        });

   function getTownshipByStateDivision($id) {
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            $.ajax({
                url : $baseurl+'getTownshipByStateDivision',
                dataType : 'html',
                method : 'post',
                data : {
                        'state_division_id' : $id,
                        '_token': $('#ctr_token').val()
                },
                success : function(data){
                    $('#township_id').html(data);
                    if(data==""){
                        $('#township_id').html('<option value="">Select Township</option>');
                    }
                },
                error : function(error){
                    console.log(error);
                }
            });
    }

    $("document").ready(function(){
            setTimeout(function(){
                $("div.alert-success").remove();
            }, 3000 ); // 3 secs
        });
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0; 
                var shop_id = $(this).data('id'); 
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "<?php echo(route("admin.change_shop_status")) ?>",
                    data: {'status': status, 'shop_id': shop_id},
                    success: function(data){
                     console.log(data.success);
                    }
                });
            })
  })
    
</script>

@stop

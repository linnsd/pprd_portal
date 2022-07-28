@extends('adminlte::page')

@section('title', 'လိုင်စင်များ')

@section('content_header')

    <h1 class="unicode">လိုင်စင်များ</h1>

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
                $check_valid = isset($_GET['check_valid'])?$_GET['check_valid']:'';
                $sd_id = isset($_GET['sd_id'])?$_GET['sd_id']:'';
                $car_type = isset($_GET['car_type'])?$_GET['car_type']:'';
            ?>
            <form action="" method="get" accept-charset="utf-8" class="form-horizontal">
                
            </form>
            <br>
        </div>

        <div class="row">
             <div class="form-group" align="right">
                <a class="btn btn-success" href="{{route('admin.licence.create')}}"><i class="fa fa-fw fa-plus"></i> အသစ်ထည့်ရန်</a>
            </div>
        </div>
    
      
        <div class="row table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>စဉ်</th>
                    <th>လိုင်စင်အမည်</th>
                    <th>ဖြည့်သွင်းသည့်နေ့</th>
                    <th ></th>
                </tr>
                @foreach($licences as $licence)
                    <tr>
                    <td>{{++$i}}</td>
                    <td>{{$licence->licence_name}}</td>
                    <td>{{date('d-m-Y', strtotime($licence->created_at))}}</td>
                    <td>
                        <form action="{{route('admin.licence.destroy',$licence->id)}}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-sm btn-primary" title="ပြင်ရန်" href="{{route('admin.licence.edit',$licence->id)}}"><i class="fa fa-fw fa-edit" /></i></a>

                            <a class="btn btn-sm btn-primary" title="အသေးစိတ်ကြည့်ရန်" href="{{route('admin.licence.show',$licence->id)}}"><i class="fa fa-fw fa-eye" /></i></a>

                            <button type="submit" title="ဖျက်ရန်" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash" /></i></button> 
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            <div align="center">
                <p style="color: black">Total -11</p>
            </div>
           
       </div>
    </div>
      
@stop



@section('css')
 <style type="text/css" media="screen">
    th{
        background-color: rgba(0,0,0,.03);
    }
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
 </style>
   
@stop



@section('js')

<script>
    $(document).ready(function(){
        setTimeout(function(){
            $('.success-msg').hide();
        },3000); 
    });
    
</script>

@stop

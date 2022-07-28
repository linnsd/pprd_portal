@extends('adminlte::page')

@section('title', 'တိုင်းဒေသကြီး/ပြည်နယ်')

@section('content_header')

    <h1 class="unicode">တိုင်းဒေသကြီး/ပြည်နယ်</h1>

@stop

@section('content')
    <div class="page_body">
        <div class="success-msg">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
        </div>

          <div class="row">
            <?php
                $keyword = (isset($_GET['keyword']))?$_GET['keyword']:'';
            ?>
            <form action="{{ url('admin/states-divisons') }}" method="get" accept-charset="utf-8" class="form-horizontal">
                <div class="row">
                    <div class="col-md-2">
                        <input type="text" name="keyword" class="form-control" value="{{ old('keyword',$keyword) }}" placeholder="နေပြည်တော်..">
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-search"></i>ရှာရန်</button>
                    </div>
                    
                </div>
            </form>
            <br>
        </div>

        <div class="row">
             <div class="form-group" align="right">
                <a class="btn btn-success" href="{{ route('admin.states-divisons.create') }}"><i class="fa fa-fw fa-plus"></i> တိုင်းဒေသကြီး/ပြည်နယ် ထည့်ရန်</a>
                 <a class="btn btn-warning" href="{{ route('states-divisons.export') }}"><i class="fa fa-fw fa-file-excel-o"></i>Export Excel</a>
            </div>
        </div>
      
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>တိုင်းဒေသကြီး/ပြည်နယ်</th>
                    <th>အတိုကောက်အမည်</th>
                    <th>MMR Code</th>
                    <th>မြို့နယ်အရေအတွက်</th>
                    <th>ဖြည့်သွင်းသည့်နေ့</th>
                    <th ></th>
                </tr>
                @foreach ($data as $sd)
               
                <tr >
                    <td>{{ $sd->sd_name }}</td>
                    <td>{{ $sd->sd_short }}</td>
                    <td>{{ $sd->mmr_code }}</td>
                    <td>{{ $sd->townships->count()}}</td>
                    <td>
                        {{ date('d-m-Y', strtotime($sd->created_at ))}}
                    </td>
                    <td>

                        <form action="{{ route('admin.states-divisons.destroy',$sd->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                            @csrf
                            @method('DELETE')

                           
                            <a class="btn btn-sm btn-primary" title="ပြင်ရန်" href="{{ route('admin.states-divisons.edit',$sd->id) }}"><i class="fa fa-fw fa-edit" /></i></a>

                            <button type="submit" title="ဖျက်ရန်" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash" /></i></button> 
                        </form>

                      
                    </td>
                </tr>
                @endforeach
            </table>
            <div align="center">
                <p style="color: black">Total - {{  $count }}</p>
            </div>
            {{ $data->appends(request()->input())->links()}}
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
 </style>
   
@stop



@section('js')

<script>
    $(document).ready(function(){
        
            setTimeout(function(){
                $('.success-msg').hide();
            },3000)
            
    });
    
</script>

@stop

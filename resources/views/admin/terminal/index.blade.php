@extends('adminlte::page')

@section('title', 'သိုလှောင်ကန်စခန်းများ')

@section('content_header')

    <h1 class="unicode">သိုလှောင်ကန်စခန်းများ</h1>

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
                $sd_id = (isset($_GET['sd_id']))?$_GET['sd_id']:''; 
                $township_id = (isset($_GET['township_id']))?$_GET['township_id']:'';
                $fuel_id = (isset($_GET['fuel_id']))?$_GET['fuel_id']:''; 
            ?>
            <form action="{{ url('admin/terminal') }}" method="get" accept-charset="utf-8" class="form-horizontal">
                <div class="row">
                    @if(auth()->user()->role_id==1)
                     <div class="col-md-3">
                       <select name="sd_id" class="form-control" id="sd_id">
                           <option value="">တိုင်းဒေသကြီး/ပြည်နယ် ရွေးချယ်ရန်</option>
                           @foreach($sdivisions as $sd)
                            <option value="{{ $sd->id}}" {{ ($sd_id==$sd->id)?'selected':'' }}>{{ $sd->sd_name }}</option>
                           @endforeach
                       </select>
                    </div>
                    @else
                    <div class="col-md-2">
                       <select name="sd_id" class="form-control" id="sd_id">
                          
                           @foreach($sdivisions as $sd)
                             @if(auth()->user()->sd_id==$sd->id)
                                <option value="{{ $sd->id}}" {{ (auth()->user()->sd_id==$sd->id)?'selected':'' }}>{{ $sd->sd_name }}</option>
                            @endif
                           @endforeach
                       </select>
                    </div>
                    @endif

                    <div class="col-md-2" id="tsh_div" style="display: none;">
                        <select name="township_id" id="township_id" class="form-control">
                            <option value="">---</option>
                            @foreach($townships as $township)

                            <option value="{{ $township->id }}" {{ ($township->id==$township_id)?'selected':'' }}>{{ $township->tsh_name_mm }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <input type="text" name="keyword" class="form-control" value="{{ old('keyword',$keyword) }}" placeholder="ဆိုင်အမည်...">
                    </div>

                    <div class="col-md-1">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-search"></i>ရှာရန်</button>
                    </div>
                    
                </div>
            </form>
             <input type="hidden" id="ctr_token" value="{{ csrf_token()}}">
            <br>
        </div>
        @can('shop-create')
            @can('dio-full-permission')
            <div class="row">
                <div class="form-group" align="right">
                    <a class="btn btn-success" href="{{ route('admin.terminal.create') }}"><i class="fa fa-fw fa-plus"></i> အသစ်ထည့်ရန်</a>
                </div>
            </div>

            <div class="row">
                <form class="form-horizontal" action="{{ route('terminal.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="col-md-2">
                            <input type="file" name="file" class="form-control">
                            @if ($errors->has('file'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button class="btn btn-success btn-sm"><i class="fa fa-fw fa-file-excel-o"></i>Import CSV</button>
                       <!--  <a class="btn btn-warning btn-sm" href="{{ route('terminal.export') }}"><i class="fa fa-fw fa-file-excel-o"></i>Export</a> -->
                       <a class="btn btn-warning" id="export_btn"><i class="fa fa-fw fa-file-excel-o"></i>Export</a>
                        
                        
                    </div>
                </form>
            </div>
            <form id="excel_form" action="{{ route('terminal.export') }}"  method="post">
            @csrf
            <input type="hidden" id="type" name="fuel_id" value="{{ $fuel_id  }}">
           
            </form>
            @endcan
        @endcan
      
        <div class="row">
             <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>တိုင်းဒေသကြီး/ပြည်နယ်</th>
                        <th>မြို့နယ်</th>
                        <th>ကုမ္ပဏီအမည်</th>
                        <th>လိုင်စင်အမှတ်</th>
                        <th>ဓါတ်ဆီ</th>
                        <th>ဒီဇယ်</th>
                        <th>ထုတ်ပေးသည့်ရက်စွဲ</th>
                        <th style="width: 150px;"></th>
                    </tr>
                    
                    @foreach ($terminals as $terminal)
                   
                    <tr >
                        <td>{{ $terminal->statedivision->sd_name}}</td>
                        @if($terminal->tsh_id != null)
                        <td>{{$terminal->township->tsh_name_mm}}</td>
                        @else
                        <td></td>
                        @endif
                        <td>{{ $terminal->company_name }}</td>
                        <td>
                            {{ $terminal->lic_no }}
                        </td>
                        <td>{{ $terminal->gasoline }}</td>
                        <td>
                            {{ $terminal->disel }}
                        </td>
                        <td>
                           
                            {{ date('d-m-Y', strtotime($terminal->issue_date ))}}
                            
                        </td>
                        <td>

                            <form action="{{ route('admin.terminal.destroy',$terminal->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                                @csrf
                                @method('DELETE')

                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-fw fa-gear" title="action" /></i>Action
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        
                                        @can('shop-show')
                                            <li> 
                                                <a href="{{ route('admin.terminal.show',$terminal->id) }}"><i class="fa fa-fw fa-eye" title="အသေးစိတ်" /></i>Deatil</a>
                                            </li>
                                            <li class="divider"></li>
                                             @endcan
                                        @can('dio-full-permission')
                                            @can('shop-edit')
                                                <li>
                                                    <a title="ပြင်ရန်" href="{{ route('admin.terminal.edit',$terminal->id) }}"><i class="fa fa-fw fa-edit" /></i>Edit</a>
                                                </li>
                                                 <li class="divider"></li>
                                            @endcan

                                            @can('shop-delete')
                                            <li>
                                                 <button style="border: none;padding: 0;background: none;" type="submit" title="ဖျက်ရန်" ><i class="fa fa-fw fa-trash" /></i>  Delete</button> 
                                                   
                                            </li>
                                            @endcan
                                        @else
                                            @can('shop-edit')
                                                <li>
                                                    <a title="ပြင်ရန်" href="{{ route('admin.terminal.edit',$terminal->id) }}"><i class="fa fa-fw fa-edit" /></i>Edit</a>
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
            {{ $terminals->appends(request()->input())->links()}}
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
        },3000)
            
    });

    $('#export_btn').click(function(){
            $('#excel_form').submit();
        });


    
</script>

@stop

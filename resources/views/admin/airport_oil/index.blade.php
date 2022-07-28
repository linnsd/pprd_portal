@extends('adminlte::page')

@section('title', 'လေယာဉ်ဆီ')

@section('content_header')

    <h1 class="unicode">လေယာဉ်ဆီ</h1>

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
            ?>
            <form action="{{ url('admin/airport_oil') }}" method="get" accept-charset="utf-8" class="form-horizontal">
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
                    <a class="btn btn-success" href="{{ route('admin.airport_oil.create') }}"><i class="fa fa-fw fa-plus"></i> အသစ်ထည့်ရန်</a>
                </div>
            </div>

            <div class="row">
                <form class="form-horizontal" action="{{ route('airport_oil.import') }}" method="POST" enctype="multipart/form-data">
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
                 
                       <a class="btn btn-warning" id="export_btn"><i class="fa fa-fw fa-file-excel-o"></i>Export</a>
                        
                        
                    </div>
                </form>
            </div>
            <form id="excel_form" action="{{ route('airport_oil.export') }}"  method="post">
            @csrf
           
            </form>
            @endcan
        @endcan
      
        <div class="row">
             <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>တိုင်းဒေသကြီး/ပြည်နယ်</th>
                        <th>ကုမ္ပဏီအမည်</th>
                        <th>လိုင်စင်အမှတ်</th>
                        <th>လိုင်စင်ထုတ်ပေးသည့်ရက်စွဲ</th>
                        <th>သိုလှောင်မှုပမာဏ</th>
                        <th style="width: 150px;"></th>
                    </tr>
                    
                    @foreach ($airport_oils as $airport_oil)
                   
                    <tr >
                        <td>{{ $airport_oil->state_division->sd_name}}</td>

                        <td>{{ $airport_oil->company_name }}</td>
                        <td>
                            {{ $airport_oil->licence_no }}
                        </td>
                        <td>
                           
                            {{ date('d-m-Y', strtotime($airport_oil->issue_date ))}}
                            
                        </td>
                        <td>{{$airport_oil->capacity}}</td>
                        <td>

                            <form action="{{ route('admin.airport_oil.destroy',$airport_oil->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                                @csrf
                                @method('DELETE')

                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-fw fa-gear" title="action" /></i>Action
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        
                                        @can('shop-show')
                                            <li> 
                                                <a href="{{ route('admin.airport_oil.show',$airport_oil->id) }}"><i class="fa fa-fw fa-eye" title="အသေးစိတ်" /></i>Deatil</a>
                                            </li>
                                            <li class="divider"></li>
                                             @endcan
                                        @can('dio-full-permission')
                                            @can('shop-edit')
                                                <li>
                                                    <a title="ပြင်ရန်" href="{{ route('admin.airport_oil.edit',$airport_oil->id) }}"><i class="fa fa-fw fa-edit" /></i>Edit</a>
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
                                                    <a title="ပြင်ရန်" href="{{ route('admin.airport_oil.edit',$airport_oil->id) }}"><i class="fa fa-fw fa-edit" /></i>Edit</a>
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
            {{ $airport_oils->appends(request()->input())->links()}}
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

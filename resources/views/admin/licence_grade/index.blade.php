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
                 $lic_name_id = (isset($_GET['lic_name_id']))?$_GET['lic_name_id']:'';
            ?>
            <form action="{{ url('admin/licence_grade') }}" method="get" accept-charset="utf-8" class="form-horizontal">
                <div class="row">
                    <div class="col-md-2">
                        <input type="text" name="keyword" class="form-control" value="{{ old('keyword',$keyword) }}" placeholder="ရှာဖွေလို့သည်အရာ..">
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" name="lic_name_id" id="lic_name_id">
                                <option value="">All</option>
                                @foreach($lic_names as $lic_name)
                                <option value="{{$lic_name->id}}" {{ ($lic_name_id == $lic_name->id)?'selected':'' }} >{{$lic_name->lic_name}}</option>
                                @endforeach
                            </select> 
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
                <a class="btn btn-success" href="{{route('admin.licence_grade.create')}}"><i class="fa fa-fw fa-plus"></i> အသစ်ထည့်ရန်</a>
            </div>
        </div>
    
      
        <div class="row table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>စဉ်</th>
                    <th>လိုင်စင်အမည်</th>
                    <th>လိုင်စင်အဆင့်လိုင်စင်အမည်သတ်မှတ်ချက်</th>
                    <th>ဖြည့်သွင်းသည့်နေ့</th>
                    <th ></th>
                </tr>
                @foreach($lic_grades as $lic_grade)
                    <tr>
                    <td>{{++$i}}</td>
                    @if($lic_grade->viewLicence != null)
                    <td>{{$lic_grade->viewLicence->lic_name}}</td>
                    @else
                    <td></td>
                    @endif
                    <td>{{$lic_grade->grade}}</td>
                    <td>{{date('d-m-Y', strtotime($lic_grade->created_at))}}</td>
                    <td>
                        <form action="{{route('admin.licence_grade.destroy',$lic_grade->id)}}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-sm btn-primary" title="ပြင်ရန်" href="{{route('admin.licence_grade.edit',$lic_grade->id)}}"><i class="fa fa-fw fa-edit" /></i></a>

                            <button type="submit" title="ဖျက်ရန်" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash" /></i></button> 
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            <div align="center">
                <p style="color: black">Total - {{$count}}</p>
            </div>
           
       </div>
       {{ $lic_grades->appends(request()->input())->links()}}
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

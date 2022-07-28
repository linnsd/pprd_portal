@extends('adminlte::page')

@section('title', 'ယာဉ်စာရင်း')

@section('content_header')

    <h1 class="unicode">ယာဉ်စာရင်း</h1>

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

                if( auth()->user()->role_id == 3){
                    $sd_id = auth()->user()->sd_id;
                }

                $car_type = isset($_GET['car_type'])?$_GET['car_type']:'';
            ?>
            <form action="{{ url('admin/cars') }}" method="get" accept-charset="utf-8" class="form-horizontal">
                <div class="row">
                    <div class="col-md-3">
                        @if(auth()->user()->role_id==1)
                           <select name="sd_id" class="form-control" id="sd_id">
                               <option value="">တိုင်းဒေသကြီး/ပြည်နယ်...</option>
                               @foreach($sdivisions as $sd)
                                <option value="{{ $sd->id}}" {{ ($sd_id==$sd->id)?'selected':'' }}>{{ $sd->sd_name }}</option>
                               @endforeach
                           </select>
                        @else
                            <select name="sd_id" class="form-control" id="sd_id">
                               <option value="">တိုင်းဒေသကြီး/ပြည်နယ်...</option>
                               @foreach($sdivisions as $sd)
                                @if(auth()->user()->sd_id==$sd->id)
                                 <option value="{{ $sd->id}}" {{ (auth()->user()->sd_id==$sd->id)?'selected':'' }}>{{ $sd->sd_name }}</option>
                                @endif
                               @endforeach
                            </select>
                        @endif
                    </div>

                    <div class="col-md-2">
                        <input type="text" name="keyword" class="form-control" value="{{ old('keyword',$keyword) }}" placeholder="ရှာဖွေလို့သည်အရာ..">
                    </div>
                    <div class="col-md-2">
                       <select name="check_valid" class="form-control" id="check_valid">
                           <option value="">ရွေးချယ်ရန်...</option>
                           <option value="1" {{ ($check_valid=='1')?'selected':'' }} >သက်တမ်းရှိယာဉ်</option>
                           <option value="2" {{ ($check_valid=='2')?'selected':'' }} >သက်တမ်းကုန်မည့်ယာဉ်</option>
                           <option value="3" {{ ($check_valid=='3')?'selected':'' }} >သက်တမ်းကုန်သည့်ယာဉ်</option>
                           <option value="4" {{ ($check_valid=='4')?'selected':'' }} >စီစစ်နေဆဲယာဉ်</option>
                       </select>
                    </div>
                    <div class="col-md-2">
                       <select name="car_type" class="form-control" id="car_type">
                           <option value="">...အားလုံး...</option>
                           <option value="1" {{ ($car_type=='1')?'selected':'' }} >ဆီသယ်ယာဉ်</option>
                           <option value="2" {{ ($car_type=='2')?'selected':'' }} >ဆီသယ်နောက်တွဲယာဉ်</option>
                           <option value="3" {{ ($car_type=='3')?'selected':'' }} >ATF</option>
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
                <a class="btn btn-success" href="{{ route('admin.cars.create') }}"><i class="fa fa-fw fa-plus"></i> အသစ်ထည့်ရန်</a>
            </div>
        </div>
        <div class="row">
            <form class="form-horizontal" action="{{ route('cars.import') }}" method="POST" enctype="multipart/form-data">
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
                    <button class="btn btn-success"><i class="fa fa-fw fa-file-excel-o"></i>Import CSV</button>
                    <a class="btn btn-warning" id="export_btn"><i class="fa fa-fw fa-file-excel-o"></i>Export</a>
                     <a class="btn btn-primary"  href="{{ route('cars.download.csv') }}"><i class="fa fa-fw fa-download"></i>Demo CSV File</a>
                </div>
            </form>
        </div>

       <form id="excel_form" action="{{ route('cars.export') }}"  method="POST">
        @csrf
        <input type="hidden" id="type" name="state_division_id" value="{{ $sd_id  }}">
           
        </form>

        <div class="row">
            <div class="col-md-3">
                <button class="btn btn-sm" style="background: #f39c13"></button> &nbsp; သက်တမ်းကုန်မည့်ယာဉ်
            </div>
            <div class="col-md-3">
                <button class="btn btn-sm" style="background: red"></button> &nbsp; သက်တမ်းကုန်သည့်ယာဉ်
            </div>
            <div class="col-md-3">
                <button class="btn btn-sm" style="background: black"></button> &nbsp; သက်တမ်းရှိယာဉ်
            </div>
        </div>
        <br>

      
        <div class="row table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>လုပ်ငန်းရှင်အမည်</th>
                    <th>ယာဉ်မောင်းအမည်</th>
                    <th>ဆီသယ်ယာဉ်အမျိုးအစား</th>
                    <th>လိုင်စင်အမှတ်</th>
                    <th>မော်ဒယ်</th>
                    <th>ဝင့်ဆံ့ပမာဏ</th>
                    <th>သက်တမ်းကုန်မယ့်ရက်</th>
                    <th>ဖြည့်သွင်းသည့်နေ့</th>
                    <th ></th>
                </tr>
                
                @foreach ($cars as $car)
                <?php 
                        $days = '';
                        $expireddate = '';
                        $now = time(); // or your date as well
                        if($car->expire_date!='' || $car->expire_date!=null ){
                            $expdate =strtotime($car->expire_date);
                            $datediff = $expdate - $now;
                            $days = round($datediff / (60 * 60 * 24));

                            $expired = $now - $expdate;
                            $expireddate = round($datediff / (60 * 60 * 24));
                        }
                       


                ?>
                <?php 
                        $array=[];
                        $driver = '';
                        $lastdriver = '';

                        foreach($car->drivers as $key => $driver) {
                            if($driver->dname!=''){
                                $driver = $driver->dname;
                            }
                                array_push($array, $driver);
                            }
                            
                            if (empty($array)) {
                                $lastdriver ='';       
                            }else{
                                $lastdriver = end($array);       
                            }  
                        
                     ?>
                <tr @if($days!='' && $days<60 && $days>0) style="color:#f39c13;" @elseif($expireddate!='' && $expireddate<0) style="color:red;"  @endif>
                    <td>{{$car->no}}</td>
                    <td>{{ $car->company_name }}</td>
                    <td>{{$lastdriver}}</td>
                    <td>
                          @if($car->car_type == 1)
                          ဆီသယ်ယာဉ်
                          @elseif($car->car_type == 2)
                          ဆီသယ်နောက်တွဲယာဉ်
                          @elseif($car->car_type == 3)
                          ATF
                          @endif
                    </td>
                    <td>
                        {{ $car->plate_no }}
                    </td>
                    <td>{{ $car->model }}</td>

                    @if($car->unit_id ==1)
                      <td>{{ number_format($car->capacity) }} ဂါလန်</td>
                    @elseif($car->unit_id ==2)
                       <td>{{ number_format($car->capacity) }} လီတာ</td>
                    @else
                        <td>{{ number_format($car->capacity) }} KG</td>
                    @endif
   
                    <td>
                        @if($car->expire_date!='' || $car->expire_date!=null)
                        {{ date('d-M-Y', strtotime($car->expire_date ))}}
                        @else
                            စီစစ်နေဆဲ
                        @endif
                    </td>

                    <td>
                        {{ date('d-M-Y', strtotime($car->created_at ))}}
                    </td>
                    <td>


                        <form class="action_form" action="{{ route('admin.cars.destroy',$car->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                            @csrf
                            @method('DELETE')

                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-fw fa-gear" title="action" /></i>Action
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu">
                                <li> 
                                    <a href="{{ route('admin.cars.show',$car->id) }}"><i class="fa fa-fw fa-eye" title="အသေးစိတ်" /></i>Detail</a>
                                </li>
                                <li class="divider"></li>
                                @if(auth()->user()->role_id==1)
                                @can('lock-unlock')
                                <li>
                                    <a  href="{{ route('admin.cars.locked',$car->id) }}">
                                        @if($car->locked==0)
                                        <i class="fa fa-fw fa-unlock" title="lock" /></i>Lock
                                        @else
                                          <i class="fa fa-fw fa-lock" title="unlock" /></i>UnLock
                                        @endif
                                    </a>
                                </li>
                                <li class="divider"></li>
                                @endcan
                                @endif
                               
                                @if(auth()->user()->role_id==1)
                                    <li>
                                           <a  title="ပြင်ရန်" href="{{ route('admin.cars.edit',$car->id) }}"><i class="fa fa-fw fa-edit" /></i>Edit</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li >
                                            <button style="border: none;padding: 0;background: none;" type="submit" title="ဖျက်ရန်" ><i class="fa fa-fw fa-trash" /></i>  Delete</button> 
                                    </li> 

                                @else
                                    @if($car->locked==0)
                                        <li>
                                            <a  title="ပြင်ရန်" href="{{ route('admin.cars.edit',$car->id) }}"><i class="fa fa-fw fa-edit" /></i>Edit</a>
                                           
                                        </li>
                                        <li class="divider"></li>

                                        <li>
                                            <button style="border: none;padding: 0;background: none;" type="submit" title="ဖျက်ရန်" ><i class="fa fa-fw fa-trash" /></i>  Delete</button> 
                                               
                                        </li>  
                                    @endif
                                @endif
                                
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
            {{ $cars->appends(request()->input())->links()}}
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

        $('#export_btn').click(function(){
            $('#excel_form').submit();
        }); 
    });
    
</script>

@stop

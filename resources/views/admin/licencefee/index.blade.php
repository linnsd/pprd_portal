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
            ?>
            <form action="{{ url('admin/licence_fee') }}" method="get" accept-charset="utf-8" class="form-horizontal">
                <div class="row">
                    <div class="col-md-2">
                        <input type="text" name="keyword" class="form-control" value="{{ old('keyword',$keyword) }}" placeholder="ရှာဖွေလို့သည်အရာ..">
                    </div>
                    <div class="col-md-2">
                         <select class="itemName form-control" style="width:220px;" name="itemName"></select>
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
                <a class="btn btn-success" href="{{route('admin.licence_fee.create')}}"><i class="fa fa-fw fa-plus"></i> အသစ်ထည့်ရန်</a>
            </div>
        </div>
    
      
        <div class="row table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>စဉ်</th>
                    <th>လိုင်စင်အမည်</th>
                    <th>လိုင်စင်အဆင့်သတ်မှတ်ချက်</th>
                    <th>Key</th>
                    <th>Value</th>
                    <th>ဖြည့်သွင်းသည့်နေ့</th>
                    <th ></th>
                </tr>
                @foreach($licencefees as $licencefee)
                   
                    <tr>
                    <td>{{++$i}}</td>
                    <td>{{$licencefee->viewLicenceName->lic_name}}</td>
                    @if($licencefee->viewLicenceGrade != null)
                    <td>{{$licencefee->viewLicenceGrade->grade}}</td>
                    @else
                    <td></td>
                    @endif
                   
                    <td>{{$licencefee->lic_key}}</td>
                    <td>{{$licencefee->lic_fee_val}}</td>
                    <td>{{date('d-m-Y', strtotime($licencefee->created_at))}}</td>
                    <td>
                        <form action="{{route('admin.licence_fee.destroy',$licencefee->id)}}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-sm btn-primary" title="ပြင်ရန်" href="{{route('admin.licence_fee.edit',$licencefee->id)}}"><i class="fa fa-fw fa-edit" /></i></a>

                           

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
       {{ $licencefees->appends(request()->input())->links()}}
    </div>
      
@stop



@section('css')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js" defer></script>
<script>
    $(document).ready(function(){
        setTimeout(function(){
            $('.success-msg').hide();
        },3000); 

        $('.itemName').select2({

                    placeholder: 'Select an item',
                    ajax: {
                      url: '/search_ajax',
                      dataType: 'json',
                      delay: 250,
                      processResults: function (data) {
                        return {
                          results:  $.map(data, function (item) {
                                return {
                                    text: item.lic_name,
                                    id: item.id
                                }
                            })
                        };
                      },
                      cache: true
                    }
                  });
    });
    
</script>

@stop

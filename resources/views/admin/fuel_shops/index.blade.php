@extends('adminlte::page')

@section('title', 'အရောင်းဆိုင်များ')

@section('content_header')

    <h1 class="unicode">အရောင်းဆိုင်များ</h1>

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
                $tsh_id = (isset($_GET['tsh_id']))?$_GET['tsh_id']:'';
                $licence_grade = (isset($_GET['licence_grade']))?$_GET['licence_grade']:'';
                $is_active = (isset($_GET['is_active']))?$_GET['is_active']:'';
                $is_major = (isset($_GET['is_major']))?$_GET['is_major']:'';
            ?>


            <form action="{{ url('admin/fuel_shops') }}" method="get" accept-charset="utf-8" class="form-horizontal">
             <div class="col-md-2">
                <input type="text" id="keyword" name="keyword" class="form-control" value="{{ old('keyword',$keyword) }}" placeholder="ရှာရန်...">
            </div>
        </form>
            <div class="col-md-2">
             <button type="button" class="btn btn-warning "  data-toggle="modal" data-target="#filter_modal" style="font-size: 13px"><i class="fa fa-filter" aria-hidden="true"></i></button>
          </div>
             <input type="hidden" id="ctr_token" value="{{ csrf_token()}}">
            <br>
        </div>

        <div class="modal" id="filter_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-md">
              <!-- Modal content-->
              <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title">More Filter...</h5>
                    <button style="float:right;" type="button" id="close_cross" data-dismiss="modal">&times;</button>
                 </div>
                 <div class="modal-body">
                <form action="{{ url('admin/fuel_shops') }}" method="get" accept-charset="utf-8" class="form-horizontal">
                <div class="row form-group">
                    @if(auth()->user()->role_id==1)
                     <div class="col-md-6">
                        <label>တိုင်းဒေသကြီး/ပြည်နယ် ရွေးချယ်ရန်</label>
                       <select name="sd_id" class="form-control" id="sd_id">
                           <option value="">တိုင်းဒေသကြီး/ပြည်နယ် ရွေးချယ်ရန်</option>
                           @foreach(App\Helper\Helpers::state_divisions() as $sd)
                            <option value="{{ $sd->id}}" {{ ($sd_id==$sd->id)?'selected':'' }}>{{ $sd->sd_name }}</option>
                           @endforeach
                       </select>
                    </div>
                    @else
                    <div class="col-md-6">
                        <label>တိုင်းဒေသကြီး/ပြည်နယ် ရွေးချယ်ရန်</label>
                       <select name="sd_id" class="form-control">
                        <option value="">တိုင်းဒေသကြီး/ပြည်နယ် ရွေးချယ်ရန်</option>
                           @foreach(App\Helper\Helpers::state_divisions() as $sd)
                             @if(auth()->user()->sd_id==$sd->id)
                                <option value="{{ $sd->id}}" {{ (auth()->user()->sd_id==$sd->id)?'selected':'' }}>{{ $sd->sd_name }}</option>
                            @endif
                           @endforeach
                       </select>
                    </div>
                    @endif

                    <div class="col-md-6">
                        <option value="">မြို့နယ် ရွေးချယ်ရန်</option>
                        <select name="tsh_id" id="tsh_id" class="form-control">
                            <option value="">---</option>
                            @foreach(App\Helper\Helpers::townships() as $township)

                            <option value="{{ $township->id }}" {{ ($township->id==$tsh_id)?'selected':'' }}>{{ $township->tsh_name_mm }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <label>ဖွင့်လှစ်ထားရှိမှုအခြေအနေ</label>
                        <select class="form-control" id="is_active" name="is_active">
                            <option value="">All</option>
                            <option value="1" {{$is_active == "1" ? 'selected' : ''}}>Active</option>
                            <option value="0" {{$is_active == "0" ? 'selected' : ''}}>Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                       
                        <label>Major/Minor</label>
                        <select class="form-control" id="is_major" name="is_major">
                            <option value="">Major/Minor</option>
                            <option value="1" {{$is_major == "1" ? 'selected' : ''}}>Major</option>
                            <option value="0" {{$is_major == "0" ? 'selected' : ''}}>Minor</option>
                        </select>
                   
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <label>လိုင်စင်အဆင့်သတ်မှတ်ချက်</label>
                        <select class="form-control" id="lic_grade" name="lic_grade">
                            <option value="">All</option>
                            @foreach(App\Helper\Helpers::lic_grades() as $key=>$lic_grade)
                            <option value="{{$lic_grade->id}}" {{$licence_grade == $lic_grade->id ? 'selected' : ''}}>{{$lic_grade->grade}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-4"></div>
                      <div class="col-md-6">
                         <button type="button" class="btn btn-danger my-2" data-dismiss="modal" id="close_btn">Cancel</button>
                         <button type="submit" class="btn btn-primary my-2">Search</button>
                      </div>
                </div>
            </form>
        </div>
                 
              </div>
           </div>
        </div>

        <div class="modal" id="remark_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-md">
              <!-- Modal content-->
              <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title">Please type remark...</h5>
                    <button style="float:right;" type="button" id="cross" data-dismiss="modal">&times;</button>
                 </div>
                 <div class="modal-body">
                    <form action="{{ url('admin/change_shop_status') }}" method="get" accept-charset="utf-8" class="form-horizontal">
                        <div class="row form-group">
                            <div class="col-md-12">
                            <label>မှတ်ချက်</label>
                            <textarea class="form-control" id="remark" name="remark"></textarea>
                             <input type="hidden" name="shop_id" id="shop_id">
                             <input type="hidden" name="status" id="status">
                        </div>
                        </div>
                       
                        <div class="row form-group">
                            <div class="col-md-4"></div>
                              <div class="col-md-6">
                                 <button type="button" class="btn btn-danger my-2" data-dismiss="modal" id="cancel_btn">Cancel</button>
                                 <button type="submit" class="btn btn-primary my-2">Save</button>
                              </div>
                        </div>
                    </form>
                </div>
                 
              </div>
           </div>
        </div>

        @can('shop-create')
            @can('dio-full-permission')
            <div class="row">
                <div class="form-group" align="right">
                    <a class="btn btn-success" href="{{ route('admin.fuel_shops.create') }}"><i class="fa fa-fw fa-plus"></i>အရောင်းဆိုင်ထည့်ရန်</a>
                </div>
            </div>

            <div class="row">
                <form class="form-horizontal" action="{{ route('shops.import') }}" method="POST" enctype="multipart/form-data">
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
                         <a class="btn btn-primary btn-sm"  href="{{ route('shops.download.csv') }}"><i class="fa fa-fw fa-download"></i>Demo CSV File</a>
                        
                    </div>
                </form>
            </div>
            <form id="excel_form" action="{{ route('shops.export') }}"  method="post">
            @csrf
            
            </form>
            @endcan
        @endcan
      
        <div class="row">
             <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>စဉ်</th>
                            <th>ဆိုင်အမည်</th>
                            <th>ပိုင်ရှင်/ကုမ္ပဏီ/အဖွဲ့အစည်းအမည်</th>
                            <th>လိုင်စင်အမှတ်</th>
                            <th>မြို့နယ်</th>
                            <th>အဆင့်</th>
                            <th>ထုတ်ပေးသည့်ရက်စွဲ</th>
                            <th>သက်တမ်းကုန်ဆုံးရန်</th>
                           
                            <th>Major/Minor</th>
                            <th>လုပ်ဆောင်ချက်</th>
                        </tr>
                        
                    </thead>
                    <tbody>

                        @foreach ($fuel_shops as $key=>$shop)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{ $shop->shopName }}</td>
                            <td>{{ $shop->owner }}</td>
                            <td>{{ $shop->licence_no }}</td>
                            <td>{{ $shop->tsh_name_mm}}</td>
                            <td>{{ $shop->grade}}</td>
                            <td>
                                @if($shop->lic_issue_date != null)
                                {{date('d-m-Y',strtotime($shop->lic_issue_date))}}
                                @endif 
                            </td>
                            <td>
                                 @if($shop->lic_expire_date!='' || $shop->lic_expire_date!=null)
                                    {{ date('d-m-Y', strtotime($shop->lic_expire_date ))}}
                                @endif
                            </td>
                           
                            <td>
                                @if($shop->shop_type == 0)
                                    Minor
                                @else
                                    Major
                                @endif
                            </td>
                            <td>

                            <form action="{{ route('admin.fuel_shops.destroy',$shop->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                                @csrf
                                @method('DELETE')

                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-fw fa-gear" title="action" /></i>Action
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        
                                        @can('shop-show')
                                            <li> 
                                                <a href="{{ route('admin.fuel_shops.show',$shop->id) }}"><i class="fa fa-fw fa-eye" title="အသေးစိတ်" /></i>Deatil</a>
                                            </li>
                                            <li class="divider"></li>
                                             @endcan
                                        @can('dio-full-permission')
                                            @can('shop-edit')
                                                <li>
                                                    <a title="ပြင်ရန်" href="{{ route('admin.fuel_shops.edit',$shop->id) }}"><i class="fa fa-fw fa-edit" /></i>Edit</a>
                                                </li>
                                                 <li class="divider"></li>
                                            @endcan

                                            @can('shop-delete')
                                            <li>
                                                 <button style="border: none;padding: 0;background: none;" type="submit" title="ဖျက်ရန်" ><i class="fa fa-fw fa-trash" /></i>  Delete</button> 
                                                   
                                            </li>
                                            @endcan
                                            <li class="divider"></li>
                                            <li>
                                                  <label class="switch" style="margin-left:10px;">
                                                  <input data-id="{{$shop->id}}" data-size ="small" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $shop->shop_status ? 'checked' : '' }}>
                                                  <span class="slider round"></span>
                                                  </label>
                                            </li>
                                        @else
                                            @can('shop-edit')
                                                <li>
                                                    <a title="ပြင်ရန်" href="{{ route('admin.shops.edit',$shop->id) }}"><i class="fa fa-fw fa-edit" /></i>Edit</a>
                                                </li>
                                            @endcan
                                        @endcan
                                    </ul>
                                </div>
                               
                            </form>

                          
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    
                <div align="center">
                    <p style="color: black">Total - {{  $count }}</p>
                </div>
                
            </div>
            {{ $fuel_shops->appends(request()->input())->links()}}
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


    $('#keyword').change(function(){
        // this.form().submit();
        // alert('hi');
        this.form.submit();
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
                var shop_id = $(this).data('id'); 
                var status = $(this).prop('checked') == true ? 1 : 0; 
                $('#shop_id').val(shop_id);
                $('#status').val(status);
                $('#remark_modal').show();
            })

            $('#cross').click(function(){
                 $('#remark_modal').hide();
                 location.reload();
            });

            $('#cancel_btn').click(function(){
                 $('#remark_modal').hide();
                 location.reload();
            });
        })
    
</script>

@stop

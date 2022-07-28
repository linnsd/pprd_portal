@extends('adminlte::page')

@section('title', 'အကြောင်းကြားစာများ')

@section('content_header')

    <h1 class="unicode">အကြောင်းကြားစာများ</h1>

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

      
      
            @can('dio-full-permission')
            <div class="row">
                <div class="form-group" align="right">
                    <a class="btn btn-success" href="{{ route('admin.notifications.create') }}"><i class="fa fa-fw fa-plus"></i>Create Notification</a>
                </div>
            </div>

            @endcan
      
      
        <div class="row">
             <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Active/Inactive</th>
                            <th></th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        @foreach ($notifications as $notification)
                        <tr>
                            <td>{{ $notification->title }}</td>
                            <td>{{Str::limit($notification->description, 40, $end='.......')}}</td>
                            <td>
                                 <label class="switch">
                                      <input data-id="{{$notification->id}}" data-size ="small" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $notification->status ? 'checked' : '' }}>
                                      <span class="slider round"></span>
                                </label>
                            </td>
                            
                            <td>

                            <form action="{{ route('admin.notifications.destroy',$notification->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                                @csrf
                                @method('DELETE')

                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-fw fa-gear" title="action" /></i>Action
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        
                                        @can('shop-show')
                                            <li> 
                                                <a href="{{ route('admin.notifications.show',$notification->id) }}"><i class="fa fa-fw fa-eye" title="အသေးစိတ်" /></i>Deatil</a>
                                            </li>
                                            <li class="divider"></li>
                                             @endcan
                                        @can('dio-full-permission')
                                            @can('shop-edit')
                                                <li>
                                                    <a title="ပြင်ရန်" href="{{ route('admin.notifications.edit',$notification->id) }}"><i class="fa fa-fw fa-edit" /></i>Edit</a>
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
            {{ $notifications->appends(request()->input())->links()}}
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
                var noti_id = $(this).data('id'); 
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "<?php echo(route("admin.change_noti_status")) ?>",
                    data: {'status': status, 'noti_id': noti_id},
                    success: function(data){
                     console.log(data.success);
                    }
                });
            })
  })
    
</script>

@stop

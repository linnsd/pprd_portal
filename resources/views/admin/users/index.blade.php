@extends('adminlte::page')

@section('title', 'Login Users')

@section('content_header')

    <h1>Login Users</h1>

@stop

@section('content')
<style>
.add {
  background-color:#AA55AA;
  border: none;
  color: white;
  padding: 2px 20px;
  font-size: 30px;
  cursor: pointer;
}

/* Darker background on mouse-over */
.add:hover {
  background-color: #FF55FF;
}
.input-group.md-form.form-sm.form-1 input{
border: 1px solid purple;
border-top-right-radius: 0.25rem;
border-bottom-right-radius: 0.25rem;
}
.input-group-text{
background-color:#AA55AA;
color:white;
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
    <div class="page_body">
       
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right" align="right">
                   {{--  <a href="{{ url('/set-shopowner-role') }}">Set Shop Owner Role</a> --}}
                    <a class="btn btn-success" href="{{ route('admin.users.create') }}"><i class="fa fa-fw fa-plus" /></i> Add Users</a>
                </div>
            </div>
        </div>
        <div class="row">
        <?php
            $sd_id = (isset($_GET['sd_id']))?$_GET['sd_id']:'';
            $keyword = (isset($_GET['keyword']))?$_GET['keyword']:'';
        ?>
            <form action="{{ url('admin/users') }}" method="get" accept-charset="utf-8" class="form-horizontal">
                <div class="row" style="margin-left: 2px;">
                  <div class="col-md-2">
                    <div class="form-group">
                      <select name="sd_id" id="state_division" class="form-control">
                        <option>-Select-</option>
                        @foreach($stdivisions as $sd)
                          <option value="{{ $sd->id }}" {{ ($sd_id==$sd->id)?'selected':''  }}>{{ $sd->sd_name}} </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                      <input type="text" class="form-control" value="{{ $keyword }}" name="keyword" placeholder="Search keyword..">
                  </div>
                  <div class="col-md-2">
                      <input class="btn btn-primary" type="submit" value="Search">
                  </div>
                </div>
            </form>
            <br>
        </div>

        <br>
        
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Login ID</th>
                    <th>Roles</th>
                    <th>State/Division</th>
                    <th>Date</th>
                    <th>Active/Inactive</th>
                    <th >Action</th> 
                </tr>
                @foreach ($users as $user)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->loginId }}</td>
                    <td>
                        @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                               <label class="badge badge-primary">{{ $v }}</label>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @if(isset($user->statedivision))
                        {{ $user->statedivision->sd_name }}
                        @endif
                    </td>
                    <td>
                        {{ date('d-M-Y H:m A', strtotime($user->created_at ))}}
                    </td>
                    <td class="unicode">
                        <label class="switch">
                          <input data-id="{{$user->id}}" data-size ="small" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $user->status ? 'checked' : '' }}>
                          <span class="slider round"></span>
                          </label>
                      </td>
                    <td>
                            <form action="{{ route('admin.users.destroy',$user->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                                @csrf
                                @method('DELETE')
{{-- 
                                <a class="btn btn-sm btn-info" href="{{ route('admin.users.show',$user->id) }}"><i class="fa fa-fw fa-eye" /></i></a>
 --}}
                            
                                <a class="btn btn-sm btn-primary" href="{{ route('admin.users.edit',$user->id) }}"><i class="fa fa-fw fa-edit" /></i></a>
                                @if(Auth::user()->role_id!=$user->role_id)
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash" /></i></button> 
                                @endif
                            </form>
                    </td>
                </tr>
                @endforeach
            </table>
            {{ $users->appends(request()->input())->links()}}
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
        console.log('car!');
        $("document").ready(function(){
            setTimeout(function(){
                $("div.alert-success").remove();
            }, 3000 ); // 3 secs
        });
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0; 
                var user_id = $(this).data('id'); 
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "<?php echo(route("change-status-user")) ?>",
                    data: {'status': status, 'user_id': user_id},
                    success: function(data){
                     console.log(data.success);
                    }
                });
            })
  })
    </script>

@stop

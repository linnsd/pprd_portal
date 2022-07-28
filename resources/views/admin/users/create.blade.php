@extends('adminlte::page')

@section('title', 'Add Login Users')

@section('content_header')

    <h1>Add Login Users</h1>

@stop

@section('content')
<div class="container">
    <div class="panel-body">
        <form action="{{ route('admin.users.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="form-group {{ $errors->first('roles', 'has-error') }}" >
                    <label class="col-md-2">Role:</label>
                    <div class="col-md-5">
                       <select name="roles[]" id="role_id" class="form-control">
                          <option value="">Select User Role</option>
                          @foreach($roles as $role)
                           <option value="{{ $role }}">{{ $role}}</option>
                          @endforeach
                          
                       </select>
                        {!! $errors->first('roles', '<span class="error_msg">:message</span> ') !!}
                    </div>   
                </div>
            </div>

             <div class="row">
                <div class="form-group {{ $errors->first('state_division_id', 'has-error') }}" >
                    <label class="col-md-2">State/Division:</label>
                    <div class="col-md-5">
                       <select name="state_division_id" id="state_division_id" class="form-control">
                            <option value="">-- Select --</option>
                            @foreach($statedivisions as $sd)
                            <option value="{{ $sd->id }}" {{ (old('state_division_id')==$sd->id)?'selected':'' }}> 
                                {{  $sd->sd_name }} ( {{  $sd->sd_short }} )
                            </option>
                            @endforeach
                       </select>

                        {!! $errors->first('state_division_id', '<span class="error_msg">:message</span> ') !!}
                    </div>   
                </div>
            </div>

            <div class="row">
                <div class="form-group {{ $errors->first('name', 'has-error') }}" >
                    <label class="col-md-2">Name</label>
                    <div class="col-md-5">
                         <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control"  >
                        {!! $errors->first('name', '<span class="error_msg">:message</span> ') !!}
                    </div>
                   
                </div>
            </div>

            
            

            <div class="row">
                <div class="form-group {{ $errors->first('loginId', 'has-error') }}" >
                    <label class="col-md-2">Login ID</label>
                    <div class="col-md-5">
                         <input type="text" name="loginId" id="loginId" value="{{ old('loginId') }}" class="form-control"  >
                        {!! $errors->first('loginId', '<span class="error_msg">:message</span> ') !!}
                    </div>
                   
                </div>
            </div>


            <div class="row">
                <div class="form-group {{ $errors->first('password', 'has-error') }}" >
                    <label class="col-md-2">Password</label>
                    <div class="col-md-5">
                        <input type="password" name="password" id="password" class="form-control " value="{{ old('password') }}" >
                        {!! $errors->first('password', '<span class="error_msg">:message</span> ') !!}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group {{ $errors->first('password', 'has-error') }}">
                    <label for="password-confirm" class="col-md-2 col-form-label text-md-right unicode">{{ __('Confirm Password') }}*</label>

                    <div class="col-md-5">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                
            </div>

            <div class="row">
                <div class="form-group  text-center">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary" href="{{ route('admin.users.index') }}"> Back</a>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
           
        </form>
        <input type="hidden" id="ctr_token" value="{{ csrf_token()}}">
    </div>
</div>
@stop



@section('css')
   <style type="text/css" media="screen">
      .error_msg{
        color: #DD4B39;
      }
      .has-error input{
        border-color: #DD4B39;
      }
  </style>
   
@stop



@section('js')

   <script>
    $(document).ready(function(){
             // var state_division_id = $('#state_division_id').val();

             // if(state_division_id!=''){
             //    getTownshipByStateDivision(state_division_id);

             // }
    });

    // $('#state_division_id').change(function(){
    //         getTownshipByStateDivision($(this).val());
    // });

   // function getTownshipByStateDivision($id) {
   //          $.ajaxSetup({
   //            headers: {
   //              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   //            }
   //          });

   //          $.ajax({
   //              url : $baseurl+'getTownshipByStateDivision',
   //              dataType : 'html',
   //              method : 'post',
   //              data : {
   //                      'state_division_id' : $id,
   //                      '_token': $('#ctr_token').val()
   //              },
   //              success : function(data){
   //                  $('#township_id').html(data);
   //                  if(data==""){
   //                      $('#township_id').html('<option value="">ျမိဳ့နယ္ေရြးခ်ယ္ပါ</option>');
   //                  }
   //              },
   //              error : function(error){
   //                  console.log(error);
   //              }
   //          });
   //  }

    
</script>

@stop
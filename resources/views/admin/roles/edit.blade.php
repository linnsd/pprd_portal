@extends('adminlte::page')

@section('title', 'Role Update')

@section('content_header')

    <h1>Edit Role</h1>

@stop

@section('content')
<div class="container">
    <div class="panel-body">
        <form action="{{ route('admin.roles.update',$role->id) }}" method="POST" class="form-horizontal">
        @csrf
        @method('PUT')

            <div class="row">
                <div class="form-group {{ $errors->first('name', 'has-error') }}" >
                    <label class="col-md-2">Role Name</label>
                    <div class="col-md-5">
                         <input type="text" name="name"  value="{{ old('name',$role->name) }}" class="form-control"  >
                        {!! $errors->first('name', '<span class="error_msg unicode">:message</span> ') !!}
                    </div>
                   
                </div>
            </div>
            <div class="row">
                <div class="form-group {{ $errors->first('name', 'has-error') }}" >
                    <label class="col-md-2">Permission</label>
                    <div class="col-md-5">
                         @foreach($permission as $value)
                              <label for="permission">
                                  <input type="checkbox" name="permission[]" class="name" {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }} value="{{ $value->id }}"> {{ $value->name }}
                              </label>
                          <br/>
                          @endforeach
                        {!! $errors->first('permission', '<span class="error_msg unicode">:message</span> ') !!}
                    </div>
                   
                </div>
            </div>
            
            
            <div class="row">
                <div class="form-group  text-center">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary" href="{{ route('admin.roles.index') }}"> Back</a>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
           
        </form>
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
@stop
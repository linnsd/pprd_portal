@extends('adminlte::page')

@section('title', 'Site Setting')

@section('content_header')

    <h1>Site Setting</h1>

@stop

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

   <div class="card-body">
        <form action="{{ url('admin/setting/update') }}" method="POST">
            @csrf

            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <div class="row">
                <label for="" class="col-md-2">Site Title</label>
                <div class="col-md-6">
                    <div class="form-group has-feedback {{ $errors->has('site_tile') ? 'has-error' : '' }}">
                        <input type="text" name="site_tile" class="form-control" value="{{ $setting->site_tile }}"
                               placeholder="Site Title">
                        <span class="glyphicon glyphicon-info-sign form-control-feedback"></span>
                        @if ($errors->has('site_tile'))
                            <span class="help-block">
                                <strong>{{ $errors->first('site_tile') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
            </div>

            <div class="row">
                <label class="col-md-2">Site Description</label>
                <div class="col-md-6">
                    <div class="form-group has-feedback {{ $errors->has('site_description') ? 'has-error' : '' }}">
                        <input type="text" name="site_description" class="form-control" value="{{ $setting->site_description }}"
                               placeholder="Description">
                        <span class="glyphicon 	 glyphicon-info-sign form-control-feedback"></span>
                        @if ($errors->has('site_description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('site_description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <label class="col-md-2">API Key</label>
                <div class="col-md-6">
                    <div class="form-group has-feedback {{ $errors->has('api_key') ? 'has-error' : '' }}">
                        <input type="text" name="api_key" class="form-control" value="{{ $setting->api_key }}"
                               placeholder="API KEY">
                        <span class="glyphicon 	 glyphicon-lock form-control-feedback"></span>
                        @if ($errors->has('api_key'))
                            <span class="help-block">
                                <strong>{{ $errors->first('api_key') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.generate.apikey') }}" class="btn btn-warning" onclick="return confirm('Are you sure to generate new api key?');"><span class="glyphicon glyphicon-refresh"></span></a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-6" align="center">
                    <button type="submit" class="btn btn-primary btn-flat">
                      Save
                    </button>
                </div>
            </div>
            
                
            
        </form>
  
   </div>

@stop

@section('css')

@stop

@section('js')
<script> 
    $("document").ready(function(){
        setTimeout(function(){
            $("div.alert").remove();
        }, 3000 ); // 3 secs

    });
@stop
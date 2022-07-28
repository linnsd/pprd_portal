@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')

    <h1>Profile</h1>

@stop
 <style type="text/css" media="screen">
     td{
        width: 50%;
     }
 </style>
@section('content')


   <div class="card-body">
        <div class="row" align="center">
            @if(Auth::user()->photo!='')
                <img src="{{ asset("uploads/member/".Auth::user()->photo) }}" class="user-image" alt="User Image"  width="200px;"/>
            
            @else
                <img src="{{ asset("img/admin.png") }}" class="user-image" alt="User Image"  width="200px;"/>
            @endif
            
        </div>
        <br>
        @auth
             <table class="table table-bordered">

                <tr>
                    <td>
                        <label class="unicode" for="1">Name</label>
                    </td>
                    <td class="unicode">
                        {{ Auth::user()->name}}
                    </td>
                </tr>

                <tr>
                    <td>
                        <label class="unicode" for="2">Login ID</label>

                    </td>
                    <td class="unicode">
                        @if(auth()->user()->role_id==1)
                            {{ Auth::user()->email}}
                        @else
                            {{ Auth::user()->loginId}}
                        @endif
                    </td>
                </tr>
               
                <tr>
                    <td>
                        <label class="unicode" for="8">Phone</label>

                    </td>
                    <td class="unicode">{{ Auth::user()->phone}}</td>
                </tr>
                <tr>
                    <td>
                        <label class="unicode" for="8">Role</label>

                    </td>
                    <td class="unicode">
                        @if(auth()->user()->role_id==1)
                            <p class="btn btn-sm btn-success">System Admin</p>
                        @else
                             <p class="btn btn-sm btn-success">Shop Owner</p>
                        @endif
                    </td>
                </tr>
              {{--   <tr>
                    <td>
                        <label class="unicode" for="8">Account Status</label>

                    </td>
                    <td class="unicode">
                        @if(Auth::user()->status=0)
                            <p class="btn btn-sm btn-primary">Pending</p>
                        @else
                            <p class="btn btn-sm btn-success">Active</p>
                        @endif
                    </td>
                </tr> --}}
            </table>
            
        @endauth
  
   </div>

@stop



@section('css')
<style>
    th{
        background-color: rgba(0,0,0,.03);
        color: black;
    }
    .page_body{
        margin: 10px;
    }
</style>
   
@stop



@section('js')
<script> 

</script>

@stop
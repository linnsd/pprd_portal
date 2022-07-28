@extends('adminlte::page')

@section('title', 'Role Management')

@section('content_header')

    <h1>Role Management</h1>

@stop
 
@section('content')

   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="page_body">
        @can('role-create')
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                   <a class="btn btn-success" href="{{ route('admin.roles.create') }}"> <i class="fa fa-fw fa-plus"></i>Create New Role</a>
                </div>
            </div>
        </div>
        @endcan
        <br>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($roles as $role)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td class="unicode">{{ $role->name }}</td>
                    <td>
                        <form action="{{ route('admin.roles.destroy',$role->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
           
            
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.roles.edit',$role->id) }}"><i class="fa fa-fw fa-edit" /></i></a>
           
                            @csrf
                            @method('DELETE')
              
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash" /></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            {{ $roles->appends(request()->input())->links()}}
        </div>
  
   </div>
   
      
@stop



@section('css')
<style>
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
    console.log('Role!'); 
    $("document").ready(function(){
    setTimeout(function(){
        $("div.alert").remove();
    }, 3000 ); // 3 secs

});
</script>

@stop

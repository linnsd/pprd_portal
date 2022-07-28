@extends('adminlte::page')

@section('title', 'Backup Manager')

@section('content_header')

     <h3>Backup Lists</h3>

@stop
@section('content')
<div class="page_body">

        <div class="row">
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
             <div class="col-xs-12 clearfix">
                <a id="create-new-backup-button" href="{{ url('admin/backup/create') }}" class="btn btn-primary pull-right"
                   style="margin-bottom:2em;"><i
                        class="fa fa-plus"></i> Create New Backup
                </a>
            </div>
            <br>
            <div class="col-md-12 table-responsive" style="font-size:15px">
                @if (count($backups))

                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>File</th>
                            <th>Size</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($backups as $backup)
                            <tr>
                                <td>{{ $backup['file_name'] }}</td>
                                <td>{{ $backup['file_size'] }}</td>
                                <td>
                                    {{ date('d-m-Y H:m:i',$backup['last_modified']) }}
                                </td>
                                <td class="text-right">
                                    <a class="btn btn-xs btn-default"
                                       href="{{ url('admin/backup/download/'.$backup['file_name']) }}"><i
                                            class="fa fa-cloud-download"></i> Download</a>
                                    <a class="btn btn-xs btn-danger" data-button-type="delete"
                                       href="{{ url('admin/backup/delete/'.$backup['file_name']) }}"><i class="fa fa-trash-o"></i>
                                        Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="well">
                        <h4>There are no backups</h4>
                    </div>
                @endif
            </div>
        </div>

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
</script>

@stop


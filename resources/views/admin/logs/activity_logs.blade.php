@extends('adminlte::page')

@section('title', 'Logs')

@section('content_header')

     <h3>Activity Logs</h3>

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
       
        <div class="table-responsive" style="font-size:15px">
            @if (count($logs))

                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th >Date</th>
                        <th >Log Name</th>
                        <th >Description</th>
                        <th ></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td>
                                {{ date('d-m-Y H:m A',strtotime($log->created_at)) }}
                            </td>
                            <td>{{ $log->log_name }}</td>
                            <td>{{ $log->description }} </td>
                            <td class="text-right">
                                <a class="btn btn-xs btn-primary" data-button-type="delete"
                                   href="{{ url('admin/logs/show/'.$log->id) }}"><i class="fa fa-eye"></i>
                                    Detail</a>
                                <a class="btn btn-xs btn-danger" data-button-type="delete"
                                   href="{{ url('admin/logs/delete/'.$log->id) }}"><i class="fa fa-trash-o"></i>
                                    Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $logs->appends(request()->input())->links()}}
            @else
                <div class="well">
                    <h4>There are no  log files</h4>
                </div> 
            @endif
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


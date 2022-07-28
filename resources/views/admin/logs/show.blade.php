@extends('adminlte::page')

@section('title', 'Logs Detail')

@section('content_header')

    <h4 class="unicode">Logs Detail</h4>

@stop

@section('content')
    <div class="panel-body">
        <div class="row">
              <div class="col-md-12">
                  <table class="table table-bordered" style=" width: 100%; margin-right: auto; margin-left: auto;">
                              <tbody>
                                <tr>
                                  <th scope="row">Date</th>
                                  <td> {{ date('d-m-Y H:m A',strtotime($log->created_at)) }}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row">Log Name</th>
                                  <td>{{ $log->log_name }}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row">Description</th>
                                  <td>{{ $log->description }}</td>
                                  
                                </tr>
                                <tr>
                                  <th scope="row">Properties</th>
                                  <td> 
                                    <pre>{{ json_encode( $log->changes(), JSON_PRETTY_PRINT) }}</pre>
                                  </td>
                                  
                                </tr>
                               
                              </tbody>
                  </table>
              </div>
        </div>
    </div>
</div>

@stop



@section('css')

@stop



@section('js')
   
@stop
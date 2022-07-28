@extends('adminlte::page')

@section('title', 'မြို့နယ်များ')

@section('content_header')

    <h1>မြို့နယ်များ</h1>

@stop
 
@section('content')
<div class="page_body">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('admin.township.create') }}"> <i class="fa fa-fw fa-plus"></i>မြို့နယ်အသစ်ထည့်ရန်</a>

                <a class="btn btn-warning" href="{{ route('townships.export') }}"><i class="fa fa-fw fa-file-excel-o"></i>Export Excel</a>
                    
            </div>
        </div>

    </div>
    <br>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row">
        <?php
            $sd_id = (isset($_GET['sd_id']))?$_GET['sd_id']:'';
            $keyword = (isset($_GET['keyword']))?$_GET['keyword']:'';
        ?>
        <form action="{{ url('admin/township') }}" method="get" accept-charset="utf-8" class="form-horizontal">
            <div class="row" style="margin-left: 2px;">
              <div class="col-md-2">
                <div class="form-group">
                  <select name="sd_id" id="state_division" class="form-control">
                    @foreach($stdivisions as $sd)
                      <option value="{{ $sd->id }}" {{ ($sd_id==$sd->id)?'selected':''  }}>{{ $sd->sd_name}} ( {{ $sd->sd_short}} )</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                  <input type="text" class="form-control" value="{{ $keyword }}" name="keyword" placeholder="Township name..">
              </div>
              <div class="col-md-2">
                  <input class="btn btn-primary" type="submit" value="Search">
              </div>
            </div>
        </form>
        <br>
    </div>
     <div class="row">
           {{--  <form class="form-horizontal" action="{{ route('cars.import') }}" method="POST" enctype="multipart/form-data">
                @csrf --}}
                <div class="row">
                    <div class="form-group">
                        {{-- <div class="col-md-2">
                            <input type="file" name="file" class="form-control">
                        </div>
                        <button class="btn btn-success"><i class="fa fa-fw fa-file-excel-o"></i>Import CSV</button> --}}
                         {{-- <a class="btn btn-primary"  href="{{ route('cars.download.csv') }}"><i class="fa fa-fw fa-download"></i>Demo CSV File</a> --}}
                    </div>
                 </div>
            {{-- </form> --}}
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>စဉ်</th>
                <th>တိုင်းဒေသကြီး/ပြည်နယ်</th>
                <th>မြို့နယ်အမည်(အင်္ဂလိပ်)</th>
                <th>မြို့နယ်အမည်(မြန်မာ)</th>
                <th>ဆိုင်အရေအတွက်</th>
                <th width="280px"></th>
            </tr>
            @foreach ($townships as $township)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $township->statedivsion->sd_name }}</td>
                <td style="color: {{ $township->color_code }}" class="unicode">{{ $township->tsh_name_en }}</td>
                <td style="color: {{ $township->color_code }}" class="unicode">{{ $township->tsh_name_mm }}
                <td>
                    {{ $township->shops->count()}}
                </td>
                <td>
                        <form action="{{ route('admin.township.destroy',$township->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
           
            
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.township.edit',$township->id) }}"><i class="fa fa-fw fa-edit" /></i></a>
           
                            @csrf
                            @method('DELETE')
              
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash" /></i></button>
                        </form>
                </td>
            </tr>
            @endforeach
        </table>
   </div>
   <div class="row">
        <div class="col-md-6">
            {!! $townships->appends(request()->input())->links() !!}
        </div>
        <div class="col-md-6"> <p>Total: {{$total}}</p></div>
       
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

    $("document").ready(function(){
        setTimeout(function(){
            $("div.alert").remove();
        }, 3000 ); // 3 secs

    });

    $(function() {
      $('#state_division').change(function() {
          this.form.submit();
      });
  });
</script>

@stop

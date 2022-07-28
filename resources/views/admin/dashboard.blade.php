@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
{{-- 
    <h1>Dashboard</h1> --}}

@stop

{!! Charts::scripts() !!}
{!! $shops_chart->script() !!}
{!! $shops_pie->script() !!}

{!! $cars_chart->script() !!}

@section('content')
{{--     <div class="container"> --}}
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div align="center">
                            <h3 style="color: #3b1d82;" class="unicode">Petroleum Products Regulatory Department</h3>
                            <h4 style="color: #3b1d82;" class="unicode">(PPRD)</h4>   
                        </div>
                        
                        <br>
                    </div>

                    <div class="card-body" align="center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if(auth()->user()->role_id==1)
          <div class="row">
            <div class="col-md-6">
              {!! $shops_chart->html() !!}
            </div>
            <div class="col-md-6"> 
              {!! $cars_chart->html() !!}
              {{-- {!! $shops_pie->html() !!} --}}
            </div>
          </div>
          <br>
          <?php
            $sd_id = isset($_GET['sd_id'])?$_GET['sd_id']:$stdivisions[0]->id;
          ?>
          <form action="{{ url('admin/home') }}" method="get" accept-charset="utf-8" class="form-horizontal">
            <div class="row" style="margin-left: 2px;">
              <div class="col-md-2">
                <div class="form-group">
                  <select name="sd_id" id="state_division" class="form-control">
                    @foreach($stdivisions as $sd)
                      <option value="{{ $sd->id }}" {{ ($sd_id==$sd->id)?'selected':''  }}>{{ $sd->sd_name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </form>
          <div class="row">
            @foreach ($lists as $data)
              @if($data->townships()->count()>0)
                  @foreach($data->townships as $township)
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box " style="background-color: {{ $township->tsh_color }} !important;">
                        <div class="inner">

                          <h1 style="color:white;font-size: 38px;">{{ $township->shops->count() }}</h1>
                          <h4 class="unicode" style="color: white;">{{ $township->tsh_name_mm}}</h4>
                        </div>
                         <div class="icon">
                        
                        </div>
                        <a href="{{ url('admin/shops?township_id='.$township->id) }}" class="small-box-footer">More info <i class="fa fa-fw fa-arrow-right"></i></a>
                      </div>
                    </div>
                  @endforeach
              @endif
            @endforeach
          </div>
          
        {{-- @elseif(auth()->user()->roles[0]->id==4)
            <div class="row">
             <div class="col-md-12">
                <h3>{{ $sdlists[0]->sd_name }} ( {{ $sdlists[0]->sd_short }} )</h3>
             </div>
            </div>
             <div class="row">
              @foreach ($sdlists as $data)
                @if($data->townships()->count()>0)
                    @foreach($data->townships as $township)
                      <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box " style="background-color: {{ $township->tsh_color }} !important;">
                          <div class="inner">

                            <h1 style="color:white;font-size: 38px;">{{ $township->shops->count() }}</h1>
                            <h4 class="unicode" style="color: white;">{{ $township->tsh_name_mm}}</h4>
                          </div>
                           <div class="icon">
                          
                          </div>
                          <a href="{{ url('admin/shops?sd_id='.$township->sd_id.'&township_id='.$township->id) }}" class="small-box-footer">More info <i class="fa fa-fw fa-arrow-right"></i></a>
                        </div>
                      </div>
                    @endforeach
                @endif
              @endforeach
            </div> --}}
        @else
          <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div align="center">
                          <img src="{{ asset('/img/logo.png') }}" alt="logo" style="width: 50%; margin-right: auto; margin-left: auto;">
                        </div>
                    </div>
                </div>
            </div>
          </div>
        @endif

    </div>
@stop



@section('css')

   

@stop



@section('js')
<script>
  $(function() {
      $('#state_division').change(function() {
          this.form.submit();
      });
  });
</script>
@stop

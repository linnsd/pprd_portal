@extends('adminlte::page')

@section('title', 'ဆိုင်းဘုတ်')

@section('content_header')
    <a class="btn btn-primary btn-sm" href="{{route('shop.downloadqr',$shop->id)}}" style="margin-left: 15px;"><i class="fa fa-fw fa-download"></i>Download QR</a>
    <button class="btn btn-success btn-sm" onClick="doCapture();"><i class="fa fa-fw fa-photo"></i>Download JPEG</button>
    <a class="btn btn-warning btn-sm" href="{{route('shop.signage.downloadpsd')}}" style="margin-left: 15px;"><i class="fa fa-fw fa-file"></i>Sample PSD</a>
@stop

@section('content')
    <div class="panel-body">
        <div class="success-msg">
            @if ($message = Session::get('error'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif
        </div>
     
       
        <div class="row" style="margin-left:50px;">
                <p>အလျား - ၄ ပေ ၊ အနံ - ၂ ပေ</p>
              <div id="signage" style="padding:50px;">
                <div  style="margin: auto; width: 1000px; height: 500px; background: blue;border-style: solid;border-color: black; border-radius: 5px;   border-width: medium;">
                    <div style="margin: auto; ">
                        <p style="color: #ffffff; margin-top: 220px; font-size: 55px;text-align:center; ">လိုင်စင်ရအရောင်းဆိုင်</p>
                    </div>
                    <div style="position: relative;">
                      <div align="right"  style="margin-right: 10px;" >
                          <p id="p_shop_name">
                            {{ $shop->shop_name}}
                            {!! QrCode::size(130)->generate(URL::to('/').'/shop/getdata/'.$shop->id); !!}
                          </p>  
                        </div>
                    </div>
                    <div class="row">
                        
                    </div> 
                </div>
              {{--   <img style="margin: auto; width: 1000px; height: 500px; border-style: solid;border-color: black; border-radius: 5px;   border-width: medium;" src="{{ asset($shop->path.'/'.$shop->photo2) }}" alt="signage">
 --}}

         {{--  <div class="col-md-2"></div>
              <div class="col-md-8">
              <div class="row" style="margin-right: auto; margin-left: auto; border-style: solid; border-color: #92a8d1;">
                <div class="col-lg-12 col-xs-6">
                  <!-- small box -->
                  <div class="small-box " style="background-color: blue">
                    <div class="inner">
                      <div class="row" align="center" style="height: 200px;">
                       
                      </div>
                      <div class="row" style="margin-top: 10px; margin-bottom: 10px; ">
                        <div class="col-md-6" style="height: 100px;position: relative;">
                            
                        </div>
                        <div class="col-md-6" style="height: 100px;">
                            <div align="right" >
                                 <p id="p_shop_name">{{ $shop->shop_name}}</p>
                                 {!! QrCode::size(100)->generate(URL::to('/').'/shop/getdata/'.$shop->id); !!}
                            </div>
                        </div>
                      </div>

                     
                    </div>
                   
                  </div>
                </div>
              </div>

              </div>
             <div class="col-md-2"></div> --}}
             </div>
        </div>
       {{--  <br>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
               <a class="btn btn-success btn-sm" href="{{route('shop.downloadqr',$shop->id)}}" style="margin-left: 15px;"><i class="fa fa-fw fa-download"></i>Download QR</a>
               <a class="btn btn-primary btn-sm" href="{{route('signage.print',$shop->id)}}" style="margin-left: 15px;"><i class="fa fa-fw fa-print"></i>Print Signage</a>
            </div>
            <div class="col-md-4"></div>
        </div> --}}


    </div>
</div>

   </div>
   <input type="hidden" id="ctr_token" value="{{ csrf_token()}}">

@stop



@section('css')
<style>
  #p_shop_name {
    color: yellow;
    font-size: 28px;
    /*position: absolute;*/
    margin-top:  40px;
    /*margin-left: 720px;*/
  }
</style>
@stop



@section('js')
<script src="{{ asset('js/html2canvas.js') }}"></script>
<script>
    $(document).ready(function(){
        setTimeout(function(){
          $('.success-msg').hide();
        },3000)

        $('#shop_name').focusout(function(){
            $('#p_shop_name').text($(this).val());
        });

       
    });

    function doCapture(){
         window.scrollTo(0,0);
         html2canvas(document.getElementById("signage")).then(function(canvas){
            // console.log(canvas.toDataURL("image/jpeg",0.9));

            // var ajax = new XMLHttpRequest();
            // ajax.open("POST","{{ url('save-capture') }}",true);
            // ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            // ajax.send("image="+canvas.toDataURL("image/jpeg",0.9));

            // ajax.onreadystateChange = function(){
            //   if(this.readyState==4 && this.status==200){
            //     console.log(this.responseText);
            //   }
            // }


            $.ajax({
              type:'POST',
              url: "{{ url('save-canvas')}}",
              data: { 
                  "image": canvas.toDataURL("image/jpeg",1),
                  "_token": $('#ctr_token').val(),
                  'shop_id':{!! $shop->id !!}   
              },
              // cache:false,
              // contentType: false,
              // processData: false,
              success: (data) => {
                window.location="{{route('shop.signage.downloadjpg')}}";
              },
              error: function(data){
                console.log(data);
              }
            });

         })
        }
 

</script>
   
@stop
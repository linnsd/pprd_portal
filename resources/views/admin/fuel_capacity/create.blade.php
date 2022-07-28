@extends('adminlte::page')

@section('title', 'စက်သုံးဆီပမာဏဖြည့်သွင်းရန်')

@section('content_header')

    <h4>စက်သုံးဆီပမာဏဖြည့်သွင်းရန်</h4><br>

@stop

@section('content')
<div class="container">
    <div class="panel-body">
        <form action="{{ route('admin.shop_fuel_capacity.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf
        
            <div class="row">
                <!-- <div class="col-md-6"> -->
                    <div class="row" style="margin-left:1px;">
                        <div class="form-group">
                            <label for="" class="form-label col-md-2">စက်သုံးဆီ အရောင်းဆိုင် *</label>
                             <div class="col-md-4">
                                <select name="f_shop_id" id="f_shop_id" class="form-control" required> 
                                    <option value="">--စက်သုံးဆီ အရောင်းဆိုင်--</option>
                                    @foreach(App\Helper\Helpers::fuel_shops() as $fuel_shop)
                                    <option value="{{$fuel_shop->id}}">{{$fuel_shop->shopName}}</option>
                                    @endforeach
                               </select>

                                @if ($errors->has('f_shop_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('f_shop_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            စက်သုံးဆီ အမျိုးအစား*
                        </div>
                        <div class="col-md-3">
                            သိုလှောင်နိုင်မှုပမာဏ*
                        </div>
                        <div class="col-md-3">
                            စက်သုံးဆီ လက်ကျန်*
                        </div>
                        <div class="col-md-2">
                            ပျမ်းမျှ
                        </div>
                        
                    </div>
                    <div class="row form-group">
                        <div class="col-md-3">
                           
                            <select class="form-control fuel" name="fuel_type[]" id="fuel_type_0">
                                <option value="">စက်သုံးဆီ အမျိုးအစား</option>
                                @foreach(App\Helper\Helpers::fuel_types() as $fuel_type)
                                <option value="{{$fuel_type->id}}">{{$fuel_type->fuel_type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="number" id="max_capacity_0" name="max_capacity[]" class="form-control" placeholder="116200" required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" id="op_balance_0" name="op_balance[]" class="form-control" placeholder="62922" required>
                        </div>
                        <div class="col-md-2">
                             <input type="number" id="avg_balance_0" name="avg_balance[]" class="form-control" placeholder="6292" required>
                        </div>
                         <button type="button" onclick="add_row()" class="btn btn-primary" id="add_more"><i class="fa fa-plus"></i></button>
                    </div>

                    <div class="" id="capacity_container">
                    </div>

                <!-- </div>              
                <div class="col-md-6">
                    
                </div>  --> 
            </div>
            <div class="row">
                <div class="form-group  text-center">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary" href="{{ route('admin.shop_fuel_capacity.index') }}"><i  class="fa fa-fw fa-arrow-left"></i>နောက်သို့</a>
                        <button type="submit" class="btn btn-success"><i  class="fa fa-fw fa-floppy-o"></i>သိမ်းမည်</button>
                    </div>
                </div>
            </div>
           
        </form>
        <input type="hidden" id="ctr_token" value="{{ csrf_token()}}">
    </div>
</div>
@stop



@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.css') }}"/>
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
    
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
 <script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>

<script>
 $('#f_shop_id').select2({
        allowClear: true,
        placeholder: '--စက်သုံးဆီ အရောင်းဆိုင်--'
    });


 // $(".hotel").val();

 $(document).on("change", ".fuel", function(){
    // alert($(this).attr("id"))
        var fuel_type = $(this).val();
        var shop_id = $('#f_shop_id option:selected').val();
        var token = $("input[name='_token']").val();
        var select_id = $(this).attr("id");
        if (fuel_type != "") {
            $.ajax({
            type: "POST",
            url: '<?php echo route('admin.get_using_shop_fuel') ?>',
            data: {
                id: fuel_type,
                shop_id : shop_id,
                _token:token
            },
            success: function(data) {
                // alert(data);
                if (data == 0) {
                   $("#"+select_id).val("");

                    alert('already exit!');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        });
        }

    });


var fuel_types = <?php print_r(json_encode(App\Helper\Helpers::fuel_types())) ?>;
var f_types;
$.each(fuel_types, function (index, row) {
         // console.log(row);
        f_types += '<option value='+row.id+'>'+row.fuel_type+'</option>';
     });

var i = 0;
function add_row(){
 i++;

let html = '<div class="row options form-group" id="inputFile'+i+'"><div class="col-md-3"><select class="form-control fuel" id="fuel_type_'+i+'" name="fuel_type[]"><option value="">စက်သုံးဆီ အမျိုးအစား</option>'+f_types+'</select></div><div class="col-md-3"><input type="number" name="max_capacity[]" id="max_capacity_'+i+'" class="form-control" placeholder="116200"></div><div class="col-md-3"><input type="number" id="op_balance_'+i+'" name="op_balance[]" class="form-control" placeholder="62992"></div><div class="col-md-2"><input type="number" id="avg_balance_'+i+'" name="avg_balance[]" class="form-control" placeholder="62992"></div><button type="button" onclick="removeRow('+i+')" class="btn btn-danger"><i class="fa fa-minus"></i></button></div>'
    $("#capacity_container").append(html);

    $("#op_balance_"+i).on("change",function(){
        // alert('hi');
        var op_balance = $(this).val();
        var max_capacity = $(this).closest("div.options").find("input[name='max_capacity[]']").val();
        var amt = max_capacity - op_balance;

        // alert(amt);
        if (amt < 0) {
            // $('#op_balance_'+i).val("");
            $(this).closest("div.options").find("input[name='op_balance[]']").val("");
            alert('Invalid Number!');

        }

    });
}

function removeRow(id){
    $('#inputFile'+id).remove();
}


$("#op_balance_0").on("change",function(){

    var op_balance = $(this).val();
    // alert(op_balance);
    var max_capacity = $("#max_capacity_0").val();

    var amt = max_capacity - op_balance;

    // alert(amt);
    if (amt < 0) {
        $('#op_balance_0').val("");
        alert('Invalid Number!');

    }
});
</script>

@stop
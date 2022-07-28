@extends('adminlte::page')

@section('title', 'အရောင်းဆိုင်များ')

@section('content_header')

    <h1 class="unicode">အရောင်းဆိုင်များ</h1>

@stop

@section('content')
<div class="tab">
   <button class="tablinks"  id="shop" active>Shop Data</button>
  <button class="tablinks"  id="shop_img" >Shop Image</button>
   <button class="tablinks"  id="licence">Licence Image</button>
</div>
<form action="{{ route('admin.fuel_shops.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
   @csrf
   @method('post')
   <div id="shop_tab" class="tabcontent">
    <div class="row">
        <div class="col-md-6">
            <div class="row form-group">
                <h5 class="form-label col-md-4">အရောင်းဆိုင်အမည် *</h5>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="shop_name" id="shop_name" placeholder="မြဘုရင်" value="{{ old('shop_name') }}"  />

                    @if ($errors->has('shop_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('shop_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-4">ပိုင်ရှင်/ကုမ္ပဏီ/အဖွဲ့အစည်းအမည် *</h5>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="owner" id="owner" placeholder="ABC Trading Co.,Ltd" value="{{ old('owner') }}"  />

                    @if ($errors->has('owner'))
                        <span class="help-block">
                            <strong>{{ $errors->first('owner') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-4">တိုင်းဒေသကြီး/ပြည်နယ်*</h5>
                <div class="col-md-5">
                    @if(auth()->user()->role_id==1)
                        <select name="sd_id" id="sd_id" class="form-control">
                           <option value="">တိုင်းဒေသကြီး/ပြည်နယ်</option>
                           @foreach(App\Helper\Helpers::state_divisions() as $sd)
                           <option value="{{ $sd->id }}" {{ (old('sd_id')==$sd->id)?'selected':'' }}>{{ $sd->sd_name }}</option>
                           @endforeach
                       </select>
                    @else 
                        <select name="sd_id" id="sd_id" class="form-control">
                           @foreach(App\Helper\Helpers::state_divisions() as $sd)
                            @if(auth()->user()->sd_id==$sd->id)
                                <option value="{{ $sd->id }}" {{ (old('sd_id',auth()->user()->sd_id)==$sd->id)?'selected':'' }}>{{ $sd->sd_name }}
                                </option>
                            @endif
                           @endforeach
                       </select>
                    @endif 
                    @if ($errors->has('sd_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('sd_id') }}</strong>
                        </span>
                    @endif
                </div> 
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-4">မြို့နယ်*</h5>
                <div class="col-md-5">
                   <select name="tsh_id" id="township_id" class="form-control ctr_township" style="width:100%;">
                     @if(auth()->user()->role_id==3)
                        <option>--Select--</option>
                        @foreach(App\Helper\Helpers::townships() as $township)
                             <option value="{{ $township->id }}"  @if(old('tsh_id')==$township->id) selected @endif  >{{ $township->tsh_name_mm }}</option>
                        @endforeach
                     @endif
                   </select>
                    @if ($errors->has('tsh_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tsh_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-4">တည်နေရာ*</h5>
                <div class="col-md-5">
                    <textarea name="location" class="form-control" id="location" placeholder="(၀၆၇၅)၊ သာစည်ရပ်ကွက်၊ ဗန်းမော်မြို့">{{ old('location') }}</textarea>

                    @if ($errors->has('location'))
                        <span class="help-block">
                            <strong>{{ $errors->first('location') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-4">လတ္တီကျု</h5>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="lat" id="lat"  value="{{ old('lat') }}"   placeholder="25.6220616" />

                    @if ($errors->has('lat'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lat') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <h5 class="form-label col-md-4">လောင်ကျီကျု</h5>
                <div class="col-md-5">
                     <input type="text" class="form-control" name="lng" id="lng"  value="{{ old('lng') }}"   placeholder="96.2808322" />

                    @if ($errors->has('lng'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lng') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row form-group">
                <h5 class="form-label col-md-3">လိုင်စင်အမည် *</h5>
                <div class="col-md-5">
                     <select class="licence_id form-control" name="licence_id" id="licence_id" style="width:100%;">
                         <option value="">Select Licence</option>
                         @foreach(App\Helper\Helpers::licences() as $licence)
                         <option value="{{$licence->id}}">{{$licence->lic_name}}</option>
                         @endforeach
                     </select>

                    @if ($errors->has('licence_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('licence_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <!-- lic_grades -->
            <div class="row form-group">
                <h5 class="form-label col-md-3">လိုင်စင်အဆင့်</h5>
                <div class="col-md-5">
                     <select class="form-control" name="lic_grade_id" id="lic_grade_id">
                         <option value="">လိုင်စင်အဆင့်</option>
                         @foreach(App\Helper\Helpers::lic_grades() as $licence)
                         <option value="{{$licence->id}}">{{$licence->grade}}</option>
                         @endforeach
                     </select>

                    @if ($errors->has('lic_grade_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lic_grade_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="row form-group">
                <h5 class="form-label col-md-3">လိုင်စင် Prefix</h5>
                <div class="col-md-5">
                     <input type="text" name="lic_prefix" id="lic_prefix" value="" readonly class="form-control">
                </div>
            </div>

            <div class="row form-group">
                <h5 class="form-label col-md-3">လိုင်စင်အမှတ်*</h5>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="licence_no" id="licence_no" placeholder="0023" value="{{ old('licence_no') }}"  />

                    @if ($errors->has('licence_no'))
                        <span class="help-block">
                            <strong>{{ $errors->first('licence_no') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-3">ဆိုင်အမျိုးအစား*</h5>
                <div class="col-md-5">
                    <select class="form-control" id="shop_type" name="shop_type">
                        <option value="0">Minor Shop</option>
                        <option value="1">Major Shop</option>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-3">ထုတ်ပေးသည့်ရက်စွဲ*</h5>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="issue_date" id="issue_date"  value="{{ old('issue_date') }}"   placeholder="16-10-2021" />

                    @if ($errors->has('issue_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('issue_date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-3">သက်တမ်းကုန်ဆုံးရက်*</h5>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="expire_date" id="expire_date"  value="{{ old('expire_date') }}"   placeholder="29-10-2021" />

                    @if ($errors->has('expire_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('expire_date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-3">မှတ်ချက်</h5>
                <div class="col-md-5">
                    <textarea class="form-control" name="remark" id="remark"></textarea>
                </div>
            </div>
        </div>
    </div>
     <div class="form-group  text-center">
            <div class="col-md-3"></div>
            <div class="col-md-5">
                <a class="btn btn-primary" href="{{ route('admin.fuel_shops.index') }}"><i  class="fa fa-fw fa-arrow-left"></i>နောက်သို့</a>
                <a class="btn btn-success" id="shop_next"><i class="fa fa-fw fas fa-arrow-right"></i>ရှေ့သို့</a>

            </div>
        </div>
   </div>
   <div id="shop_img_tab" class="tabcontent">
       <div class="row">
           <div class="col-md-6">
            <div class="row" style="margin-left:10px;">
                <div class="col-md-6"><label>Photo Name*</label></div>
                <div class="col-md-6"><label>Photo*</label></div>
            </div>
            <div class="row" style="margin-left:10px;">
                <div class="row form-group">
                   <div class="col-md-6">
                      <input type="text" name="file_name[]" id="file_name" class="form-control">
                   </div>
                   <div class="col-md-5">
                      <input type="file" name="photo_name[]" id="photo_name" class="form-control">
                   </div>
                   <button type="button" onclick="add_photo()" class="btn btn-primary" id="add_more"><i class="fa fa-plus"></i></button>
                </div>
            </div>
               
                <div class="row" id="photo_container" style="margin-left:10px;">
                </div>
           </div>
           <div class="col-md-6">
               
           </div>
       </div>
       <div class="form-group ">
            <div class="col-md-3"></div>
            <div class="col-md-5">
                <a class="btn btn-primary" onclick="openTab(event, 'shop_tab')"><i  class="fa fa-fw fa-arrow-left"></i>နောက်သို့</a>
                <a class="btn btn-success" id="shop_img_next"><i class="fa fa-fw fas fa-arrow-right"></i>ရှေ့သို့</a>

            </div>
        </div>
   </div>
   <div id="licence_tab" class="tabcontent">
       <div class="row">
           <div class="col-md-6">
            <div class="row" style="margin-left:10px;">
                <div class="col-md-6"><label>Photo Name*</label></div>
                <div class="col-md-6"><label>Photo*</label></div>
            </div>
            <div class="row" style="margin-left:10px;">
                <div class="row form-group">
                   <div class="col-md-6">
                      <input type="text" name="lic_file_name[]" id="lic_file_name" class="form-control">
                   </div>
                   <div class="col-md-5">
                      <input type="file" name="lic_photo_name[]" id="lic_photo_name" class="form-control">
                   </div>
                   <button type="button" onclick="add_lic_photo()" class="btn btn-primary" id="add_more"><i class="fa fa-plus"></i></button>
                </div>
            </div>
               
                <div class="row" id="lic_photo_container" style="margin-left:10px;">
                </div>
           </div>
           <div class="col-md-6">
               
           </div>
       </div>
       <div class="form-group ">
            <div class="col-md-3"></div>
            <div class="col-md-5">
                <a class="btn btn-primary" onclick="openTab(event, 'shop_img_tab')"><i  class="fa fa-fw fa-arrow-left"></i>နောက်သို့</a>
                <!-- <a class="btn btn-success" id="shop_next"><i class="fa fa-fw fas fa-arrow-right"></i>သိမ်းမည်</a> -->
                <button type="submit" class="btn btn-success"><i class="fa fa-fw fas fa-save"></i>သိမ်းမည်</button>

            </div>
        </div>
   </div>
</form>
@stop



@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.css') }}"/>
 <style type="text/css" media="screen">
    th{
        background-color: rgba(0,0,0,.03);
    }
    .page_body{
        margin: 10px;
    }
     /* CHANGES */
    .dropdown-menu,.dropdown-toggle{
        min-width:100px;
    }
    .dropdown-menu>li>a{
      padding: 3px 5px 3px 0;
    }
    .tab {
       overflow: hidden;
       border: 1px solid #4287f5;
       background-color: #605ca8;
       color: white;
       }
       /* Style the buttons inside the tab */
       .tab button {
       background-color: inherit;
       float: left;
       border: none;
       outline: none;
       cursor: pointer;
       padding: 7px 20px;
       transition: 0.3s;
       color: white;
       }
       /* Change background color of buttons on hover */
       .tab button:hover {
       background-color: white;
       color: #605ca8;
       }
       /* Create an active/current tablink class */
       .tab button.active {
       background-color: white;
       color: #605ca8;
       }
       /* Style the tab content */
       .tabcontent {
       display: none;
       padding: 6px 12px;
       border: 1px solid #ccc;
       border-top: none;
       }
 </style>
   
@stop



@section('js')
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
 <script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
<script>
 $(document).ready(function(){
        document.getElementById("shop_tab").style.display = "block"; 
         $("#shop").addClass("active");
     });

 // shop_next
 $('#shop_next').on('click',function(){
        var shop_name = $("#shop_name").val();    
        var owner = $("#owner").val();
        var sd_id = $( "#sd_id option:selected" ).val();
        var township_id = $("#township_id option:selected").val();
        var location = $("#location").val();
        var lic_name = $("#licence_id option:selected").val();
        var lic_no = $("#licence_no").val();
        var issue_date = $("#issue_date").val();
        var expire_date = $("#expire_date").val();

        if (!shop_name) {
            $("#shop_name").css('border-color', function(){
                return '#f00';
            });
        }

        if (!owner) {
            $("#owner").css('border-color', function(){
                return '#f00';
            });
        }

        if (!sd_id) {
            $("#sd_id").css('border-color', function(){
                return '#f00';
            });
        }

        if (!township_id) {
            $("#township_id").css('border-color', function(){
                return '#f00';
            });
        }

        if (!location) {
            $("#location").css('border-color', function(){
                return '#f00';
            });
        }

        if (!lic_name) {
            $("#select2-lic_name_id-rr-container").css('border-color',function(){
                return '#f00';
            });
        }

        if (!lic_no) {
            $("#licence_no").css('border-color', function(){
                return '#f00';
            });
        }

        if (!issue_date) {
            $("#issue_date").css('border-color', function(){
                return '#f00';
            });
        }

        if (!expire_date) {
            $("#expire_date").css('border-color', function(){
                return '#f00';
            });
        }

        if (shop_name && owner && sd_id && township_id && location && licence_id && licence_no && issue_date && expire_date) {
            var i, tabcontent, tablinks;
           tabcontent = document.getElementsByClassName("tabcontent");
           for (i = 0; i < tabcontent.length; i++) {
               tabcontent[i].style.display = "none";
           }
           tablinks = document.getElementsByClassName("tablinks");
             for (i = 0; i < tablinks.length; i++) {
               tablinks[i].className = tablinks[i].className.replace(" active", "");
             }
           document.getElementById('shop_img_tab').style.display = "block";
           $("#shop_img").addClass("active");
        }


        $('#shop_name').on('change', function(){
            $("#shop_name").css('border-color', function(){
                return '#A9A9A9';
            });
        });
         $('#owner').on('change', function(){
            $("#owner").css('border-color', function(){
                return '#A9A9A9';
            });
        });

         $('#sd_id').on('change', function(){
            $("#sd_id").css('border-color', function(){
                return '#A9A9A9';
            });
        });
         $('#township_id').on('change', function(){
            $("#township_id").css('border-color', function(){
                return '#A9A9A9';
            });
        });

         $('#location').on('change', function(){
            $("#location").css('border-color', function(){
                return '#A9A9A9';
            });
        });
         $('#licence_id').on('change', function(){
            $("#licence_id").css('border-color', function(){
                return '#A9A9A9';
            });
        });

         $('#licence_no').on('change', function(){
            $("#licence_no").css('border-color', function(){
                return '#A9A9A9';
            });
        });
         $('#issue_date').on('change', function(){
            $("#issue_date").css('border-color', function(){
                return '#A9A9A9';
            });
        });

         $('#expire_date').on('change', function(){
            $("#expire_date").css('border-color', function(){
                return '#A9A9A9';
            });
        });
        
 });

// shop_img_next
 $('#shop_img_next').on('click',function(){
    var i, tabcontent, tablinks;
       tabcontent = document.getElementsByClassName("tabcontent");
       for (i = 0; i < tabcontent.length; i++) {
           tabcontent[i].style.display = "none";
       }
       tablinks = document.getElementsByClassName("tablinks");
         for (i = 0; i < tablinks.length; i++) {
           tablinks[i].className = tablinks[i].className.replace(" active", "");
         }
       document.getElementById('licence_tab').style.display = "block";
       $("#licence").addClass("active");
 });

   function openTab(evt, tabName) {
      // console.log(tabName);
         var i, tabcontent, tablinks;
         tabcontent = document.getElementsByClassName("tabcontent");
         for (i = 0; i < tabcontent.length; i++) {
           tabcontent[i].style.display = "none";
         }

         tablinks = document.getElementsByClassName("tablinks");
         for (i = 0; i < tablinks.length; i++) {
           tablinks[i].className = tablinks[i].className.replace(" active", "");
         }
         document.getElementById(tabName).style.display = "block";
         if (tabName == 'shop_tab') {
           $("#shop").addClass("active");
         }
         if (tabName == 'shop_img_tab') {
           $("#shop_img").addClass("active");
         }

        
    }

    $('#licence_id').select2({
        allowClear: true,
        placeholder: 'Select Licence'
    });

    $('#township_id').select2({
        allowClear: true,
        placeholder: 'Select Township'
    });

    var issue_date=$('input[name="issue_date"]').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            autoclose: true,
        });

     var expire_date=$('input[name="expire_date"]').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            autoclose: true,
        });

    $('#sd_id').on("change", function() {
        let val = $(this).val();
        var token = $("input[name='_token']").val();
        if (val != "") {
            $.ajax({
            type: "POST",
            url: '<?php echo route('admin.get_tsh') ?>',
            data: {
                id: val,
                _token:token
            },
            success: function(data) {
                $("#township_id").html(data);
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        });
        }
    });

    $('#licence_id').on('change',function(){
        let val = $(this).val();
        $.ajax({
                type: "GET",
                dataType: "json",
                url: "<?php echo(route("admin.get_lic_prefix")) ?>",
                data: {'lic_id': val},
                success: function(data){
                 $('#lic_prefix').val(data)
                }
            });
    });

    var i = 0;
       function add_photo(){
         i++;
   
        let html = '<div class="row form-group" id="inputFile'+i+'"><div class="col-md-6"><input type="text" name="file_name[]" id="file_name" class="form-control"></div><div class="col-md-5"><input type="file" name="photo_name[]" id="photo_name" class="form-control"></div><button type="button" onclick="removeRow('+i+')" class="btn btn-danger"><i class="fa fa-minus"></i></button></div>'
        $("#photo_container").append(html);
       }
   
       function removeRow(id){
            $('#inputFile'+id).remove();
        }

     var j = 0;
    function add_lic_photo(){
         j++;
   
        let html = '<div class="row form-group" id="lic_field'+j+'"><div class="col-md-6"><input type="text" name="lic_file_name[]" id="lic_file_name" class="form-control"></div><div class="col-md-5"><input type="file" name="lic_photo_name[]" id="lic_photo_name" class="form-control"></div><button type="button" onclick="removeRow('+j+')" class="btn btn-danger"><i class="fa fa-minus"></i></button></div>'
        $("#lic_photo_container").append(html);
       }
   
       function removeRow(id){
            $('#lic_field'+id).remove();
        }
    
</script>

@stop

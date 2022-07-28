@extends('adminlte::page')

@section('title', 'အရောင်းဆိုင်များ')

@section('content_header')

    <h1 class="unicode">အရောင်းဆိုင်များ</h1>

@stop

@section('content')
<?php 
     $tab_active = (isset($_GET['tab_active']))?$_GET['tab_active']:'';
 ?>
<div>
    <a class="btn btn-primary form-group" href="{{ route('admin.fuel_shops.index') }}"><i  class="fa fa-fw fa-arrow-left"></i>နောက်သို့</a>
</div>

@if($tab_active == 2)
<div class="tab" style="margin-top:10px;">
   <button class="tablinks"  id="shop" onclick="openTab(event, 'shop_tab')">Shop Data</button>
  
   <button class="tablinks"  id="shop_img" onclick="openTab(event, 'shop_img_tab')" active>Shop Image</button>
  
   <button class="tablinks"  id="licence" onclick="openTab(event, 'licence_tab')">Licence Image</button>
 
</div>
@elseif($tab_active == 3)
<div class="tab" style="margin-top:10px;">
   <button class="tablinks"  id="shop" onclick="openTab(event, 'shop_tab')">Shop Data</button>
  
   <button class="tablinks"  id="shop_img" onclick="openTab(event, 'shop_img_tab')">Shop Image</button>
  
   <button class="tablinks"  id="licence" onclick="openTab(event, 'licence_tab')" active>Licence Image</button>

</div>
@else
<div class="tab" style="margin-top:10px;">
   <button class="tablinks"  id="shop" onclick="openTab(event, 'shop_tab')" active>Shop Data</button>
  
   <button class="tablinks"  id="shop_img" onclick="openTab(event, 'shop_img_tab')">Shop Image</button>
  

   <button class="tablinks"  id="licence" onclick="openTab(event, 'licence_tab')">Licence Image</button>
   
</div>
@endif  
  <form action="{{route('admin.fuel_shops.update',$detail_data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
   @csrf
   @method('PUT')

    <div id="shop_tab" class="tabcontent">
        <div class="row">
        <div class="col-md-6">
            <div class="row form-group">
                <h5 class="form-label col-md-4">အရောင်းဆိုင်အမည် *</h5>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="shop_name" id="shop_name" placeholder="မြဘုရင်" value="{{ old('shop_name',$detail_data->shopName) }}"   />
                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-4">ပိုင်ရှင်/ကုမ္ပဏီ/အဖွဲ့အစည်းအမည် *</h5>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="owner" id="owner" placeholder="ABC Trading Co.,Ltd" value="{{ old('owner',$detail_data->owner) }}"  />
                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-4">တိုင်းဒေသကြီး/ပြည်နယ်*</h5>
                <div class="col-md-5">
                  @if(auth()->user()->role_id==1)
                        <select name="sd_id" id="sd_id" class="form-control">
                           <option value="">တိုင်းဒေသကြီး/ပြည်နယ်</option>
                           @foreach(App\Helper\Helpers::state_divisions() as $sd)
                           <option value="{{ $sd->id }}" {{ (old('sd_id',$detail_data->sd_id)==$sd->id)?'selected':'' }}>{{ $sd->sd_name }}</option>
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
                  <select name="tsh_id" id="township_id" class="form-control ctr_township" style="width:235px;">
                     @if(auth()->user()->role_id==3)
                        <option>--Select--</option>
                        @foreach(App\Helper\Helpers::townships() as $township)
                             <option value="{{ $township->id }}" {{$detail_data->tsh_id == $township->id ? 'selected' : ''}}>{{ $township->tsh_name_mm }}</option>
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
                    <textarea name="location" class="form-control" id="location" placeholder="(၀၆၇၅)၊ သာစည်ရပ်ကွက်၊ ဗန်းမော်မြို့" >{{ old('location',$detail_data->address) }}</textarea>

                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-4">လတ္တီကျု</h5>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="lat" id="lat"  value="{{ old('lat',$detail_data->lat) }}"   placeholder="25.6220616" />
                </div>
            </div>

             <div class="row form-group">
                <h5 class="form-label col-md-4">လောင်ကျီကျု</h5>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="lng" id="lng"  value="{{ old('lng',$detail_data->lng) }}"   placeholder="25.6220616"  />
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="row form-group">
                <h5 class="form-label col-md-3">လိုင်စင်အမည် *</h5>
                <div class="col-md-5">
                      <select class="licence_id form-control" name="licence_id" id="licence_id" style="width:235px;">
                         <option value="">Select Licence</option>
                         @foreach(App\Helper\Helpers::licences() as $licence)
                         <option value="{{$licence->id}}" {{$detail_data->licence_id == $licence->id ? 'selected' : ''}}>{{$licence->lic_gp_name}}</option>
                         @endforeach
                     </select>

                    @if ($errors->has('lng'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lng') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="row form-group">
                <h5 class="form-label col-md-3">လိုင်စင်အဆင့်</h5>
                <div class="col-md-5">
                      <select name="lic_grade_id" id="lic_grade_id" class="form-control">
                       <option value="">လိုင်စင်အဆင့်</option>
                       @foreach(App\Helper\Helpers::lic_grades() as $lic)
                       <option value="{{ $lic->id }}" {{ (old('lic_grade_id',$detail_data->lic_grade)==$lic->id)?'selected':'' }}>{{ $lic->grade }}</option>
                       @endforeach
                   </select>
                </div>
            </div>

           
            <div class="row form-group">
                <h5 class="form-label col-md-3">လိုင်စင်အမှတ်*</h5>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="licence_no" id="licence_no" placeholder="0023" value="{{ old('licence_no',$detail_data->licence_no) }}"   />
                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-3">ဆိုင်အမျိုးအစား*</h5>
                <div class="col-md-5">
                   <select class="form-control" id="shop_type" name="shop_type">
                        <option value="0" {{$detail_data->shop_type == "0" ? 'selected' : ''}}>Minor Shop</option>
                        <option value="1" {{$detail_data->shop_type == "1" ? 'selected' : ''}}>Major Shop</option>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-3">ထုတ်ပေးသည့်ရက်စွဲ*</h5>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="issue_date" id="issue_date"  value="{{ old('issue_date',date('d-m-Y',strtotime($detail_data->lic_issue_date))) }}"   placeholder="16-10-2021" />
                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-3">သက်တမ်းကုန်ဆုံးရက်*</h5>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="expire_date" id="expire_date"  value="{{ old('expire_date',date('d-m-Y',strtotime($detail_data->lic_expire_date))) }}"   placeholder="29-10-2021" />
                </div>
            </div>
            <div class="row form-group">
                <h5 class="form-label col-md-3">မှတ်ချက်</h5>
                <div class="col-md-5">
                    <textarea class="form-control" name="remark" id="remark">{{$detail_data->remark}}</textarea>
                </div>
            </div>
            <div class="form-group  text-center">
            <div class="col-md-3"></div>
            <div class="col-md-5">
              
                <button type="submit" class="btn btn-success"><i class="fa fa-fw fas fa-save"></i>သိမ်းမည်</button>
            </div>
        </div>
        </div>
    </div>
    </div>
    <div id="shop_img_tab" class="tabcontent">
        <div class="row">
            <div class="col-md-6">
                 <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Photo Name</th>
                            <th>Photo</th>
                            <th></th>
                        </tr>
                        @foreach($shop_photos as $key=>$shop_photo)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$shop_photo->photo_name}}</td>
                            <td>
                                <img src="{{asset($shop_photo->path.$shop_photo->name)}}" style="width:100px;height: 100px;">
                            </td>
                            <td>
                                <a title="ပြင်ရန်" id="{{$shop_photo->id}}" data-name="{{$shop_photo->photo_name}}"  class="btn btn-sm btn-info edit"><i class="fa fa-fw fa-edit" /></i></a>

                               <a href="{{url('admin/attach_delete?attach_id='.$shop_photo->id.'&shop_id='.$shop_photo->shop_id)}}" class="btn btn-sm btn-danger btn-sm"  onclick="return confirm('Do you want to delete?');">  <i class="fa fa-fw fa-trash" title="Delete"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row" style="margin-right:10px;">
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
                <div class="form-group  text-center">
                <div class="col-md-3"></div>
                <div class="col-md-5">
                   <button type="submit" class="btn btn-success"><i class="fa fa-fw fas fa-save"></i>သိမ်းမည်</button>
                </div>
            </div>
            </div>
        </div>
       
    </div>
    <div id="licence_tab" class="tabcontent">
        <div class="row">
            <div class="col-md-6">
                <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Photo Name</th>
                        <th>Photo</th>
                        <th></th>
                    </tr>
                    @foreach($licence_photos as $key=>$licence_photo)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$licence_photo->photo_name}}</td>
                        <td>
                            <img src="{{asset($licence_photo->path.$licence_photo->name)}}" style="width:100px;height: 100px;">
                        </td>
                        <td>
                            <a title="ပြင်ရန်" id="{{$licence_photo->id}}" data-name="{{$licence_photo->photo_name}}"  class="btn btn-sm btn-info lic_edit"><i class="fa fa-fw fa-edit" /></i></a>

                           <a href="{{url('admin/lic_photo_delete?attach_id='.$licence_photo->id.'&shop_id='.$licence_photo->shop_id)}}" class="btn btn-sm btn-danger btn-sm"  onclick="return confirm('Do you want to delete?');">  <i class="fa fa-fw fa-trash" title="Delete"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            </div>
            <div class="col-md-6">
                <div class="row">
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
                <div class="form-group  text-center">
                <div class="col-md-3"></div>
                <div class="col-md-5">
                   <button type="submit" class="btn btn-success"><i class="fa fa-fw fas fa-save"></i>သိမ်းမည်</button>

                </div>
            </div>
            </div>
        </div>
        
    </div>
</form>
    <!-- img edit modal -->
    <div class="modal" id="img_edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-md">
          <!-- Modal content-->
          <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title">Edit Photo...</h5>
                <div class="pull-right">
                    <button type="button" id="edit_close" data-dismiss="modal">&times;</button>
                </div>
                
             </div>
             <div class="modal-body">
                <form action="{{route('admin.shop_photo_update')}}" method="post" enctype="multipart/form-data">
                   @csrf
                   @method('POST')
                   <input type="hidden" name="doc_id" id="doc_id">
                   <label>File Name</label>
                   <input type="text" name="f_name" id="f_name" class="form-control" required>
                   <label>Photo</label>
                   <input type="file" name="doc_file" class="form-control">
                   <br>
                   <div class="row form-group">
                      <div class="col-md-5"></div>
                      <div class="col-md-6">
                         <button type="submit" class="btn btn-primary my-2">Update</button>
                      </div>
                   </div>
                </form>
             </div>
          </div>
       </div>
    </div>

    <!-- lic_edit -->
    <div class="modal" id="lic_edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-md">
          <!-- Modal content-->
          <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title">Edit Photo...</h5>
                <div class="pull-right">
                    <button type="button" id="lic_edit_close" data-dismiss="modal">&times;</button>
                </div>
                
             </div>
             <div class="modal-body">
                <form action="{{route('admin.lic_photo_update')}}" method="post" enctype="multipart/form-data">
                   @csrf
                   @method('POST')
                   <input type="hidden" name="lic_shop_id" id="lic_shop_id">
                   <label>File Name</label>
                   <input type="text" name="lic_name" id="lic_name" class="form-control" required>
                   <label>Photo</label>
                   <input type="file" name="doc_file" class="form-control">
                   <br>
                   <div class="row form-group">
                      <div class="col-md-5"></div>
                      <div class="col-md-6">
                         <button type="submit" class="btn btn-primary my-2">Update</button>
                      </div>
                   </div>
                </form>
             </div>
          </div>
       </div>
    </div>
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.css') }}"/>
<style type="text/css">
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
<script type="text/javascript">
    var tab_active = <?php print_r(json_encode($tab_active)) ?>;
    if (tab_active == 2) {
        $(document).ready(function(){
            document.getElementById("shop_img_tab").style.display = "block"; 
             $("#shop_img").addClass("active");
         });
    }else if (tab_active == 3) {
        $(document).ready(function(){
            document.getElementById("licence_tab").style.display = "block"; 
             $("#licence").addClass("active");
         });
    }else{
        $(document).ready(function(){
            document.getElementById("shop_tab").style.display = "block"; 
             $("#shop").addClass("active");
         });
    }
     

    function openTab(evt, tabName) {
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
      evt.currentTarget.className += " active";
      
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

     $(document).ready(function(){
        var detail_data = <?php print_r(json_encode($detail_data)) ?>;
        // console.log(data);
        var token = $("input[name='_token']").val();
        if (detail_data != "") {
            $.ajax({
            type: "POST",
            url: '<?php echo route('admin.get_tsh') ?>',
            data: {
                id: detail_data.tsh_id,
                _token:token
            },
            success: function(data) {
                $("#township_id").html(data);
                 $("select[name='tsh_id']:eq(0)").val(detail_data.tsh_id);
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        });
        }
     });

     $(document).on("click", ".edit", function(){
        var doc_id = $(this).attr('id');
        var file_name = $(this).attr('data-name');
        $('#doc_id').val(doc_id);
   
         $('#f_name').val(file_name);
   
         $('#img_edit_modal').modal('show');
    });

     $('#edit_close').click(function(){
        $('#img_edit_modal').modal('hide');
    });


     // lic_edit
     $(document).on("click", ".lic_edit", function(){
        var doc_id = $(this).attr('id');
        var file_name = $(this).attr('data-name');
        $('#lic_shop_id').val(doc_id);
   
         $('#lic_name').val(file_name);
   
         $('#lic_edit_modal').modal('show');
    });

     $('#lic_edit_close').click(function(){
        $('#lic_edit_modal').modal('hide');
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
   
        let html = '<div class="row form-group" id="lic_field'+j+'"><div class="col-md-6"><input type="text" name="lic_file_name[]" id="lic_file_name" class="form-control"></div><div class="col-md-5"><input type="file" name="lic_photo_name[]" id="lic_photo_name" class="form-control"></div><button type="button" onclick="removelicRow('+j+')" class="btn btn-danger"><i class="fa fa-minus"></i></button></div>'
        $("#lic_photo_container").append(html);
       }
   
       function removelicRow(id){
            $('#lic_field'+id).remove();
        }
</script>
@stop
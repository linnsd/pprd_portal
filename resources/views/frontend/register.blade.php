<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form </title>

    <!-- Font Icon -->
    <link rel="icon" href="favicon/mmia.jpg" type="image/jpg">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('frontend/register/css/style.css')}} ">

    <link type="text/css" media="screen"  rel="stylesheet"  href="{{ asset('css/croppie.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-3.min.css')}}">
    <style>
        .hidden{
            display: none;
        }
    </style>


    
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=pyidaungsu' />
  
    <style type="text/css" media="screen">

        body{
             font-family:Pyidaungsu,Yunghkio,'Masterpiece Uni Sans' !important;
        }
        .unicode{
            font-family:Pyidaungsu,Yunghkio,'Masterpiece Uni Sans' !important;
        }
        
    </style>
    
    

    <!-- JS -->
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

{{--     <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script> --}}
    {{-- <script src="{{ asset('frontend/register/vendor/jquery/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('frontend/register/js/main.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/croppie.js')}}"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="{{ asset('js/config.js')}}"></script>
    <!-- end page level js -->

</head>
<body>

    <div class="main" style="margin-top: -80px;">
        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container" style="width: 660px !important;">
                <div class="signup-content">
                    <center>
                        <img src="{{ asset('img/mmia.png')}}" alt="mima" width="20%">
                        <h4 class="form-title unicode" align="center">Member Registration Form</h4>
                    </center>
                    <hr>
                    <form method="POST" action="{{ route('frontend.register.store')}}" id="signup-form" class="signup-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="form-label">အမည္ *</label>
                                    <input type="text" class="form-input zawgyi" name="name" id="name" placeholder="ဥပမာ- ဦးေမာင္ေမာင္" value="{{ old('name') }}" required />
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="" class="form-label">မွတ္ပုံတင္နံပါတ္*</label>
                                    <input type="text" class="form-input zawgyi" value="{{ old('nrc') }}" name="nrc" id="nrc" placeholder="ဥပမာ - ၉/ပမန(ႏိုင္)၁၂၃၄၅၆"/>
                                    @if ($errors->has('nrc'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nrc') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="" class="form-label">အီးေမးလ္ *</label>
                                    <input type="email" class="form-input zawgyi" name="email" id="email" placeholder="ဥပမာ - mgmg@gmail.com" value="{{ old('email') }}" required/>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="" class="form-label">ဖုန္းနံပါတ္ *</label>
                                    <input type="number" value="{{ old('phone') }}" class="form-input zawgyi" name="phone" id="phone" placeholder="Phone Number" required/>
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                               

                                <div class="form-group">
                                    <label for="" class="form-label">ဆိုင္အမည္/ကုမၸဏီအမည္ *</label>
                                    <input type="text" class="form-input zawgyi" name="business_name" id="business_name" placeholder="Eg: ABC Mobile Store" value="{{ old('business_name') }}"  required />
                                    @if ($errors->has('business_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('business_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label for="" class="form-label">ေနရပ္လိပ္စာ *</label>
                                    <textarea class="form-input zawgyi" name="address" id="address" placeholder="Address" >{{ old('address') }}</textarea>
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="" class="form-label">ၿမိဳ႕နယ္</label>
                                    <input type="text" class="form-input zawgyi" name="township" id="township"  value="{{ old('township') }}"  />
                                    @if ($errors->has('township'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('township') }}</strong>
                                        </span>
                                    @endif
                                    
                                </div>
                               
                                <div class="form-group">
                                    <label for="" class="form-label">ျပည္နယ္/တိုင္း *</label>
                                    <select name="state_division_id" id="state_division_id" class="form-input zawgyi">
                                            <option value="">ျပည္နယ္/တိုင္း ေ႐ြးခ်ယ္ပါ</option>
                                        @foreach($statedivisions as $sd)
                                            <option value="{{ $sd->id }}" {{ (old('state_division_id')==$sd->id)?'selected':'' }}>{{ $sd->sd_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('state_division_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('state_division_id') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                

                                

                               {{--  <div class="form-group">
                                    <label for="" class="form-label">Profile Picture *</label>
                                    <input type="file" class="form-input upload"  id="pic" placeholder="Profile Picture" />
                                    <img src="" alt="profile preview" class="hidden" id="image_preview" width="30%">
                                    <button id="remove_preview" class="btn btn-danger hidden btn-sm">Remove Photo</button>
                                    <input type="hidden" name="pic" value="{{ old('pic') }}" id="hidden_photo">
                                </div> --}}
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-4"></div>
                             <div class="col-md-4">
                                 <div class="form-group">
                                    <input type="submit"  id="submit" class="form-submit" value="Submit"/>
                                </div>
                             </div>
                              <div class="col-md-4"></div>
                        </div>
                            

                         <div class="form-group">
                            <a href="{{ url('/') }}">
                                Back to Home
                            </a>
                        </div>

                    </form>
                    </div>
                    <input type="hidden" id="ctr_token" value="{{ csrf_token()}}">
                   
            </div>
        </section>

    </div>
</body>
<script>
    $(document).ready(function(){

    });

    $('#state_division_id').change(function(){
            getTownshipByStateDivision($(this).val());
    });

   function getTownshipByStateDivision($id) {
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            $.ajax({
                url : $baseurl+'getTownshipByStateDivision',
                dataType : 'html',
                method : 'post',
                data : {
                        'state_division_id' : $id,
                        '_token': $('#ctr_token').val()
                },
                success : function(data){
                    $('#township_id').html(data);
                    if(data==""){
                        $('#township_id').html('<option value="">ျပည္နယ္/တိုင္း ေ႐ြးခ်ယ္ပါ</option>');
                    }
                },
                error : function(error){
                    console.log(error);
                }
            });
    }

    
</script>
</html>
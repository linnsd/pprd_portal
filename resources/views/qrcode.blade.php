<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form </title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('frontend/register/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('frontend/register/css/style.css')}} ">
    <style>
        svg[Attributes Style] {
            width: 100% !important;
        }
    </style>
</head>
<body>

    <div class="main" style="margin-top: -100px;">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <center>
                    <img src="{{ asset('img/mmia.png')}}" alt="mima" width="30%">
                    </center>
                    <br><br>
                    <form  id="signup-form" class="signup-form">
                        @csrf
                        <h2 class="form-title" align="center">Scan QR code  and Register to attend! </h2>
                        <div class="form-group" align="center">
                            {!! QrCode::size(400)->generate('http://evnk.co/mmiareg'); !!}
                            {{-- <img width="300" height="auto" src="{{ asset('uploads/'.$user->id.'_qrcode.png') }}" alt="qrcode"> --}}
                        </div>
                        <div align="center">
                           <h3>http://evnk.co/mmiareg</h3>
                        </div>

                    </form>
                    </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="{{ asset('frontend/register/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/register/js/main.js')}}"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
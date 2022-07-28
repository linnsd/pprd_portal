@extends('frontend.layout')
<style>
  .bracdcurmb-div{
    background: radial-gradient(circle farthest-side at center bottom,#0085c3,#00618d 110%);
  }
  .breadcrumb{
    margin-top: 10px;
  }
  .help-block{
      color: red;
      font-size: 12px;
  }
</style>

@section('content')

<!--================Hero Banner Area Start =================-->
  <section class="bracdcurmb-div">
    <div class="container">
      <nav aria-label="breadcrumb" class="banner-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item unicode"><a href="{{ url('/')}}">Home</a></li>
          <li class="breadcrumb-item active unicode" aria-current="page">Contact Us</li>
        </ol>
      </nav>
    </div>
  </section>
  <!--================Hero Banner Area End =================-->


  <!-- ================ contact section start ================= -->
  <section class="">
    <div class="container">
        @if ($message = Session::get('success'))
            <div class="alert success-txt" style="color: #155724;">
                <p>{{ $message }}</p>
            </div>
        @endif
      <div class="row">
        <div class="col-12">
          <h2 class="contact-title unicode">Get in Touch</h2>
        </div>
        <div class="col-lg-8">
          <form class="form-contact contact_form" action="{{ route('frontend.contact.post') }}" method="post" id="contactForm" novalidate="novalidate">
            @csrf
            <div class="row">
             
              <div class="col-sm-6">
                <div class="form-group">
                  <input class="form-control" name="name" id="name" type="text" placeholder="Enter your name">
                   @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input class="form-control" name="email" id="email" type="email" placeholder="Enter email address">
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <input class="form-control" name="subject" id="subject" type="text" placeholder="Enter Subject">
                  @if ($errors->has('subject'))
                      <span class="help-block">
                          <strong>{{ $errors->first('subject') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
            </div>
             <div class="col-12">
                <div class="form-group">
                    <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" placeholder="Enter Message"></textarea>
                    @if ($errors->has('message'))
                      <span class="help-block">
                          <strong>{{ $errors->first('message') }}</strong>
                      </span>
                    @endif
                </div>
              </div>
            <div class="form-group mt-3">
              <button type="submit" class="button button-contactForm unicode">Send Message</button>
            </div>
          </form>


        </div>

        <div class="col-lg-4">
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-home"></i></span>
            <div class="media-body">
              <h3 class="unicode">Address......</h3>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-email"></i></span>
            <div class="media-body">
              <h3><a class="unicode" href="mailto:rnd@linncomputer.com">test@gmail.com</a></h3>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-facebook"></i></span>
            <div class="media-body">
              <h3><a class="unicode" target="_blank" href="#">Your Fb page </a></h3>
            </div>
          </div>
            <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
            <div class="media-body">
              <h3 class="unicode">Phones No-</h3>
              <h3><a href="tel:09123456890" class="unicode">09123456890</a></h3>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-lg-3 mb-4 mb-md-0">
          
        </div>
        <div class="col-md-8 col-lg-9">
          
        </div>
      </div>

{{--       <div class="d-none d-sm-block mb-5 pb-4">
        <p class="unicode">Location On Map!</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1909.1179112640843!2d96.08686324503294!3d16.86422499794602!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTbCsDUxJzUxLjIiTiA5NsKwMDUnMTYuMCJF!5e0!3m2!1sen!2smm!4v1562229886106!5m2!1sen!2smm" width="80%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    
      </div> --}}


    </div>
  </section>
  <!-- ================ contact section end ================= -->

  <script src="{{ asset('js/jquery-1.11.3.min.js') }}"></script>
  <script> 
    $("document").ready(function(){
        setTimeout(function(){
            $("div.success-txt").remove();
        }, 3000 ); // 3 secs
    });
  </script>

@endsection


  
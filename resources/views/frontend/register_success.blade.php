@extends('frontend.layout')

{{--     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> --}}
@section('content')

  <section class="blog_area single-post-area">
      <div class="container">
          <div class="row">
              <div class="col-lg-12 posts-list">
                  <div class="single-post">
                      <div class="blog_details">
                          <h3 style="color: green;">Registration successful!</h3>
                          <p>Thank you for your registration. We will contact you soon!</p>
                          <br>
                          
                          <a class="button button-header" title="home"  id="home" href="{{ url('/') }}">Back to home</a>
                            <br><br>
                       
                      </div>
                  </div>

              </div>
          </div>
      </div>
  </section>
  <!--================ Innovation section End =================-->


@endsection

</script>

  
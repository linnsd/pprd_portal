@extends('frontend.layout')
<style>
    .bracdcurmb-div{
    background: radial-gradient(circle farthest-side at center bottom,#0085c3,#00618d 110%);
  }
  .breadcrumb{
    margin-top: 10px;
  }
</style>

@section('content')
 <!--================Hero Banner Area Start =================-->
  <section class="bracdcurmb-div">
    <div class="container">
      <nav aria-label="breadcrumb" class="banner-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('news') }}">News</a></li>
          <li class="breadcrumb-item active" aria-current="page">News Detail</li>
        </ol>
      </nav>
    </div>
  </section>
  <!--================Hero Banner Area End =================-->


  <!--================Blog Area =================-->
  <section class="blog_area single-post-area">
      <div class="container">
          <div class="row">
              <div class="col-lg-8 posts-list">
                  <div class="single-post">
                    <br><br>
                      <h3 class="zawgyi">{{ $post->title}}</h3>
                          <br>
                          <div class="feature-img">
                            @if($post->feature_photo!='')
                              <img class="card-img rounded-0" src="{{ asset('uploads/posts/'.$post->feature_photo)}}" alt="feature photo">
                            @endif
                          </div>
                      <div class="blog_details">
                          <div class="zawgyi">
                              {!! $post->detail_description !!}
                          </div>
                          @if($post->detail_photo!='')
                          <img class="card-img rounded-0" src="{{ asset('uploads/posts/'.$post->detail_photo)}}" alt="detail photo">
                          @endif

                          <br><br><br>
                          
                       
                      </div>
                  </div>

              </div>
              <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    {{--   <aside class="single_sidebar_widget search_widget">
                          <form action="#">
                            <div class="form-group">
                              <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search Keyword">
                                <div class="input-group-append">
                                  <button class="btn" type="button"><i class="ti-search"></i></button>
                                </div>
                              </div>
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100" type="submit">Search</button>
                          </form>
                      </aside> --}}

                      <aside class="single_sidebar_widget popular_post_widget">
                          <h3 class="widget_title">Recent Post</h3>
                          @foreach($latest as $lpost)
                          <div class="media post_item">
                            <a href="{{ url('news/'.$lpost->id)}}">
                              <img src="{{ asset('uploads/posts/'.$lpost->feature_photo)}}" alt="post" width="100">
                            </a>
                              <div class="media-body">
                                  <a href="{{ url('news/'.$lpost->id)}}">
                                      <h3 class="zawgyi">{{ $lpost->title}}</h3>
                                  </a>
                                  <p>{{ date(" M d y", strtotime($lpost->publish_date))}}</p>
                              </div>
                          </div>
                          @endforeach
                      </aside>
                     
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!--================Blog Area =================-->



@endsection


  
@extends('frontend.main_master')

@section('frontend')
<section style="background: url(https://d19m59y37dris4.cloudfront.net/blog/1-2-1/img/hero.jpg); background-size: cover; background-position: center center" class="hero">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <h1>Blog</h1><a href="#" class="hero-link">Discover More</a>
          </div>
        </div><a href=".intro" class="continue link-scroll"><i class="fa fa-long-arrow-down"></i> Scroll Down</a>
      </div>
    </section>
    <!-- Intro Section-->
    <section class="intro">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <h2 class="h3">Some great intro here</h2>
            <p class="text-big">Place a nice <strong>introduction</strong> here <strong>to catch reader's attention</strong>. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderi.</p>
          </div>
        </div>
      </div>
    </section>
    <section class="featured-posts no-padding-top">
      <div class="container">
        <!-- Post-->
	@foreach($blogs as $blog)	
        <div class="row d-flex align-items-stretch">
          <div class="text col-lg-7">
            <div class="text-inner d-flex align-items-center">
              <div class="content">
                <header class="post-header">
                  <div class="category"><a href="#">Business</a></div><a href="{{ url('/post/'.$blog->id.'/'.$blog->title) }}">
                    <h2 class="h4">{{ $blog->title }}</h2></a>
                </header>
                <p>{{ $blog->description }}</p>
				@php
					$comment = App\Models\BlogComment::where('blog_id',$blog->id)->where('status',1)->latest()->limit(1)->first();
					$comments = App\Models\BlogComment::where('blog_id',$blog->id)->where('status',1)->get();
				@endphp

                <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                    <div class="avatar"><img src="https://d19m59y37dris4.cloudfront.net/blog/1-2-1/img/avatar-1.jpg" alt="..." class="img-fluid"></div>
                    <div class="title"><span>John Doe</span></div></a>
                  <div class="date"><i class="icon-clock"></i> {{ Carbon\Carbon::parse($blog->created_at)->diffForHumans() }}</div>
                  <div class="comments"><i class="icon-comment"></i>{{ count($comments) }}</div>
                </footer>
				<br><br>
				<h6><a href="{{ url('/post/'.$blog->id.'/'.$blog->title) }}">Comment Here...</a></h6>
              </div>
            </div>
          </div>
          <div class="image col-lg-5"><img src="{{ asset($blog->image) }}" alt="..."></div>
        </div>
		
	@endforeach
       
    </section>
    <!-- Divider Section-->
    <section style="background: url(https://d19m59y37dris4.cloudfront.net/blog/1-2-1/img/divider-bg.jpg); background-size: cover; background-position: center bottom" class="divider">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</h2><a href="#" class="hero-link">View More</a>
          </div>
        </div>
      </div>
    </section>
    <!-- Latest Posts -->
    <section class="latest-posts"> 
      <div class="container">
        <header> 
          <h2>Latest from the blog</h2>
          <p class="text-big">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        </header>
        <div class="row">
		@foreach($blogs as $blog)
          <div class="post col-md-4">
            <div class="post-thumbnail"><a href="{{ url('/post/'.$blog->id.'/'.$blog->title) }}"><img src="{{ asset($blog->image) }}" alt="..." class="img-fluid"></a></div>
            <div class="post-details">
              <div class="post-meta d-flex justify-content-between">
                <div class="date">{{ Carbon\Carbon::parse($blog->created_at)->format('d F Y') }}</div>
                <div class="category"><a href="#">Business</a></div>
              </div><a href="{{ url('/post/'.$blog->id.'/'.$blog->title) }}">
                <h3 class="h4">{{ $blog->title }}</h3></a>
              <p class="text-muted">{{ $blog->description }}</p>
            </div>
          </div>
		@endforeach 
          
        </div>
      </div>
    </section>
   
    <!-- Gallery Section-->
    <section class="gallery no-padding">    
      <div class="row">
        <div class="mix col-lg-3 col-md-3 col-sm-6">
          <div class="item"><a href="#" data-fancybox="gallery" class="image"><img src="https://d19m59y37dris4.cloudfront.net/blog/1-2-1/img/gallery-1.jpg" alt="..." class="img-fluid">
              <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div></a></div>
        </div>
        <div class="mix col-lg-3 col-md-3 col-sm-6">
          <div class="item"><a href="#" data-fancybox="gallery" class="image"><img src="https://d19m59y37dris4.cloudfront.net/blog/1-2-1/img/gallery-2.jpg" alt="..." class="img-fluid">
              <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div></a></div>
        </div>
        <div class="mix col-lg-3 col-md-3 col-sm-6">
          <div class="item"><a href="#" data-fancybox="gallery" class="image"><img src="https://d19m59y37dris4.cloudfront.net/blog/1-2-1/img/gallery-3.jpg" alt="..." class="img-fluid">
              <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div></a></div>
        </div>
        <div class="mix col-lg-3 col-md-3 col-sm-6">
          <div class="item"><a href="#" data-fancybox="gallery" class="image"><img src="https://d19m59y37dris4.cloudfront.net/blog/1-2-1/img/gallery-4.jpg" alt="..." class="img-fluid">
              <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div></a></div>
        </div>
      </div>
    </section>
	
	@endsection
@extends('frontend.main_master')

@section('frontend')
 <div class="container">
      <div class="row">
        <!-- Latest Posts -->
        <main class="post blog-post col-lg-8"> 
          <div class="container">
		    @if(session('success'))
			  <div class="alert alert-success alert-dismissible fade show" role="alert">
			  <strong>{{session('success')}}</strong>
			  <button type="button" class="close" data-dismiss="alert" aria-label="close">
			  <span aria-hidden="true">&times;</span>
			  </button>
			  </div>
			@endif
            <div class="post-single">
              <div class="post-thumbnail"><img src="{{ asset($blog->image) }}" alt="..." class="img-fluid"></div>
              <div class="post-details">
                <div class="post-meta d-flex justify-content-between">
                  <div class="category"><a href="#">Business</a></div>
                </div>
                <h1>{{ $blog->title }}<a href="#"><i class="fa fa-bookmark-o"></i></a></h1>
                <div class="post-footer d-flex align-items-center flex-column flex-sm-row"><a href="#" class="author d-flex align-items-center flex-wrap">
                    <div class="avatar"><img src="https://d19m59y37dris4.cloudfront.net/blog/1-2-1/img/avatar-1.jpg" alt="..." class="img-fluid"></div>
                    <div class="title"><span>John Doe</span></div></a>
                  <div class="d-flex align-items-center flex-wrap">       
                    <div class="date"><i class="icon-clock"></i>{{ Carbon\Carbon::parse($blog->created_at)->diffForHumans() }}</div>
                   
                    <div class="comments meta-last"><i class="icon-comment"></i>{{ count($comments) }}</div>
                  </div>
                </div>
                <div class="post-body">
                  <p class="lead">{{ $blog->description }}</p>
                 
                </div>
				
				 <!-- Go to www.addthis.com/dashboard to customize your tools -->
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-6170224abc9c1b7f"></script>
			
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_inline_share_toolbox_ec2p"></div>
				
				
                
                <div class="post-comments">
                  <header>
                    <h3 class="h6">Post Comments<span class="no-of-comments">({{ count($comments) }})</span></h3>
                  </header>
				  @forelse($comments as $comment)
                  <div class="comment">
                    <div class="comment-header d-flex justify-content-between">
                      <div class="user d-flex align-items-center">
                        <div class="image"><img src="https://d19m59y37dris4.cloudfront.net/blog/1-2-1/img/user.svg" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="title"><strong>{{ $comment->comment }}</strong><span class="date">{{ Carbon\Carbon::parse($comment->created_at)->format('d F Y') }}</span></div>
                      </div>
                    </div>
                    <div class="comment-body">
                      <p>{{ $comment->comment }}</p>
                    </div>
                  </div>
				  @empty
					<div class="text-danger">No Comments Yet</div>
				  @endforelse
                  
                 
                </div>
                <div class="add-comment">
                  <header>
                    <h3 class="h6">Leave a reply</h3>
                  </header>
                  <form action="{{ route('submit.comment') }}" class="commenting-form" method="post">
				  @csrf
				  <input type="hidden" name="id" id="id" class="form-control" value="{{ $blog->id }}">
                    <div class="row">
                      <div class="form-group col-md-6">
                        <input type="text" name="username" id="username" placeholder="Name" class="form-control" required>
                      </div>
                      <div class="form-group col-md-6">
                        <input type="email" name="useremail" id="useremail" placeholder="Email Address (will not be published)" class="form-control" required>
                      </div>
                      <div class="form-group col-md-12">
                        <textarea name="usercomment" id="usercomment" placeholder="Type your comment" class="form-control" required></textarea>
                      </div>
                      <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-secondary">Submit Comment</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </main>
        <aside class="col-lg-4">
          <!-- Widget [Search Bar Widget]-->
          <!--<div class="widget search">
            <header>
              <h3 class="h6">Search the blog</h3>
            </header>
            <form action="#" class="search-form">
              <div class="form-group">
                <input type="search" placeholder="What are you looking for?">
                <button type="submit" class="submit"><i class="icon-search"></i></button>
              </div>
            </form>
          </div>-->
          <!-- Widget [Latest Posts Widget]        -->
          <div class="widget latest-posts">
            <header>
              <h3 class="h6">Latest Posts</h3>
            </header>
            <div class="blog-posts">
			@php
				$blogs = App\Models\Blog::where('id','!=',$blog->id)->latest()->limit(5)->get();
				
			@endphp
			
			@foreach($blogs as $blo)
				@php
					$blogcomments = App\Models\BlogComment::where('blog_id',$blo->id)->where('status',1)->get();
				@endphp
				<a href="#">
                <div class="item d-flex align-items-center">
                  <div class="image"><img src="{{ asset($blo->image) }}" alt="..." class="img-fluid"></div>
                  <div class="title"><strong>{{ $blo->title }}</strong>
                    <div class="d-flex align-items-center">
                     
                      <div class="comments"><i class="icon-comment"></i>{{ count($blogcomments) }}</div>
                    </div>
                  </div>
                </div></a>
			@endforeach	
			</div>
          </div>
		  
		 
            

         
          <!-- Widget [Tags Cloud Widget]-->
          <div class="widget tags">       
            <header>
              <h3 class="h6">Tags</h3>
            </header>
            <ul class="list-inline">
              <li class="list-inline-item"><a href="#" class="tag">#Business</a></li>
              <li class="list-inline-item"><a href="#" class="tag">#Technology</a></li>
              <li class="list-inline-item"><a href="#" class="tag">#Fashion</a></li>
              <li class="list-inline-item"><a href="#" class="tag">#Sports</a></li>
              <li class="list-inline-item"><a href="#" class="tag">#Economy</a></li>
            </ul>
          </div>
        </aside>
      </div>
    </div>
	@endsection
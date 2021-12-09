<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Blog') }}
        </h2>
    </x-slot>

	
    <div class="py-12">	
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
					<div class="container">					
						<div class="row">
							<div class="col-md-12">
								<form method="post" action="{{ route('blog.update') }}" enctype="multipart/form-data">
									@csrf
									<div class="form-group">
										<label for="title">Blog Title</label>
										<input type="text" class="form-control" name="title" id="title" placeholder="Blog Title" value="{{ $blog->title }}">
										
									</div>
									<div class="form-group">
										<label for="image">Blog Image</label>
										<input type="file" class="form-control" name="image" id="image" placeholder="Image">
										<br>
										<a href="{{ asset($blog->image) }}" target="_blank"><img src="{{ asset($blog->image) }}" width="100px" height="100px"></a>
									</div>
									<div class="form-group">
										<label for="description">Blog Description</label>
										<textarea class="form-control" name="description" id="description" rows="5" col="5">{{ $blog->description }}</textarea>
										
									</div>
									<input type="hidden" name="old_image" value="{{ $blog->image }}">
									<input type="hidden" name="id" value="{{ $blog->id }}">
									<button type="submit" class="btn btn-primary" name="submit">Save</button>
								</form>
							</div>
							<div class="col-md-4">
								
								
							</div>
						</div>
					</div>     
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogComment;
use Carbon\Carbon;

class FrontendController extends Controller
{
    public function BlogPage($id,$title){
		$blog = Blog::where('id',$id)->first();
		$comments = BlogComment::where('blog_id',$id)->where('status',1)->latest()->limit(3)->get();
		return view('frontend.post',compact('blog','comments'));
	}
	
	public function CommentSubmit(Request $request){
		$insert = BlogComment::create([
			'blog_id' => $request->id,
			'user_id' => 1,
			'name' => $request->username,
			'email' => $request->useremail,
			'comment' => $request->usercomment,
			'created_at' => Carbon::now(),
		]);
		
		return redirect()->back()->with('success','Comment Sent Successfully...wait until admin approval..');
	}
}

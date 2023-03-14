<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\post;
use App\Models\comment;
use App\Models\User;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public $data;
    public function showpost(Request $req)
    {
        $users = Post::all();
        $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
        return view('layouts.pages.post', compact('users', 'data'));
    }

    function addpost(Request $req)
    {

        $image = $req->post_image;
        $img_name = $image->getClientOriginalName();
        $image->move(public_path('images/post'), $img_name);

        $post = new post();
        $post->post_title = $req->post_title;
        $post->post_author = $req->post_author;
        $post->post_status = $req->post_status;
        $post->post_image = $img_name;
        $post->post_content = $req->post_content;
        $post->post_date = Carbon::now();
        $result = $post->save();

        if ($result) {
            return back()->with('success', 'Post Created!!!');
        } else {
            return back()->with('failed', 'Something Wrong!!!');
        }
    }
    
    function updatepost(Request $req, $id)
    {
        $post = post::find($id);
        $post->post_title = $req->post_title;
        $post->post_author = $req->post_author;
        $post->post_status = $req->post_status;
        $post->post_content = $req->post_content;
        $post->post_date = Carbon::now();

        if ($req->hasfile('post_image')) {
            $image = $req->file('post_image');
            $img_name = $image->getClientOriginalName();
            $image->move(public_path('images/post/'), $img_name);
            $post->post_image = $img_name;
        }
        $result = $post->save();
        if ($result) {
            return redirect('post')->with('success', 'Post Upadated');
        } else {
            return redirect('post')->with('failed', 'Something Wrong!!!');
        }
    }

    function deletepost(Request $req, $id)
    {
        $post = post::find($id)->first();
        $result = $post->delete();
        if ($result) {
            return redirect('post')->with('success', 'Post Deleted');
        } else {
            return redirect('post')->with('failed', 'Something Wrong!!!');
        }
    }

    function addcomment(Request $req)
    {
        $req->validate([
            'comment_author'=> 'required',
            'comment_email'=> 'required|email',
            'comment_content'=> 'required',
            'comment_image'=> 'required',
        ]);
        
        $comment = new comment();
        $comment->comment_post_id = $req->comment_post_id;
        $comment->comment_author = $req->comment_author;
        $comment->comment_email = $req->comment_email;
        $comment->comment_content = $req->comment_content;
        $comment->comment_image = $req->comment_image;
        $comment->comment_date = Carbon::now();
        $result = $comment->save();
        $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
        if ($result) {
            $post_comment = Post::where('id', '=', $req->comment_post_id)->first();
            $comments = comment::where('comment_post_id', '=', $req->comment_post_id)->get();
            return back()->with('success', 'Commented!!!', compact('post_comment','comments', 'data'));
        } else {
            return back()->with('failed', 'Something Wrong!!!');
        }
    }

}
?>
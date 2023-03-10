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
        $post->save();

        return redirect('post');
    }

    function updateordeletepost(Request $req)
    {

        $id = $req->get('id');
        $post_title = $req->get('post_title');
        $post_author = $req->get('post_author');
        $post_status = $req->get('post_status');
        $post_content = $req->get('post_content');

        if ($req->get('editpost') == 'Editpost') {
            return view('user.post_edit', ['id' => $id, 'post_title' => $post_title, 'post_author' => $post_author, 'post_status' => $post_status, 'post_content' => $post_content]);
        } else {
            $dlt = post::find($id);
            $dlt->delete();
        }
        return redirect('post');
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
        $comment->comment_date = Carbon::now();
        if($req->hasfile('comment_image')){
            $image = $req->comment_image;
            $img_name = $image->getClientOriginalName();
            $image->move(public_path('images/comments'),$img_name);   
            $comment->comment_image = $img_name;
            // echo dd($image);
        }
        $result = $comment->save();

        if ($result) {
            // $post_comment = Post::find($req->comment_post_id)->first();
            $post_comment = Post::where('id', '=', $req->comment_post_id)->first();
            // $cdata = comment::where('comment_post_id', '=', $req->comment_post_id)->get();
            $comments = comment::where('comment_post_id', '=', $req->comment_post_id)->get();

            return view('blog.blogcomment', compact('post_comment','comments'))->with('success', 'Commented!!!');
        } else {
            return back()->with('failed', 'Something Wrong!!!');
        }
    }

}
?>
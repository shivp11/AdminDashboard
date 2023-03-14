<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\User;
use App\Models\comment;
use Illuminate\Support\Facades\Request;

class blogController extends Controller
{
    public $p_post;
    public function home(){
        $posts = post::where('post_status', '=', 'Approved')->get();
        $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
        return view('blog.bloghome', compact('posts', 'data'));
    }
    public function commentpage(Request $req,$id){
        $post_comment = Post::where('id', '=', $id)->first();
        $comments = comment::where('comment_post_id', '=', $id)->get();
        $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
        return view('blog.blogcomment', compact('post_comment', 'comments', 'data'));
    }
}
?>
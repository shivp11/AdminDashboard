<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\User;
use App\Models\comment;
use App\Models\postlike;
use App\Models\postdislike;
use App\Models\replycomment;
use App\Models\rereplycomment;
use Illuminate\Support\Facades\Request;

class blogController extends Controller
{
    public $p_post;
    public function home(){
        $posts = post::where('post_status', '=', 'Approved')->get();
        if ($posts->isEmpty()) {
            $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
            return view('blog.post-empty', compact('data'));
            // return view('blog.bloghome', compact('data'))->with('failed', 'No Post Found!!!');
        }else{
            $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
            return view('blog.bloghome', compact('posts', 'data'));
        }
    }
    public function commentpage(Request $req,$id){
        $post_comment = Post::where('id', '=', $id)->first();
        $comments = comment::where('post_id', '=', $id)->get();
        $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
        $replycomments = replycomment::where('post_id', '=', $id)->get();
        $rereplycomments = rereplycomment::where('post_id', '=', $id)->get();
        $likes = postlike::where('like_post_id', '=', $id)->get();
        $likecount = postlike::where('like_post_id', '=', $id)->count();
        $dislikecount = postdislike::where('dislike_post_id', '=', $id)->count();
        return view('blog.blogcomment', compact('post_comment', 'comments', 'data', 'replycomments', 'rereplycomments', 'likes', 'likecount', 'dislikecount'));
    }
}
?>
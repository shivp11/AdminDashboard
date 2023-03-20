<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\post;
use App\Models\postdislike;
use App\Models\postlike;
use App\Models\replycomment;
use App\Models\rereplycomment;
use App\Models\User;
use Carbon\Carbon;
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

    public function addpost(Request $req)
    {

        $image = $req->post_image;
        $img_name = $image->getClientOriginalName();
        $image->move(public_path('images/post'), $img_name);

        $post = new post();
        $post->post_title = $req->post_title;
        $post->user_id = $req->user_id;
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

    public function updatepost(Request $req, $id)
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

    public function deletepost(Request $req, $id)
    {
        $post = post::find($id)->first();
        $result = $post->delete();
        if ($result) {
            return redirect('post')->with('success', 'Post Deleted');
        } else {
            return redirect('post')->with('failed', 'Something Wrong!!!');
        }
    }

    public function addcomment(Request $req)
    {
        $req->validate([
            'comment_author' => 'required',
            'comment_email' => 'required|email',
            'comment_content' => 'required',
            'comment_image' => 'required',
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
            return back()->with('success', 'Commented!!!', compact('post_comment', 'comments', 'data'));
        } else {
            return back()->with('failed', 'Something Wrong!!!');
        }
    }

    public function replycomment(Request $req, $id)
    {
        $req->validate([
            'reply_comment_author' => 'required',
            'reply_comment_email' => 'required|email',
            'reply_comment_image' => 'required',
        ]);

        if (is_null($req->reply_comment_content)) {
            return back()->with('failed', 'Something Wrong!!!');
        }

        $comment = comment::where('comment_id', '=', $id)->get();
        $comment_post_id = $comment[0]['comment_post_id'];

        $replycomment = new replycomment();
        $replycomment->comment_id = $id;
        $replycomment->post_id = $comment_post_id;
        $replycomment->reply_comment_author = $req->reply_comment_author;
        $replycomment->reply_comment_email = $req->reply_comment_email;
        $replycomment->reply_comment_image = $req->reply_comment_image;
        $replycomment->reply_comment_content = $req->reply_comment_content;
        $result = $replycomment->save();
        if ($result) {
            $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
            $post_comment = Post::where('id', '=', $req->comment_post_id)->first();
            $comments = comment::where('comment_post_id', '=', $req->comment_post_id)->get();
            $replycomments = replycomment::where('post_id', '=', $comment_post_id)->get();
            return back()->with('success', 'Commented!!!', compact('post_comment', 'comments', 'data', 'replycomments'));
        } else {
            return back()->with('failed', 'Something Wrong!!!');
        }

    }

    public function rereplycomment(Request $req, $id)
    {
        $req->validate([
            'rereply_comment_author' => 'required',
            'rereply_comment_email' => 'required|email',
            'rereply_comment_image' => 'required',
        ]);

        if (is_null($req->rereply_comment_content)) {
            return back()->with('failed', 'Something Wrong!!!');
        }

        $recomment = replycomment::where('reply_comment_id', '=', $id)->get();
        $recpost_id = $recomment[0]['post_id'];
        $rec_id = $recomment[0]['comment_id'];

        $replycomment = new rereplycomment();
        $replycomment->reply_comment_id = $id;
        $replycomment->comment_id = $rec_id;
        $replycomment->post_id = $recpost_id;
        $replycomment->rereply_comment_author = $req->rereply_comment_author;
        $replycomment->rereply_comment_email = $req->rereply_comment_email;
        $replycomment->rereply_comment_image = $req->rereply_comment_image;
        $replycomment->rereply_comment_content = $req->rereply_comment_content;
        $result = $replycomment->save();
        if ($result) {
            $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
            $post_comment = Post::where('id', '=', $recpost_id)->first();
            $comments = comment::where('comment_post_id', '=', $recpost_id)->get();
            $replycomments = replycomment::where('post_id', '=', $recpost_id)->get();
            $rereplycomments = rereplycomment::where('post_id', '=', $recpost_id)->get();
            return back()->with('success', 'Commented!!!', compact('post_comment', 'comments', 'data', 'replycomments', 'rereplycomments'));
        } else {
            return back()->with('failed', 'Something Wrong!!!');
        }

        return $recpost_id;

    }

    public function like(Request $req, $id)
    {

        $post = post::where('id', '=', $id)->get();
        // $liketable = postlike::where('like_post_id', '=', $id)->get();
        $user = postlike::where('like_post_id', '=', $id)->where('user_id', '=', Session()->get('loginId'))->get();
        if ($user->isEmpty()) {
            // return 'hie';
            $userInDislike = postdislike::where('dislike_post_id', '=', $id)->where('user_id', '=', Session()->get('loginId'))->get();
            if ($userInDislike->isEmpty()) {
                $like = new postlike();
                $like->like_post_id = $id;
                $like->user_id = Session()->get('loginId');
                $result = $like->save();
                if ($result) {
                    $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
                    $post_comment = Post::where('id', '=', $id)->first();
                    $comments = comment::where('comment_post_id', '=', $id)->get();
                    $replycomments = replycomment::where('post_id', '=', $id)->get();
                    $rereplycomments = rereplycomment::where('post_id', '=', $id)->get();
                    $likes = postlike::where('like_post_id', '=', $id)->get();
                    return back()->with('success', 'liked!!!', compact('post_comment', 'comments', 'data', 'replycomments', 'rereplycomments', 'likes'));
                } else {
                    return back()->with('failed', 'Something Wrong!!!');
                }
            } else {
                $userInDislike = postdislike::where('dislike_post_id', '=', $id)->where('user_id', '=', Session()->get('loginId'))->delete();
                $like = new postlike();
                $like->like_post_id = $id;
                $like->user_id = Session()->get('loginId');
                $result = $like->save();
                if ($result) {
                    $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
                    $post_comment = Post::where('id', '=', $id)->first();
                    $comments = comment::where('comment_post_id', '=', $id)->get();
                    $replycomments = replycomment::where('post_id', '=', $id)->get();
                    $rereplycomments = rereplycomment::where('post_id', '=', $id)->get();
                    $likes = postlike::where('like_post_id', '=', $id)->get();
                    return back()->with('success', 'liked!!!', compact('post_comment', 'comments', 'data', 'replycomments', 'rereplycomments', 'likes'));
                } else {
                    return back()->with('failed', 'Something Wrong!!!');
                }
            }
        } else {
            $userid = $user[0]['user_id'];
            if (Session()->get('loginId') == $userid) {
                // echo $user_id;
                // echo $liketable;
                // echo Session()->get('loginId');
                return back()->with('failed', 'You already liked!!!');
            }
        }
    }
    public function dislike(Request $req, $id)
    {

        $post = post::where('id', '=', $id)->get();
        // $liketable = postlike::where('like_post_id', '=', $id)->get();
        $user = postdislike::where('dislike_post_id', '=', $id)->where('user_id', '=', Session()->get('loginId'))->get();
        if ($user->isEmpty()) {
            $userInLike = postlike::where('like_post_id', '=', $id)->where('user_id', '=', Session()->get('loginId'))->get();
            if ($userInLike->isEmpty()) {
                // return 'hie';
                $dislike = new postdislike();
                $dislike->dislike_post_id = $id;
                $dislike->user_id = Session()->get('loginId');
                $result = $dislike->save();
                if ($result) {
                    $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
                    $post_comment = Post::where('id', '=', $id)->first();
                    $comments = comment::where('comment_post_id', '=', $id)->get();
                    $replycomments = replycomment::where('post_id', '=', $id)->get();
                    $rereplycomments = rereplycomment::where('post_id', '=', $id)->get();
                    $likes = postlike::where('like_post_id', '=', $id)->get();
                    $dislikes = postdislike::where('dislike_post_id', '=', $id)->get();
                    return back()->with('success', 'Unliked!!!', compact('post_comment', 'comments', 'data', 'replycomments', 'rereplycomments', 'likes', 'dislikes'));
                } else {
                    return back()->with('failed', 'Something Wrong!!!');
                }
            } else {
                $userInLike = postlike::where('like_post_id', '=', $id)->where('user_id', '=', Session()->get('loginId'))->delete();

                $dislike = new postdislike();
                $dislike->dislike_post_id = $id;
                $dislike->user_id = Session()->get('loginId');
                $result = $dislike->save();
                if ($result) {
                    $data = User::all()->where('id', '=', Session()->get('loginId'))->first();
                    $post_comment = Post::where('id', '=', $id)->first();
                    $comments = comment::where('comment_post_id', '=', $id)->get();
                    $replycomments = replycomment::where('post_id', '=', $id)->get();
                    $rereplycomments = rereplycomment::where('post_id', '=', $id)->get();
                    $likes = postlike::where('like_post_id', '=', $id)->get();
                    $dislikes = postdislike::where('dislike_post_id', '=', $id)->get();
                    return back()->with('success', 'Unliked!!!', compact('post_comment', 'comments', 'data', 'replycomments', 'rereplycomments', 'likes', 'dislikes'));
                } else {
                    return back()->with('failed', 'Something Wrong!!!');
                }
            }

        }else{
            $userid = $user[0]['user_id'];
            if(Session()->get('loginId') == $userid){
                    // echo $user_id;
                    // echo $liketable;
                    // echo Session()->get('loginId');
                    return back()->with('failed', 'You already disliked!!!');
                }
    }
}
}
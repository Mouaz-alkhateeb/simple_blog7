<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();
        $posts = Post::count();
        $comments = Comment::count();

        $most_comment = User::withCount('comments')->orderBy('comments_count', 'desc')->first();
        $like_count = Like::where('user_id',  $most_comment->id)->count();
        $user_commenter = $like_count + $most_comment->comments_count;

        $most_likes = User::withCount('likes')->orderBy('likes_count', 'desc')->first();
        $comment_count = Comment::where('user_id',  $most_likes->id)->count();
        $user_liker = $comment_count +  $most_likes->likes_count;

        $post_most_comment = Post::withCount('comments')->orderBy('comments_count', 'desc')->first();
        $post_like_count = Like::where('post_id', $post_most_comment->id)->count();
        $post_commenter =   $post_like_count +   $post_most_comment->comments_count;

        $post_most_likes = Post::withCount('likes')->orderBy('likes_count', 'desc')->first();
        $post_comment_count = Comment::where('post_id', $post_most_likes->id)->count();
        $post_liker =  $post_comment_count  + $post_most_likes->likes_count;

        if ($user_commenter > $user_liker) {
            $active_user = $most_comment->name;
            $active_user_comment = $most_comment->comments_count;
            $active_user_like = $like_count;
        } else {
            $active_user = $most_likes->name;
            $active_user_like =  $most_likes->likes_count;
            $active_user_comment =  $comment_count;
        }

        if ( $post_liker > $post_commenter) {
            $active_post =  $post_most_comment->title;
            $active_post_comment =  $post_most_comment->comments_count;
            $active_post_like =  $post_like_count;
        } else {
            $active_post =  $post_most_likes->title;
            $active_post_like = $post_most_likes->likes_count;
            $active_post_comment =   $post_comment_count;
        }

        $statics = [
            'users' => $users,
            'posts' => $posts,
            'comments' => $comments,
            'active_user' => $active_user,
            'active_user_like' => $active_user_like,
            'active_user_comment' => $active_user_comment,
            'active_post' => $active_post,
            'active_post_like' => $active_post_like,
            'active_post_comment' => $active_post_comment,
        ];
        return view('content.statics', compact('statics'));
    }
}


       

       
        
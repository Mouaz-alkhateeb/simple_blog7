<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Like;
use App\Post;
use App\Role;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    
    public function index()
    {
       $posts=Post::all();
       $categorys=Category::all();
       return view('content.posts',compact('posts','categorys'));
    }
    public function admin()
    {     
       $users=User::all();
       $stop_comment=Setting::where('name','stop_comment')->value('value');    
       return view('content.admin',compact('users','stop_comment'));
    }

    public function add_role(Request $request)
    {     
      $user=User::where('id',$request->id)->first();
      $user->roles()->detach();

        if($request['user_role'])
            {
                $user->roles()->attach(Role::where('name','User')->first());
            }
        if($request['editor_role'])
            {
                $user->roles()->attach(Role::where('name','Editor')->first());
            }
        if($request['admin_role'])
            {
                $user->roles()->attach(Role::where('name','Admin')->first());
            }
            return redirect()->back();
    }

    public function editor()
    {     
       return view('content.editor');
    }

    public function accses_denied()
    {     
       return view('content.accses_denied');
    }

    public function like(Request $request)
    {     
       $like_s=$request->like_s;
       $post_id=$request->post_id;
       $change_like=0;
       $like=Like::where('post_id',$post_id)
       ->where('user_id',Auth::user()->id)
       ->first();

       if(!$like)
        {
            $new_like=new like;
            $new_like->post_id=$post_id;
            $new_like->user_id=Auth::user()->id;
            $new_like->like=1;
            $new_like->save(); 
            $is_like=1;

        }elseif($like->like==1)
            {
               Like::where('post_id',$post_id)
                ->where('user_id',Auth::user()->id)
                ->delete();
                $is_like=0;
            }
         elseif($like->like == 0)
            {
                Like::where('post_id',$post_id)
                ->where('user_id',Auth::user()->id)
                ->update(['like'=> 1]);
                $is_like=1;
                $change_like = 1;
            }
            $response=array(
                'is_like'=>$is_like,
                'change_like'=>$change_like
            );

            return response()->json($response,200);
    }



    public function dislike(Request $request)
    {     
       $like_s=$request->like_s;
       $post_id=$request->post_id;
       $change_dislike=0;
       $dislike=Like::where('post_id',$post_id)
       ->where('user_id',Auth::user()->id)
       ->first();

       if(!$dislike)
        {
            $new_like=new like;
            $new_like->post_id=$post_id;
            $new_like->user_id=Auth::user()->id;
            $new_like->like=0;
            $new_like->save(); 

            $is_dislike=1;

        }elseif($dislike->like==0)
            {
               Like::where('post_id',$post_id)
                ->where('user_id',Auth::user()->id)
                ->delete();
                $is_dislike=0;
            }
         elseif($dislike->like == 1)
            {
                Like::where('post_id',$post_id)
                ->where('user_id',Auth::user()->id)
                ->update(['like'=> 0]);
                $is_dislike=1;
                $change_dislike = 1;
            }
            $response=array(
                'is_dislike'=>$is_dislike,
                'change_dislike'=> $change_dislike
            );

            return response()->json($response,200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'path' => 'image|mimes:jpg,jpeg,gif,png|max:2048'
           ]);    
        $img_name=time().'.'.$request->path->getClientOriginalExtension();
        $post=new Post;
        $post->title=request('title');
        $post->body=request('body');
        $post->category_id=request('category_id');
        $post->path= $img_name;
        $post->save();
        $request->path->move(public_path('img/'), $img_name);
        return redirect('/posts');
    }

    public function show($id)
    {
       $post=Post::where('id',$id)->first();
       $comments=Comment::where('post_id',$id)->get();
       $categorys=Category::all();
       $stop_comment=Setting::where('name','stop_comment')->value('value');
       return view('content.details',compact('post','comments','categorys','stop_comment'));
    }

    public function edit(Post $post)
    {
        //
    }

}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Comment;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        $userid = Auth::user()->id;
        $posts = User::find($userid)->post()->get();
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $post = new Post;
        $post->title = Request('title');
        $post->content = Request('content');
        $user->Post()->save($post);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $user = Post::find($post->id)->user()->first();
        $comment = Post::find($post->id)->comment()->where('post_id',$post->id)->get();
        $countcom = $comment->count();
        return view('posts.show',compact('post','user','comment','countcom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    { 
       $postup = Post::find($post->id);
       $postup->title = Request('title');
       $postup->content = Request('content');
       $postup->save();
       return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $postdl = Post::find($post->id);
        $postdl->delete();
        return redirect('/posts');

    }
    //comment
    public function commentstore(Request $request,Post $post) {
        $user = Auth::user();
        $userid = $user->id;
        $com = new Comment();
        $com->user_id = $userid;
        $com->post_id =  $post->id;
        $com->commenter = $user->name;
        $com->body = Request('comment');
        $com->save();
        return back();
    }
}

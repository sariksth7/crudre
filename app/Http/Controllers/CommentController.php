<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, $post_id)
    {
       $this->validate($request, array([
           'comment' => 'required|min:20|max:255'
       ]));

       $post = Posts::find($post_id);

        $comment = new Comment();
        $comment->comment = $request->comment;
        $id = Auth::id();
        $comment->user_id = $id;
       // $comment->approved = true;
        $comment->post()->associate($post);
        $comment->save();

        //dd($comment);


        return redirect()->route('display_post', [$post->id])->with('msg', 'Comment Added !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
//        $comment =Comment::with('comment', 'user')->first();
//
//        return view('Post.show_post', ['comments'=>$comment]);
//        dd($comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


       $comment = Comment::where('id', $id)->first();



       $comment->delete();
       return redirect()->route('display_post', $comment->post_id)
           ->with('msg', 'Comment Deleted Successfully!!!');

    }
}

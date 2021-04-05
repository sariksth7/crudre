<?php

namespace App\Http\Controllers;

use App\Like;
use App\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LikeController extends Controller
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Like $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Like $like
     * @return \Illuminate\Http\Response
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Like $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Like $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        //
    }

    public function likePost(Request $request)
    {

        $like = Like::where('post_id', $request->post_id)->where('user_id', auth()->id())->first();

        if ($like) {
            $like->like = ($like->like == 0) ? 1 : 0;
            $like->save();
        } else {
            $like = new Like();
            $like->user_id = auth()->id();
            $like->post_id = $request->post_id;
            $like->like = 1;
            $like->save();
        }


        $likeCount = Like::where('post_id', $request->post_id)->where('like', 1)->count();


        return response()->json([
            'status' => true,
            'data' => $likeCount,
            'like'=>$like

        ]);


        /*
                $post_id = $request ['postId'];
                $is_like = $request['isLike'] === 'true';
                $update = false;
                $post = Posts::find($post_id);
                if (!$post){
                    return null;

                    $user = Auth::user();
                    $like = $user->likes()->where('post_id', $post_id)->first();
                    if ($like){
                        $already_like = $like->like;
                        $update = true;

                        if ($already_like == $is_like) {
                            $like->delete();
                            return null;
                        }
                        else {
                            $like = new Like();
                        }
                        $like->like = $is_like;
                        $like->user_id = $user->id;
                        $like->post_id = $post->id;
                        if ($update) {
                            $like->update();
                        }
                        else{
                            $like->save();
                        }
                        return null;
                    }
                }
        */


    }
}

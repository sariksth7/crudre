<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Exports\PostExport;
use App\Posts;
use App\Like;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post.sarik_book')->with('availablePost', Posts::orderBy('created_at', 'desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Post.create_post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $request -> validate([
//            'title' => 'required',
//            'description' => 'required'
//        ]);
//
//        $Post = new Posts();
//            $Post->title=$request->title;
//            $Post->description=$request->description;
//            $id = Auth::id();
//            $Post->user_id = $id;
//            $Post->save();
//           // dd($Post);


        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        $post = new Posts();
        $post->title = $request->title;
        $post->description = $request->description;
        $id = Auth::id();
        $post->user_id = $id;
        $post->save();

        return redirect()->route('sarikwall')->with('msg', 'Post Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Posts $posts
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Posts::with('user', 'comments', 'likes')->where('id', $id)->first();

        // $like = Posts::with('likes')->where('id', $id)->findOrFail ($id);


//        $like = Like::with('post')->where('post_id', $id )->first();
//
//        dd($like->count('like'));
        //  $time = Carbon::parse(($post->created_at));
//        dd($time->toDayDateTimeString());
        //$comment = $post->comments->sortByDesc('id');
        //dd($comment->first());
        //orderBy('created_at','desc')->get('id');
//        $comment_data = $show->comments;
        //$comment_user = $test->comments->first()->user;

        //dd($show);
        return view('Post.show_post', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Posts $posts
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Posts::findOrFail($id);
        return view('Post.edit_post', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Posts $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $post = Posts::find($request->id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();

        return redirect()->route('sarikwall')->with('msg', 'Post Upadated Successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Posts $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        $post = Posts::find($id);
        foreach ($post->comments as $comment){
            $c_id= $comment->id;
            Comment::destroy($c_id);

        }


        // Posts::destroy(array('id', $id));

        $delete_post = Posts::where('id', $id)->first();
        $delete_post->delete();
        return redirect()->route('sarikwall')->with('msg', 'Post Deleted successfully!');
    }


    //creating a construct classs
    /*   private $export;
       public function __construct(Export $export){
           $this->export = $export;
       }*/

    public function excel(){

        // return \Maatwebsite\Excel\Facades\Excel::download(new PostExport(), 'allpost.xlsx');


        //USING EXPORTABLE CLASS IN POSTEXPORT We dont require Excel::download facade->we can directly return
        //  return (new PostExport())->download('userspost.xls');

        //Implementing Responsable

        //return new PostExport(); //Looking the Code we may get confused so

        return (new PostExport())->download('hero.xlsx');
    }
}

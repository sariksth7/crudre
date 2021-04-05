@extends('layouts.app')
@section('content')


    <div class="container">
        @if($message = session('msg'))
            <div class="alert alert-success">
                <p>{{$message}}</p>
            </div>
        @endif

        <h2> Read Post </h2>


    <!--        <div>
            <a href="{{route('sarikwall')}}" role="button" class="btn btn-success">BACK </a>
        </div>-->

        {{--post title section--}}

        <div class="container">
            <div class="col-md-12">
                <h1>{{$post->title}}</h1>
                <div style="padding: 15px; font-weight: 600; text-transform: uppercase">
                    <strong style="color: red">
                        <u>
                            POSTED BY:
                        </u>
                    </strong>
                    <span style="color: red">
                        {{$post->user->name}}
                    </span>
                </div>

                <p style="text-align: justify; letter-spacing: 3px; text-indent: 50px">{{$post->description}}</p>

            </div>

            @if(Auth::check())
                <div>

                    <a href="" class="like">
                        <i class="fa fa-thumbs-up  like-thumbs"
                           style="font-size: 20px;color: {{ auth()->user()->likes->where('post_id',$post->id)->first() &&
                                                            auth()->user()->likes()->where('post_id',$post->id)->first()->like == 1 ?'blue' : 'black'}}"
                           id="icon-color">
                        </i>
                    </a>
                    @endif
                    <span style="padding: 15px; color: #1b4b72; font-family: Algerian " id="getLike">
                        <strong>{{$post->likes->count()}}</strong>
                    </span>

                    <!--                    <a href="#" class="like">
                                            <i class="fas fa-thumbs-down"> DISLIKE</i>
                                        </a>-->
                    <div class="float-right" style="color: green">
                   <span class="badge " style="font-size: 14px">
                       {{$post->created_at->toDayDateTimeString()}}
                   </span>
                    </div>

                </div>
        </div>


        <div class="container">
            <h3>Comments</h3>
            <div class="row">
                <div class="col-md-8 col-offset-2">

                    {{--                comments displaying section--}}
                    <table class="table">

                        {{--                    @dd($comment->first());--}}
                        @foreach($post->comments->sortByDesc('id') as $comment)



                            <tr>
                                {{--                            <th>{{$comment->id}}</th>--}}
                                <td> BY: <a href="#"> {{$comment->user->name}}</a>
                                    <span> Commented at:
                                    <span style="color: green; font-weight: 600">

                                        {{$comment->created_at->toDayDateTimeString()}}

                                    </span>
                                </span>
                                    <p style="letter-spacing: 2px; padding: 10px">{{$comment->comment}} </p>
                                    @if(Auth::check() && auth()->user()->id==$comment->user_id)

                                        <a href="{{route('comment.delete', $comment->id)}}" role="button"
                                           class="btn btn-danger"> Delete Comment</a>

                                    @endif

                                </td>

                            </tr>




                        @endforeach


                    </table>
                </div>
            </div>

            <div>
                <div class="col-md-12">
                    <form action="{{route('comment.store', $post->id)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name="comment" id="" cols="10" rows="5" class="form-control"
                                      placeholder="What do you think about the post? Write here..."></textarea>
                            <br>
                            <input type="hidden" id="post_id" name="post_id" value={{$post->id}}>
                            <div>
                                @if(Auth::check())
                                <button class="btn btn-primary" type="submit "> }}ADD COMMENT</button>
                                @else
                                    <p>Please Log In to comment</p>
                                    @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>



@endsection

@section('script')
    <script>
        var token = '{{Session::token()}}';

    </script>


@endsection


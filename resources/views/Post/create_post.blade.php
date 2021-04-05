@extends('layouts.app')
@section('content')
    <div class="container">
        <h2> Create New Post </h2>

    </div>
<div class="container">
    <div class="col-md-12">
        <a href="{{route('sarikwall')}}" role="button" class="btn btn-primary"> Back </a>
        <br>
    </div>
    <br>
</div>
<div class="container">
    <div class="col-md-12">
        <form action="{{route('store_post')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title_input">
                    <strong>
                        TITLE:
                    </strong>
                </label>

                <input type="text"  name="title" class="form-control" placeholder="Please Input Your Title Here">
            </div>

            <label for="comment" >
                <strong>
                    DESCRIPTION:
                </strong>
                <textarea name="description" id="" cols="100" rows="10" class="form-control"></textarea>
            </label>

            <div>
                <button class="btn btn-primary" type="submit"> Create Post </button>
            </div>
        </form>
    </div>
</div>




@endsection

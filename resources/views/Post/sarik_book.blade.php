@extends('layouts.app')
@section('content')

    <div class="container">

        @if ($message = Session::get('msg'));
        <div class="alert alert-success">
            <p>{{$message}}</p>
        </div>
        @endif
    </div>
    <div class="container">
        <div class="col-md-4">
            <a class="btn btn-primary" href="{{route('create_post')}}" role="button">Create New Post</a>
            <a class="btn btn-primary" href="{{route('export.post')}}" role="button">Export To Excel</a>
            <br>
            <br>

            <div >
                <form action="{{route('import.post'  )}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <input type="file" name="exelfile">
                        <button type="submit" class="btn btn-primary">IMPORT POST</button>
                    </div>

                </form>

            </div>
        </div>
        <br>
    </div>


    <div class="container">
        <table class=" table table-dark col-md 12 ">
            <tr>
                <th scope="col">I.D.</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th scope="col">Action</th>
            </tr>
            @foreach($availablePost as $postss)
                <tr>
                    <td>{{$postss->id}}</td>
                    <td>{{$postss->title}}</td>
                    <td>{{$postss->description}}</td>
                    <td>{{$postss->created_at}}</td>
                    <td>{{$postss->updated_at}}</td>
                    <td>
                        <a href="{{route('delete_post', $postss->id)}}" role="button" class="btn btn-danger"> Delete Post</a>
                        <a href="{{route('display_post', $postss->id)}}" role="button" class="btn btn-success"> Show Post</a>
                        <a href="{{route('edit_post', $postss->id)}}" role="button" class="btn btn-primary"> Edit Post</a>

                    </td>
                </tr>

            @endforeach

        </table>
    </div>







@endsection

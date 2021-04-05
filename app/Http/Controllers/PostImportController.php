<?php

namespace App\Http\Controllers;

use App\Imports\PostsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PostImportController extends Controller
{
    public function store (Request $request){

        $post =$request->file('exelfile');
        Excel::import(new PostsImport(), $post);
        return back()->with('msg', 'Excel file imported successfully');

    }
}

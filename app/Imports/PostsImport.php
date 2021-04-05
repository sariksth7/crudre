<?php

namespace App\Imports;

use App\Posts;
use Maatwebsite\Excel\Concerns\ToModel;

class PostsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        
        return new Posts([
            'title' =>$row[1],
            'description'=>$row[2],
            'user_id' => auth()->id()
        ]);
    }
}

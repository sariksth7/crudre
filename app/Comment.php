<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function post (){
        return $this->belongsTo('App\Posts','post_id');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}

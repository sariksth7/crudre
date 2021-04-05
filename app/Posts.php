<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $fillable = ['title', 'description', 'user_id'];


    public function user (){
        return $this->belongsTo(User::class);
    }

    public function comments (){
        return $this::hasMany('App\Comment','post_id');
    }

    public  function likes (){
        return $this::hasMany('App\Like','post_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function user (){
        return $this::belongsTo('App\User');
    }

    public function post (){
        return $this::hasMany('App\Posts', 'post_id');
    }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    public function topic(){
      return $this->belongsTo('App\Topic');
    }

    public function problems() {
        return $this->hasMany('App\Problem');
    }
}

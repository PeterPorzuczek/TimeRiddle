<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function course(){
      return $this->belongsTo('App\Course');
    }

    public function quests() {
        return $this->hasMany('App\Quest');
    }
}

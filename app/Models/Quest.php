<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    public function problems() {
        return $this->hasMany('App\Models\Problem');
    }

    public function topic(){
      return $this->belongsTo('App\Models\Topic');
    }
}

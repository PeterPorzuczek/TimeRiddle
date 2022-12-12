<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function quests() {
        return $this->hasMany('App\Models\Quest');
    }
    
    public function course(){
      return $this->belongsTo('App\Models\Course');
    }
}

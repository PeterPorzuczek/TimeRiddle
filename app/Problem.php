<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    public function quest(){
      return $this->belongsTo('App\Quest');
    }

    public function solutions() {
        return $this->hasMany('App\Solution');
    }
}

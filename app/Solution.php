<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    public function problem(){
      return $this->belongsTo('App\Problem');
    }
}

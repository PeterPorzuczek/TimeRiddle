<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id',
    ];

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function topics() {
        return $this->hasMany('App\Topic');
    }
}

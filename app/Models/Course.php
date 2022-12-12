<?php

namespace App;

use Illuminate\Support\Facades\Log;
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

    protected $appends = ['is_night'];

    public function getIsNightAttribute()
    {
        date_default_timezone_set('Europe/Warsaw');
        $hour = date('H', time());

        return !($hour > 7 && $hour < 19);
    }

    public function topics() {
        return
            $this->hasMany('App\Models\Topic');
    }

    public function user(){
      return
        $this->belongsTo('App\Models\User');
    }
}

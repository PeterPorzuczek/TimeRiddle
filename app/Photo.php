<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $casts = [
        'file_name' => 'fileName',
    ];

    public function user(){
      return $this->belongsTo('App\User');
    }
}

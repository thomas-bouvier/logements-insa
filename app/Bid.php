<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    public $guarded = ['id'];

    public $dates = ['created_at', 'updated_at'];

    public function type()
    {
      return $this->belongsTo('App\Type');
    }
}

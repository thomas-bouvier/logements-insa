<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['bid_id', 'filename'];

    public function bid()
    {
        return $this->belongsTo('App\Bid');
    }
}

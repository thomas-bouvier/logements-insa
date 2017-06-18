<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['bid_id', 'filename', 'format'];

    public function bid()
    {
        return $this->belongsTo('App\Bid');
    }

    public static $rules = [
        'file' => 'mimes:png,jpeg,jpg,bmp|max:5120'
    ];
}

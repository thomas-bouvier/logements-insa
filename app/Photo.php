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
        'file' => 'mimes:png,jpeg,jpg,bmp|size:5120'
    ];

    public static $messages = [
        'file.size' => 'Le poids maximal d\'une photo est de 5 Mo.',
        'file.mimes' => 'Les photos doivent présenter l\'une des extensions suivantes : .png, .jpg, .jpeg ou .bmp.'
    ];
}

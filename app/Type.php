<?php

namespace App;

use App\Behavior\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Type extends Model
{
    public $fillable = ['name', 'slug'];

    use Sluggable;

    public static function boot()
    {
        parent::boot();

        static::deleting(function($instance)
        {
            $bids = Type::with('bids')->get();

            foreach ($bids as $bid)
            {
                Storage::disk('public')->deleteDirectory($bid->id);
            }

            return true;
        });
    }

    public function bids()
    {
        return $this->hasMany('App\Bid');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;
use Hootlex\Moderation\Moderatable;
use Storage;
use App\Photo;
use Illuminate\Support\Facades\DB;

class Bid extends Model
{
    use Moderatable;

    public $guarded = ['id'];

    public $dates = ['created_at', 'updated_at'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function($instance)
        {
            Storage::disk('public')->deleteDirectory($instance->id);

            return true;
        });
    }

    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    public function photo($format, $number)
    {
        $filenames = Photo::where('bid_id', $this->id)->where('format', $format)->get()[$number - 1]['filename'];

        return asset('storage/' . $this->id . '/' . $format . '/' . $filenames);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;
use Storage;

class Bid extends Model
{
    public $guarded = ['id'];

    public $dates = ['created_at', 'updated_at'];

    public $formats = [
      'thumb' => [360, 200],
      'large' => [940, 530]
    ];

    public static function boot()
    {
        parent::boot();

        static::deleted(function($instance)
        {
            $instance->detachPhotos();

            return true;
        });
    }

    public static function draft()
    {
        return self::firstOrCreate(['name' => null, 'user_id' => User::where('login', cas()->user())->first()->id], ['type_id' => 0, 'user_id' => 0, 'rental' => 0, 'ground' => 0, 'email' => '', 'district' => '', 'description' => '', 'photo_count' => 0]);
    }

    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    public function detachPhotos()
    {
        for ($i = 1; $i <= $this->photo_count; $i++)
        {
            Storage::disk('public')->delete($this->getStorageDirectory() . '/' . $this->id . '_' . $i . '.jpg');

            foreach ($this->formats as $format => $dimensions)
            {
                Storage::disk('public')->delete($this->getStorageDirectory() . '/' . $this->id . '_' . $i . '_' . $format . '.jpg');
            }
        }
    }

    public function photo($format, $number)
    {
        $filenames = Photo::where('bid_id', $this->id)->where('format', $format)->get()[$number - 1]['filename'];

        return asset('storage/' . $this->getStorageDirectory($this->id) . '/' . $filenames);
    }

    public function getStorageDirectory($bid_id)
    {
        return ceil($bid_id / 250);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }

    public function scopeNotDraft($query)
    {
        return $query->whereNotNull('name');
    }
}

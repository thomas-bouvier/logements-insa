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

    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    public function setPhotosAttribute($photos)
    {
        $index = 1;

        foreach($photos as $photo)
        {
            self::saved(function($instance) use ($photo, $index)
            {
                foreach ($instance->formats as $format => $dimensions)
                {
                    $filename = $instance->id . '_' . $index . '_' . $format . '.' . $photo->getClientOriginalExtension();

                    Photo::create([
                        'bid_id' => $this->id,
                        'filename' => $filename
                      ]);

                    Storage::disk('public')->put($this->getStorageDirectory() . '/' . $filename, Image::make($photo)->fit($dimensions[0], $dimensions[1])->stream()->__toString());
                }

                $filename = $instance->id . '_' . $index . '_original.' . $photo->getClientOriginalExtension();

                Photo::create([
                    'bid_id' => $this->id,
                    'filename' => $filename
                  ]);

                Storage::disk('public')->put($this->getStorageDirectory() . '/' . $filename, Image::make($photo)->stream()->__toString());
            });

            $index++;
        }
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
        return asset('storage/' . $this->getStorageDirectory() . '/' . $this->id . '_' . $number . '_' . $format . '.jpg');
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }

    public function getStorageDirectory()
    {
        return ceil($this->id / 250);
    }
}

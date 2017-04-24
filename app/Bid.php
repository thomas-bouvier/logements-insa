<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;

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
            $instance->detachPicture();

            return true;
        });
    }

    public function detachPicture()
    {
        unlink($this->getPictureDirectory() . '/' . $this->id . '.' . $this->picture);

        foreach ($this->formats as $format => $dimensions)
            unlink(public_path() . $this->image($format));
    }

    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    public function image($size)
    {
        return '/' . $this->getPictureDirectory() . '/' . $this->id . '_' . $size . '.jpg';
    }

    public function setPictureAttribute($picture)
    {
        if (is_object($picture) && $picture->isValid())
        {
            if (!empty($this->picture))
            {
                unlink($this->getPictureDirectory() . '/' . $this->id . '.' . $this->picture);
            }

            self::saved(function($instance) use ($picture)
            {
                $picture = $picture->move($instance->getPictureDirectory(), $instance->id . '.' . $picture->getClientOriginalExtension());

                foreach ($instance->formats as $format => $dimensions)
                    Image::make($picture)->fit($dimensions[0], $dimensions[1])->save(public_path() . $instance->image($format));
            });

            $this->attributes['picture'] = $picture->getClientOriginalExtension();
        }
    }

    public function getPictureDirectory()
    {
        return 'img/pictures/' . ceil($this->id / 1000);
    }
}

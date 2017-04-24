<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;

class Bid extends Model
{
    public $guarded = ['id'];

    public $dates = ['created_at', 'updated_at'];

    public function type()
    {
      return $this->belongsTo('App\Type');
    }

    public function setPictureAttribute($picture)
    {
        if (is_object($picture) && $picture->isValid())
        {
            self::saved(function($instance) use ($picture)
            {
                $picture = $picture->move($instance->getPictureDirectory(), $instance->id . '.' . $picture->getClientOriginalExtension());

                Image::make($picture)->fit(360, 200)->save($instance->getPictureDirectory() . '/' . $instance->id . '_thumb.jpg');
                Image::make($picture)->fit(940, 530)->save($instance->getPictureDirectory() . '/' . $instance->id . '_large.jpg');
            });

            $this->attributes['picture'] = $picture->getClientOriginalExtension();
        }
    }

    public function getPictureDirectory()
    {
        return 'img/pictures/' . ceil($this->id / 1000);
    }
}

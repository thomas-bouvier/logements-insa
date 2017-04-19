<?php

namespace App\Behavior;

use Illuminate\Support\Str;

trait Sluggable
{
  public function setSlugAttribute($slug)
  {
    if (empty($slug))
    {
      $this->attributes['slug'] = Str::slug($this->name);
    }
  }
}

<?php

namespace App;

use App\Behavior\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public $fillable = ['name', 'slug'];

    use Sluggable;
}

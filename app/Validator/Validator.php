<?php

namespace App\Validator;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class Validator extends \Illuminate\Validation\Validator
{
    /*
    public function validateDimension($attribute, $value, $parameters)
    {
        $image = Image::make($value);

        return $image->width() >= $parameters[0] && $image->height() >= $parameters[1];
    }
    
    protected function replaceDimension($message, $attribute, $value, $parameters)
    {
        $message = str_replace(':width', $parameters[0], $message);
        $message = str_replace(':height', $parameters[1], $message);

        return $message;
    }
    */
}

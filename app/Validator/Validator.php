<?php

namespace App\Validator;

class Validator extends \Illuminate\Validation\Validator
{
    public function validateDimension($attribute, $value, $parameters)
    {
        return true;
    }
}

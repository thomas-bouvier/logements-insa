<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['id', 'login'];

    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    public function email()
    {
        return $this->login . '@insa-rennes.fr';
    }
}

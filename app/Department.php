<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $casts = ['id' => 'string'];
    public $incrementing = false;
    
    public function alumnies()
    {
        return $this->hasMany('App\Alumni');
    }

    public function roleUsers()
    {
        return $this->hasMany('App\RoleUser');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $casts = ['id' => 'string'];
    public $incrementing = false;
    public function users()
    {
        return $this->belongsToMany('App\User')->using('App\RoleUser');
    }
}

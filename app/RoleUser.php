<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';

    public function department()
    {
        return $this->belongsTo('App\Department');
    }
}

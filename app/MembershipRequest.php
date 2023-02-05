<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipRequest extends Model
{
    //
    protected $casts = ['id' => 'string'];
    public $incrementing = false;

    public function department(){
        return $this->belongsTo('App\Department');
    }
}

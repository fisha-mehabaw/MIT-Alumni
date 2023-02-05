<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $casts = ['id' => 'string'];
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function address()
    {
        return $this->hasOne('App\Address');
    }

    public function privateCompanies()
    {
        return $this->hasMany('App\PrivateCompany');
    }

    public function pgStudies()
    {
        return $this->hasMany('App\PGStudy');
    }

    public function certificates()
    {
        return $this->hasMany('App\Certificate');
    }

    public function employments()
    {
        return $this->hasMany('App\Employment');
    }

}
